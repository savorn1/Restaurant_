<?php

function getUser()
{
    $getUser = Auth::getUser();

    return $getUser;
}

function uid()
{
    $u = getUser();
    return isset($u->id) ? $u->id : 0;
}

function getSetting($key = null)
{
    return \App\Helpers\ITPC::getSetting($key);
}

function getSettingKey($key, $m = null)
{
    return \App\Helpers\ITPC::getSettingKey($key, $m);
}

function dateAdd($date, $unit, $num_unit)
{
    return \App\Helpers\IDate::dateAdd($date, $unit, $num_unit);
}

function dateDiff($f_date, $t_date)
{
    return \App\Helpers\IDate::dateDiff($f_date, $t_date);
}

function getDayName($date)
{
    return \App\Helpers\IDate::getDayName($date);
}

function getDayNameKH($date)
{
    return \App\Helpers\IDate::getDayNameKH($date);
}

function dateNext($date, $num, $exDaya = [])
{
    return \App\Helpers\IDate::dateNext($date, $num, $exDaya);
}

function dateNext15($date, $num, $exDaya = [])
{
    return \App\Helpers\IDate::dateNext15($date, $num, $exDaya);
}


function convert_number_to_words($number)
{
    return \App\Helpers\ITPC::convert_number_to_words($number);
}

function convert_number_to_words_kh($number)
{
    return \App\Helpers\ITPC::convert_number_to_words_kh($number);
}

function xContains($mystring, $findme)
{
    return strpos($mystring, $findme) !== false;
}

function _t($txt, $lang_file = 'customer')
{
    $txt = trim(strtolower($txt));
    $txt = str_replace('  ', ' ', $txt);
    $txt = str_replace(' ', '_', $txt);
    return trans("{$lang_file}.{$txt}");
    //return $txt;
    //return \App\Helpers\ITPC::translate($txt, $lang);
}


function get_basename($f)
{
    return \App\Helpers\ITPC::get_basename($f);
}

function get_number_of_days_in_month($month, $year)
{
    // Using first day of the month, it doesn't really matter
    $date = $year . "-" . $month . "-1";
    return date("t", strtotime($date));
}

function getInvFormat($n, $date, $pre = 'INV')
{
    return ' ' . $pre . '-' . \Carbon\Carbon::parse($date)->format('dmY')
        . '-' . str_pad($n, 7, '0', STR_PAD_LEFT);
}

function can($t)
{
    return true;
    return \App\Helpers\ITPC::can($t);
}


function cal_salary_tax($cross_salary_r, $n_spouse = 0, $n_children = 0)
{
    $st = 0;
    $allowance = ($n_spouse + $n_children) * 150000;
    $tax_rate = 0;
    $cross_salary_r = $cross_salary_r - $allowance;
//    $m = 10^6;
    $m = 1000000;

    if ($cross_salary_r > 0 && $cross_salary_r <= $m) {
        $st = 0;
        $tax_rate = 0;
    } elseif ($cross_salary_r > $m && $cross_salary_r <= 1.5 * $m) {
        $st = $cross_salary_r * 5 / 100 - 50000;
        $tax_rate = 5;
    } elseif ($cross_salary_r > 1.5 * $m && $cross_salary_r <= 8.5 * $m) {
        $st = $cross_salary_r * 10 / 100 - 125000;
        $tax_rate = 10;
    } elseif ($cross_salary_r > 8.5 * $m && $cross_salary_r <= 12.5 * $m) {
        $st = $cross_salary_r * 15 / 100 - 550000;
        $tax_rate = 15;
    } else {
        $st = $cross_salary_r * 20 / 100 - 1175000;
        $tax_rate = 20;
    }

    return ['allowance' => $allowance, 'tax_rate' => $tax_rate, 'tax_on_salary' => $st];

}


function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}


function _c($amt, $c = 'USD')
{

    if ($c == 'KHR' || $c == '៛') {
        return (ceil($amt / 100)) * 100 > 500 ? (ceil($amt / 100)) * 100 : 0;
    } else {
        return $amt;
    }

}

function _cFormat($amt, $c = 'USD')
{

    if ($c == 'KHR' || $c == '៛') {
        return number_format((ceil($amt / 100)) * 100 > 500 ? (ceil($amt / 100)) * 100 : 0, 0);
    } else {
        return number_format($amt, 2);
    }

}