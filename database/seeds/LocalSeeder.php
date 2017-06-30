<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class LocalSeeder extends Seeder
{
    private $users;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!App::environment('local')) {
            dd("You probably don't want to do this on any env but local");
        }

        $this->clearAll();

        $this->seedUsers();

        $this->seedDateEntries();
    }

    private function clearAll()
    {
        Schema::disableForeignKeyConstraints();

        App\Models\DateEntry::truncate();
        App\Models\User::truncate();

        Schema::enableForeignKeyConstraints();
    }

    // seed a couple users, pw will be set to 'secret'
    private function seedUsers()
    {
        $userCreds = [];
        for ($i = 1; $i <= 10; $i++) {
            $userCreds[] = [
                'name'  => "user{$i}",
                'email' => "user{$i}@example.com",
            ];
        }

        $this->users = collect([]);
        foreach ($userCreds as $userData) {
            $this->users[] = factory(App\Models\User::class)->create($userData);
        }
    }

    // create 25 to 50 entries per user
    private function seedDateEntries()
    {
        $this->users->each(function($user) {
            $data = [
                'user_id' => $user->id
            ];

            factory(App\Models\DateEntry::class, rand(25, 50))->create($data);
        });
    }
}
