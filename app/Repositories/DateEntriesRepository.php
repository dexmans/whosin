<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\DateEntry;
use TID\Repositories\BaseRepository;

class DateEntriesRepository extends BaseRepository
{
    public function model()
    {
        return DateEntry::class;
    }
}
