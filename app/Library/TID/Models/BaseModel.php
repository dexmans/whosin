<?php

namespace TID\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public function getFullNameAttribute()
    {
        $parts = [
            data_get($this, 'first_name'),
            data_get($this, 'preposition'),
            data_get($this, 'middle_name'),
            data_get($this, 'last_name'),
        ];

        return preg_replace('/\s+/', ' ', implode(' ', $parts));
    }
}
