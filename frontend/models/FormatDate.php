<?php


namespace frontend\models;

class FormatDate
{
    const MINUTE = 60;
    const HOUR = 60 * self::MINUTE;
    const DAY = 24 * self::HOUR;

    private static function caseDays($days)
    {
        $case = " дней";
        if ($days % 100 < 10 || $days % 100 > 20) {
            switch ($days % 10) {
                case 1:
                    $case = " день";
                    break;
                case 2:
                case 3:
                case 4:
                    $case = " дня";
                    break;
            }
        }
        return $case;
    }

    private static function caseHours($hours)
    {
        $case = " часов";
        if ($hours % 100 < 10 || $hours % 100 > 20) {
            switch ($hours % 10) {
                case 1:
                    $case = " час";
                    break;
                case 2:
                case 3:
                case 4:
                    $case = " часа";
                    break;
            }
        }

        return $case;
    }

    private static function caseMinutes($minutes)
    {
        $case = " минут";
        if ($minutes % 100 < 10 || $minutes % 100 > 20) {
            switch ($minutes % 10) {
                case 1:
                    $case = " минуту";
                    break;
                case 2:
                case 3:
                case 4:
                    $case = " минуты";
                    break;
            }
        }

        return $case;
    }

    public static function dateDiff($dt)
    {
        $diff_unix = time() - $dt;
        $days = intval($diff_unix / self::DAY);
        $hours = intval(($diff_unix % self::DAY) / self::HOUR);
        $minutes = intval(($diff_unix % self::DAY % self::HOUR) / self::MINUTE);
        if ($days === 0) {
            if ($hours === 0) {

                return strval($minutes) . self::caseMinutes($minutes);
            } else {

                return strval($hours) . self::caseHours($hours);

            }
        } else {

            return strval($days) . self::caseDays($days);
        }

    }
}