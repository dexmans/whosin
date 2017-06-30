<?php

namespace App\Models;

use TID\Models\BaseModel;

class DateEntry extends BaseModel
{
    const STATE_YES        = 'yes';
    const STATE_NO         = 'no';
    const STATE_MAYBE      = 'maybe';
    const STATE_TIME_FROM  = 'from';
    const STATE_TIME_UNTIL = 'until';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public static function getStates()
    {
        return [
            self::STATE_YES,
            self::STATE_NO,
            self::STATE_YES,
            self::STATE_TIME_FROM,
            self::STATE_TIME_UNTIL,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
