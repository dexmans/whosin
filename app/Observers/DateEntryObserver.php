<?php

namespace App\Observers;

use App\Models\DateEntry;
use TID\Observers\BaseObserver;

class DateEntryObserver extends BaseObserver
{
    public function creating(DateEntry $entry)
    {
        if (! auth()->check()) {
            return false;
        }

        $entry->user_id = auth()->user->id;
    }
}
