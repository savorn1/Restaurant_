<?php

namespace App\Helpers;

use App\Models\HolidaySchedule;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class IDate
{

    /**
     * Returns every date between two dates as an array
     * @param string $startDate the start of the date range
     * @param string $endDate the end of the date range
     * @param string $format DateTime format, default is Y-m-d
     * @return array returns every date between $startDate and $endDate, formatted as "Y-m-d"
     * Ex:  createDateRange("2015-01-01", "2015-02-05");
     */
    public static function createDateRange($startDate, $endDate, $format = "Y-m-d")
    {
        $begin = new \DateTime($startDate);

        $_end = self::dateAdd($endDate, UnitDay::DAY, 1);

        $end = new \DateTime($_end);

        $interval = new \DateInterval('P1D'); // 1 Day
        $dateRange = new \DatePeriod($begin, $interval, $end);

        $range = [];
        foreach ($dateRange as $date) {
            if ($format == null) {
                $range[] = $date;
            } else {
                $range[] = $date->format($format);
            }

        }


        return $range;
    }

    public static function createDateRangeIncHoliday($startDate, $endDate, $format = "Y-m-d")
    {
        $_range = self::createDateRange($startDate, $endDate, null);
        $range = [];

        if (count($_range) > 0) {
            foreach ($_range as $date) {

                $type = 'n';

                if ($date->format('D') == 'Sat' || $date->format('D') == 'Sun') {
                    $type = 'w';
                } else {

                    $m = HolidaySchedule::where('end_date', '>=', $date->format('Y-m-d'))
                        ->where('start_date', '<=', $date->format('Y-m-d'))
                        ->orderBy('end_date', 'DESC')
                        ->first();

                    if ($m != null) {
                        $type = 'h';
                    }

                }


                $range[] = [
                    'date' => $format == null ? $date : $date->format($format),
                    'type' => $type
                ];
            }
        }

        return $range;
    }


    public static function dateAdd($date, $unit, $num_unit)
    {
        $sql = "SELECT DATE_ADD('{$date}', INTERVAL {$num_unit} {$unit}) as d";
        $d = DB::select($sql);
        if (count($d) > 0) {
            return $d[0]->d;
        } else {
            return null;
        }
    }

    public static function dateDiff($f_date, $t_date)
    {
        $sql = "SELECT DATEDIFF('{$t_date}', '{$f_date}') as d";
        $d = DB::select($sql);
        if (count($d) > 0) {
            return $d[0]->d;
        } else {
            return null;
        }
    }

    public static function dateDiffFromNow($date)
    {
        $sql = "SELECT DATEDIFF('{$date}', now()) as d";
        $d = DB::select($sql);
        if (count($d) > 0) {
            return $d[0]->d;
        } else {
            return null;
        }
    }

    public static function dateNext($date, $num, $exDaya = [], $ifirst = 0)
    {
        if (count($exDaya) == 0) {
            $exDaya = ['saturday', 'sunday'];
        }

        if ($ifirst > 0) {
            $d = self::dateAdd($date, UnitDay::DAY, $num);
        } else {
            $d = self::dateAdd($date, UnitDay::MONTH, $num);
        }

        $m = HolidaySchedule::where('end_date', '>=', $d)
            ->where('start_date', '<=', $d)
            ->orderBy('end_date', 'DESC')
            ->first();

        if ($m != null) {
            $d = self::dateNext($m->end_date, 1, $exDaya, 10);
        }

        $dn = strtolower(getDayName($d));

        if (in_array($dn, $exDaya)) {
            $d = self::dateNext($d, 1, $exDaya, 10);
        }

        return Carbon::parse($d);
    }


    public static function dateNext15($date, $num, $exDaya = [], $ifirst = 0)
    {
        if (count($exDaya) == 0) {
            $exDaya = ['saturday', 'sunday'];
        }

        if ($ifirst > 0) {
            $d = self::dateAdd($date, UnitDay::DAY, $num);
        } else {
            $d = self::dateAdd($date, UnitDay::DAY, 15 * $num);
        }

        $m = HolidaySchedule::where('end_date', '>=', $d)
            ->where('start_date', '<=', $d)
            ->orderBy('end_date', 'DESC')
            ->first();

        if ($m != null) {
            $d = self::dateNext($m->end_date, 1, $exDaya, 10);
        }

        $dn = strtolower(getDayName($d));

        if (in_array($dn, $exDaya)) {
            $d = self::dateNext($d, 1, $exDaya, 10);
        }

        return Carbon::parse($d);
    }


    public static function getDayName($date)
    {
        $sql = "SELECT DAYNAME('{$date}') as d";
        $d = DB::select($sql);
        if (count($d) > 0) {
            return $d[0]->d;
        } else {
            return null;
        }
    }


    public static function getYear($date)
    {
        $sql = "SELECT year('{$date}') as d";
        $d = DB::select($sql);
        if (count($d) > 0) {
            return $d[0]->d;
        } else {
            return null;
        }
    }

    public static function getFirstYear($date)
    {
        $sql = "SELECT year('{$date}') as d";
        $d = DB::select($sql);
        if (count($d) > 0) {
            return $d[0]->d . "/1/1";
        } else {
            return null;
        }
    }

    public static function getLastYear($date)
    {
        $sql = "SELECT year('{$date}') as d";
        $d = DB::select($sql);
        if (count($d) > 0) {
            return $d[0]->d . "/12/31";
        } else {
            return null;
        }
    }


    public static function getDayNameKH($date)
    {
        $days = array(
            'sunday' => 'អាទិត្យ',
            'monday' => 'ចន្ទ',
            'tuesday' => 'អង្គារ',
            'wednesday' => 'ពុធ',
            'thursday' => 'ព្រហស្បតិ៍',
            'friday' => 'សុក្រ',
            'saturday' => 'សៅរ៍'
        );

        $sql = "SELECT DAYNAME('{$date}') as d";
        $d = DB::select($sql);
        if (count($d) > 0) {
            return $days[strtolower($d[0]->d)];
        } else {
            return null;
        }
    }


}

class UnitDay
{
    const DAY = 'DAY';
    const MONTH = 'MONTH';
    const QUARTER = 'QUARTER';
    const YEAR = 'YEAR';
}