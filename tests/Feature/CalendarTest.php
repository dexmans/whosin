<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\DateEntry;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CalendarTest extends TestCase
{
    use DatabaseMigrations;

    private $user;

    public function setUp()
    {
        parent::setUp();

        // $this->user = factory(User::class)->create([
        //     'name'  => 'test_user',
        //     'email' => 'test@example.com',
        // ]);
    }

    /** @test */
    public function guest_should_be_redirected_to_login()
    {
        $response = $this->get('/');

        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function guest_dashboard_should_be_redirected_to_login()
    {
        $response = $this->get('/dashboard');

        $response->assertRedirect(route('login'));
    }
}
