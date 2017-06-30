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
}
