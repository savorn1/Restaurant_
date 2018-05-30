<?php

namespace App\Helpers;


use App\Language;
use App\RoleUser;
use Illuminate\Support\Facades\Auth;

class ITPC
{

    public static function convert_number_to_words($number)
    {

        $hyphen = '-';
        $conjunction = ' and ';
        $separator = ', ';
        $negative = 'negative ';
        $decimal = ' point ';
        $dictionary = array(
            0 => 'zero',
            1 => 'one',
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
            15 => 'fifteen',
            16 => 'sixteen',
            17 => 'seventeen',
            18 => 'eighteen',
            19 => 'nineteen',
            20 => 'twenty',
            30 => 'thirty',
            40 => 'forty',
            50 => 'fifty',
            60 => 'sixty',
            70 => 'seventy',
            80 => 'eighty',
            90 => 'ninety',
            100 => 'hundred',
            1000 => 'thousand',
            1000000 => 'million',
            1000000000 => 'billion',
            1000000000000 => 'trillion',
            1000000000000000 => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . Self::convert_number_to_words(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int)($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . Self::convert_number_to_words($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int)($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = Self::convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= Self::convert_number_to_words($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string)$fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }


    public static function convert_number_to_words_kh($number)
    {

        $hyphen = '';
        $conjunction = '';
        $separator = '';
        $negative = 'ដក ';
        $decimal = ' ក្បៀស ';
        $dictionary = array(
            0 => 'សូន្យ',
            1 => 'មួយ',
            2 => 'ពីរ',
            3 => 'បី',
            4 => 'បួន',
            5 => 'ប្រាំ',
            6 => 'ប្រាំមួយ',
            7 => 'ប្រាំពីរ',
            8 => 'ប្រាំបី',
            9 => 'ប្រាំបួន',
            10 => 'ដប់',
            11 => 'ដប់មួយ',
            12 => 'ដប់ពីរ',
            13 => 'ដប់បី',
            14 => 'ដប់បួន',
            15 => 'ដប់ប្រាំ',
            16 => 'ដប់ប្រាំមួយ',
            17 => 'ដប់ប្រាំពីរ',
            18 => 'ដប់ប្រាំបី',
            19 => 'ដប់ប្រាំបួន',
            20 => 'ម្ភៃ',
            30 => 'សាមសិប',
            40 => 'សែសិប',
            50 => 'ហាសិប',
            60 => 'ហុកសិប',
            70 => 'ចិតសិប',
            80 => 'ប៉ែតសិប',
            90 => 'កៅសិប',
            100 => 'រយ',
            1000 => 'ពាន់',
            1000000 => 'លាន',
            1000000000 => 'ពាន់​លាន',
            1000000000000 => 'ពាន់ពាន់លាន',
            1000000000000000 => 'ពាន់កោដិ',
            1000000000000000000 => 'ម៉ឺនកោដិកោដិ'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int)$number < 0) || (int)$number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . Self::convert_number_to_words_kh(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens = ((int)($number / 10)) * 10;
                $units = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . '' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . Self::convert_number_to_words_kh($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int)($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = Self::convert_number_to_words_kh($numBaseUnits) . '' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= Self::convert_number_to_words_kh($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string)$fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return $string;
    }


    static function get_basename($filename)
    {
        return preg_replace('/^.+[\\\\\\/]/', '', $filename);
    }

    static function getSetting($key = null)
    {
        if ($key == null) {
            $m = \Backpack\Settings\app\Models\Setting::select('key', 'value')->get();
        } else {
            $m = \Backpack\Settings\app\Models\Setting::where('key', $key)->select('key', 'value')->first();
        }

        return $m;
    }

    static function getSettingKey($key, $m = null)
    {
        if ($m != null) {
            if (isset($m->key)) {
                return $m->value;
            } else {
                foreach ($m as $row) {
                    if ($row->key == $key) {
                        return $row->value;
                    }
                }
            }
        }

        return null;
    }

    static function set_active($path, $active = 'active')
    {

        return call_user_func_array('Request::is', (array)$path) ? $active : '';

    }

    static function translate($txt, $lang = 'en')
    {

        if (session()->exists('sess_lang')) {
            $lang = session('sess_lang');
        }

        $arr_lang = ['en', 'km'];
        $l = in_array($lang, $arr_lang) ? $lang : 'en';

        $t = str_replace(' ', '_', preg_replace('/\s+/', ' ', strtolower(trim($txt))));

        $m = Language::where('key', $t)->first();

        if ($m != null) {
            if (isset($m->{$l})) {
                if ($m->{$l} != null && $m->{$l} != '') {
                    return $m->{$l};
                }
            }
        } else {
            $m = new Language();
            $m->key = $t;
            $m->save();
        }

        return $txt;
        //return __('go711.'.$t);
    }

//    ===========================================
//    ===========================================
    public static function getUser()
    {
        if (Auth::check()) {
            $getUser = Auth::getUser();
            // dd($getUser);
            return $getUser;
        } else {
            return null;
        }
    }

    public static function CanAll()
    {

        if (session('permissions') == null) {

            $u = self::getUser();
            $id = 0;

            if ($u != null) {
                $id = $u->id;
            }

            $per = [];
            if ($id > 0) {

                $role = RoleUser::where('user_id', $id)
                    ->join('permission_role', 'permission_role.role_id', '=',
                        'role_user.role_id')
                    ->join('permissions', 'permissions.id', '=',
                        'permission_role.permission_id')
                    ->select('permissions.id', 'permissions.name')
                    ->get();

                if (count($role) > 0) {
                    foreach ($role as $r) {
                        $per[$r->id] = $r->name;
                    }
                }

            }

            session(['permissions' => $per]);
            return $per;
        } else {
            $per = session('permissions');
            return $per;
        }


    }

    public static function can($t = '')
    {
        $p = self::CanAll();
        if (count($p) > 0) {
            return in_array($t, $p);
        }

        return false;
    }


}