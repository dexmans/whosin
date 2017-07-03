<?php

namespace App\Models;

use App\Helpers\DateHelper;
use TID\Models\BaseModel;

class DateEntry extends BaseModel
{
    const STATE_YES        = 'yes';
    const STATE_NO         = 'no';
    const STATE_MAYBE      = 'maybe';
    const STATE_TIME_FROM  = 'from';
    const STATE_TIME_UNTIL = 'until';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'entry_date',
        'state',
        'entry_time',
        'comments',
    ];

    public static function getStates()
    {
        return [
            self::STATE_YES,
            self::STATE_NO,
            self::STATE_MAYBE,
            self::STATE_TIME_FROM,
            self::STATE_TIME_UNTIL,
        ];
    }

    public static function getTimeRelatedStates()
    {
        return [
            self::STATE_TIME_FROM,
            self::STATE_TIME_UNTIL,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Local scope for fetching entries in week X
     *
     * @param  Builder $query Query builder object
     * @param  int     $week  Optional week number
     * @return Builder
     */
    public function scopeInWeek($query, $week = null)
    {
        if (is_null($week)) {
            $week = DateHelper::getCurrentWeekNr();
        }

        $weekDate = DateHelper::getDateByWeekNr($week);

        return $query->whereBetween('entry_date', [
            $weekDate->startOfWeek()->toDateString(),
            $weekDate->endOfWeek()->toDateString()
        ]);
    }

    public static function weekClosure($week = null)
    {
        if (is_null($week)) {
            $week = DateHelper::getCurrentWeekNr();
        }

        $weekDate = DateHelper::getDateByWeekNr($week);

        return function ($query) use ($weekDate) {
            $query->whereBetween('entry_date', [
                $weekDate->startOfWeek()->toDateString(),
                $weekDate->endOfWeek()->toDateString()
            ]);
        };
    }
}
