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
        $this->middleware('auth');

        $this->usersRepository = $usersRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // @todo combine these in weekNav
        $week = request()->get('week');
        $dates = DateHelper::getDatesInWeek($week);

        $users = $this->usersRepository->findAll(['entries' => DateEntry::weekClosure($week)]);

        // @todo move out of controller
        $users->each(function (&$user) {
            $user->entries = $user->entries->keyBy('entry_date')->sortBy('entry_date');
        });

        return view('dashboard', compact('users', 'dates', 'week'));
    }
}
