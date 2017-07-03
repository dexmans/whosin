<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\User;
use TID\Repositories\BaseRepository;

class UsersRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }

    public function findAll($with = [], $columns = ['*'])
    {
        $this->makeModel();

        return $this->model
            ->with($with)
            ->get($columns);
    }
}
