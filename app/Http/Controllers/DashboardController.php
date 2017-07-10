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
        // move out of controller
        if (($rs = $this->redirectIfInvalidWeek($year, $week)) !== true) {
            return $rs;
        }

        // create service for this
        $dateNav = DateHelper::getDatesNavigation($year, $week);

        $users = $this->usersRepository
            ->findAll(['entries' => DateEntry::weekClosure($year, $week)]);

        // @todo move out of controller
        $users->each(function ($user) {
            $user->entries = $user->entries->keyBy('entry_date');
        });

        return view('dashboard', compact('users', 'dateNav'));
    }

    /**
     * On top of route validation, redirect user to valid year/week combi
     *
     * Example:
     * GET /dashboard/2017/53 > /dashboard/2018/1
     *
     * @param  [type] $year [description]
     * @param  [type] $week [description]
     * @return [type]       [description]
     */
    private function redirectIfInvalidWeek($year, $week)
    {
        $date = DateHelper::getDateByWeekNr($year, $week);

        if ($year && $date->year != $year || $week && $date->weekOfYear != $week) {
            return redirect()->route('dashboard', [$date->year, $date->weekOfYear]);
        }
        return true;
    }
}
