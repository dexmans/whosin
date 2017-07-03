<?php

namespace App\Helpers;

use Carbon\Carbon;

// @todo create service from this
class DateHelper
{
    public static function getCurrentYear()
    {
        return Carbon::now()->year;
    }

    public static function getCurrentWeekNr($year = null)
    {
        $date = Carbon::now();
        // if year is set, check current date in that year
        if ($year) {
            $date->year($year);
        }
        return $date->weekOfYear;
    }

    private static function getPreviousWeekDate($year, $week)
    {
        $date = self::getDateByWeekNr($year, $week);
        return $date->subDays(7);
    }

    public static function getPreviousWeekNrYear($year = null, $week = null)
    {
        if (is_null($year)) {
            $year = self::getCurrentYear();
        }
        if (is_null($week)) {
            $week = self::getCurrentWeekNr();
        }

        $date = self::getPreviousWeekDate($year, $week);
        return $date->year;
    }

    public static function getPreviousWeekNr($year = null, $week = null)
    {
        if (is_null($year)) {
            $year = self::getCurrentYear();
        }
        if (is_null($week)) {
            $week = self::getCurrentWeekNr($year);
        }

        $date = self::getPreviousWeekDate($year, $week);
        return $date->weekOfYear;
    }

    private static function getNextWeekDate($year, $week)
    {
        $date = self::getDateByWeekNr($year, $week);
        return $date->addDays(7);
    }

    public static function getNextWeekNrYear($year = null, $week = null)
    {
        if (is_null($year)) {
            $year = self::getCurrentYear();
        }
        if (is_null($week)) {
            $week = self::getCurrentWeekNr();
        }

        $date = self::getNextWeekDate($year, $week);
        return $date->year;
    }

    public static function getNextWeekNr($year = null, $week = null)
    {
        if (is_null($year)) {
            $year = self::getCurrentYear();
        }
        if (is_null($week)) {
            $week = self::getCurrentWeekNr();
        }

        $date = self::getNextWeekDate($year, $week);
        return $date->weekOfYear;
    }

    public static function getDateByWeekNr($year = null, $week = null)
    {
        if (is_null($year)) {
            $year = self::getCurrentYear();
        }
        if (is_null($week)) {
            $week = self::getCurrentWeekNr();
        }

        $date = Carbon::now();
        return $date->setISODate((int) $year, (int) $week);
    }

    /**
     * Get array with dates in week
     *
     * @param  string $format [description]
     * @param  [type] $week   [description]
     * @return [type]         [description]
     */
    public static function getDatesInWeek($year = null, $week = null, $format = 'Y-m-d')
    {
        if (is_null($year)) {
            $year = self::getCurrentYear();
        }
        if (is_null($week)) {
            $week = self::getCurrentWeekNr($year);
        }

        $date = self::getDateByWeekNr($year, $week);

        $dates = [];
        for ($i = 0; $i < 7; $i++) {
            $date->startOfWeek();
            $date->addDays($i);
            $dates[] = [
                'date'           => $date->format('Y-m-d'),
                'date_formatted' => $date->format($format),
                'day'            => $date->formatLocalized('%A'),
                'day_of_week'    => $date->dayOfWeek,
                'is_weekend'     => $date->isWeekend(),
            ];
        }
        return $dates;
    }

    public static function getDatesNavigation($year = null, $week = null, $format = 'Y-m-d')
    {
        if (is_null($year)) {
            $year = self::getCurrentYear();
        }
        if (is_null($week)) {
            $week = self::getCurrentWeekNr($year);
        }

        return [
            'meta'  => [
                'year'          => $year,
                'current_year'  => self::getCurrentYear(),
                'week'          => $week,
                'today'         => Carbon::now()->format('Y-m-d'),
                'previous_week' => self::getPreviousWeekNr($year, $week),
                'current_week'  => self::getCurrentWeekNr(),
                'next_week'     => self::getNextWeekNr($year, $week),
            ],
            'dates' => self::getDatesInWeek($year, $week, $format),
            'nav'   => [
                'previous' => route('dashboard', [
                    self::getPreviousWeekNrYear($year, $week),
                    self::getPreviousWeekNr($year, $week)
                ]),
                'current'  => route('dashboard', [self::getCurrentYear(), self::getCurrentWeekNr()]),
                'next'     => route('dashboard', [
                    self::getNextWeekNrYear($year, $week),
                    self::getNextWeekNr($year, $week)
                ]),
            ],
        ];
    }
}
