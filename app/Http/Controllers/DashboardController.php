<?php

namespace App\Http\Controllers;

use App\Helpers\DateHelper;
use App\Models\DateEntry;
use App\Repositories\UsersRepository;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $usersRepository;

    /**
     * Create a new controller instance.
     *
     * @param  UsersRepository $usersRepository
     * @return void
     */
    public function __construct(UsersRepository $usersRepository)
    {
        $this->usersRepository = $usersRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @param  int  $year
     * @param  int  $week
     * @return \Illuminate\Http\Response
     */
    public function index($year = null, $week = null)
    {
        $dateNav = DateHelper::getDatesNavigation($year, $week);

        $users = $this->usersRepository
            ->findAll(['entries' => DateEntry::weekClosure($year, $week)]);

        // @todo move out of controller
        $users->each(function ($user) {
            $user->entries = $user->entries->keyBy('entry_date');
        });

        return view('dashboard', compact('users', 'dateNav'));
    }
}
