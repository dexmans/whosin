<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function getCurrentWeekNr()
    {
        return Carbon::now()->weekOfYear;
    }

    public static function getPreviousWeekNr()
    {
        $date = Carbon::now();
        return $date->subDays(7)->weekOfYear;
    }

    public static function getNextWeekNr()
    {
        $date = Carbon::now();
        return $date->addDays(7)->weekOfYear;
    }

    public static function getDateByWeekNr($week = null, $year = null)
    {
        if (is_null($week)) {
            $week = self::getCurrentWeekNr();
        }

        $date = Carbon::now();
        return $date->setISODate($year ?? $date->year, (int) $week);
    }

    /**
     * Get array with dates in week, starting on Monday as it should ;P
     *
     * @param  string $format [description]
     * @param  [type] $week   [description]
     * @return [type]         [description]
     */
    public static function getDatesInWeek($week = null, $format = 'Y-m-d')
    {
        if (is_null($week)) {
            $week = self::getCurrentWeekNr();
        }

        $date = self::getDateByWeekNr($week);

        $dates = [];
        for ($i = 0; $i < 7; $i++) {
            $date->startOfWeek();
            $dates[] = $date->addDays($i)->format($format);
        }
        return $dates;
    }
}
