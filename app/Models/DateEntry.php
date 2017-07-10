<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function getEntryTimeAttribute($value)
    {
        if ($value) {
            return Carbon::createFromFormat('H:i:s', $value)->format('H:i');
        }
        return null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Local scope for fetching entries in week X
     *
     * @param  Builder $query Query builder object
     * @param  int     $year  Optional year number
     * @param  int     $week  Optional week number
     * @return Builder
     */
    public function scopeInWeek($query, $year = null, $week = null)
    {
        $weekDate = DateHelper::getDateByWeekNr($year, $week);

        return $query->whereBetween('entry_date', [
            $weekDate->startOfWeek()->toDateString(),
            $weekDate->endOfWeek()->toDateString()
        ]);
    }

    /**
     * Closure used in with
     *
     * @param  int     $year  Optional year number
     * @param  int     $week  Optional week number
     * @return Closure
     */
    public static function weekClosure($year = null, $week = null)
    {
        $weekDate = DateHelper::getDateByWeekNr($year, $week);

        return function ($query) use ($weekDate) {
            $query->whereBetween('entry_date', [
                $weekDate->startOfWeek()->toDateString(),
                $weekDate->endOfWeek()->toDateString()
            ])->orderBy('entry_date');
        };
    }
}
