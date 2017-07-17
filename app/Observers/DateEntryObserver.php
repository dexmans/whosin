<?php

namespace App\Observers;

use Exception;
use App\Models\DateEntry;
use TID\Observers\BaseObserver;

class DateEntryObserver extends BaseObserver
{
    public function creating(DateEntry $entry)
    {
        if (app()->runningInConsole()) {
            if (! $entry->user_id) {
                throw new Exception('When in CLI, make sure you set the user');
            }
            return true;
        }

        if (! auth()->check()) {
            return false;
        }

        $entry->user_id = auth()->user()->id;
    }
}
