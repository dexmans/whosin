<?php

namespace App\Repositories;

use App\Models\DateEntry;
use Carbon\Carbon;
use Exception;
use TID\Repositories\BaseRepository;

class DateEntriesRepository extends BaseRepository
{
    public function model()
    {
        return DateEntry::class;
    }

    public function getBuilder()
    {
        $this->makeModel();

        return $this->model;
    }

    public function findByUserAndWeek(User $user, $week, $columns = ['*'])
    {
        $this->makeModel();

        return $this->model
            ->where('user_id', $user->id)
            ->weeklyEntries($week)
            ->get($columns);
    }

    public function findByUserAndDate(User $user, $date, $columns = ['*'])
    {
        $this->makeModel();

        try {
            $date = Carbon::parse($date);
        } catch (Exception $e) {
            return;
        }

        return $this->model
            ->where('user_id', $user->id)
            ->where('entry_date', $date->toDateString())
            ->first($columns);
    }
}
