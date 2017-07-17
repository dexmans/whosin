<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = 'secret',
        'remember_token' => str_random(10),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'timezone' => $faker->timezone,
        'is_active' => $faker->boolean(80),
        'last_login_at' => $faker->dateTime(),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\DateEntry::class, function (Faker\Generator $faker) {
    // we want dates to seed from 2 months ago up to 2 months in the future
    $startDate = Carbon\Carbon::now()->subMonths(2);
    $endDate   = Carbon\Carbon::now()->addMonths(2);

    $randomDate = Carbon\Carbon::createFromTimestamp(rand(
        $startDate->timestamp,
        $endDate->timestamp
    ))->format('Y-m-d');

    $data = [
        'user_id' => function () {
            return factory(App\Models\User::class)->create()->id;
        },
        'entry_date' => $randomDate,
        'state' => $faker->randomElement(App\Models\DateEntry::getStates()),
        'comments' => $faker->optional()->paragraphs(2, true),
    ];

    if (in_array($data['state'], App\Models\DateEntry::getTimeRelatedStates())) {
        // round by 15 min
        $roundTo = 15;
        $roundBy = $roundTo * 60;
        if ($data['state'] == App\Models\DateEntry::STATE_TIME_FROM) {
            $data['entry_time'] = date('H:i', round(rand(8*3600, 13*3600) / $roundBy) * $roundBy); // some random time between 8AM and 13:00PM
        } else {
            $data['entry_time'] = date('H:i', round(rand(13*3600, 18*3600) / $roundBy) * $roundBy); // some random time between 13:00PM and 6PM
        }
    }

    return $data;
});

