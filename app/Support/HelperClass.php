<?php

namespace App\Support;

use App\Models\ExchangeRate;
use App\Models\File\File;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HelperClass
{
    public static function isPost($request)
    {
        return ($request->method() == 'POST') ? true : false;
    }

    public static function change_date_format($date, $format = null)
    {
        if (self::custom_check_empty($date) !== false) {
            switch ($format) {
                case "d/m/Y":
                    $date = explode("/", $date);
                    return $date[2] . "-" . $date[1] . "-" . $date[0];
                    break;
                case "d.m.Y":
                    $date = explode(".", $date);
                    $new_date = $date[2] . "-" . $date[1] . "-" . $date[0];
                    return $new_date;
                    break;
                default:
                    $date = explode("-", $date);
                    return $date[2] . "/" . $date[1] . "/" . $date[0];
                    break;
            }

        }
        return false;

    }

    public static function custom_selected_option($data, $equal)
    {
        return $data == $equal ? "selected" : null;
    }

    public static function js_confirm_message($type = null)
    {
        if (self::custom_check_empty($type) !== false) {
            switch ($type) {
                case "passive":
                    return "İlgili kaydı pasif hale getirmek istediğinzden emin misiniz?";
                    break;
                case "delete":
                    return "İlgili kaydı silmek istediğinize emin misiniz?";
                    break;
                default:
                    return "";
                    break;
            }
        }
    }

    public static function custom_money($price)
    {
        if (self::custom_check_empty($price) !== false) {
            if (self::custom_check_numeric($price) !== false) {
                $money = number_format($price, 2, ',', '.');
                return $money;
            }
        };
        return false;
    }

    public static function custom_carbon_d_m_y_format($date)
    {
        if (self::custom_check_empty($date) !== false) {
            $dt = Carbon::parse($date)->format('d.m.Y');
            return $dt;
        }
        return false;

    }

    public static function custom_carbon_day($date)
    {
        if (self::custom_check_empty($date) !== false) {
            $dt = Carbon::parse($date);
            return $dt->day;
        }
        return false;
    }

    public static function custom_carbon_monthName($date)
    {
        if (self::custom_check_empty($date) !== false) {
            $dt = Carbon::parse($date);
            return $dt->monthName;
        }
        return false;
    }

    public static function custom_carbon_dayName($date)
    {
        if (self::custom_check_empty($date) !== false) {
            $dt = Carbon::parse($date);
            return $dt->dayName;
        }
        return false;
    }

    public static function custom_carbon_full_date($date)
    {
        if (self::custom_check_empty($date) !== false) {
            $day = self::custom_carbon_day($date);
            $month = self::custom_carbon_monthName($date);
            $year = Carbon::parse($date)->format('Y');
            return $day . " " . $month . " " . $year;
        }
        return false;
    }

    public static function custom_night($start_date, $end_date)
    {
        if (self::custom_check_empty($start_date) !== false && self::custom_check_empty($end_date) !== false) {

            $start = Carbon::parse($start_date);
            $end = Carbon::parse($end_date);
            $start_date = $start->format('Y-m-d');
            $end_date = $end->format('Y-m-d');
            $period = CarbonPeriod::create($start, $end);
            $night = $start->diffInDays($end, false);
            return $night;
        }
        return false;
    }

    public static function custom_check_empty($data)
    {
        if (!empty($data) && isset($data) && $data != "" && $data != null) {
            return $data;
        }
        return false;
    }

    public static function custom_check_numeric($number)
    {
        if (self::custom_check_empty($number) !== false) {
            if (is_numeric($number)) {
                return $number;
            }
            return false;
        }
        return false;
    }

    public static function custom_session_flash($type, $action)
    {
        switch ($type) {
            case "success":
                switch ($action) {
                    case "store":
                        $store = Session::flash("success", "Kayıt ekleme işlemi başarıyla gerçekleşmiştir.");
                        return $store;
                        break;
                    case "update":
                        $update = Session::flash("success", "Kayıt güncelleme işlemi başarıyla gerçekleşmiştir.");
                        return $update;
                        break;
                    case "destroy":
                        $destroy = Session::flash("success", "Kayıt silme işlemi başarıyla gerçekleşmiştir.");
                        return $destroy;
                        break;
                    case "copy":
                        $copy = Session::flash("success", "İlgili kayıt başarılı bir şekilde kopyalanmıştır.");
                        return $copy;
                        break;
                }
                break;
            case "error":
                switch ($action) {
                    case "store":
                        $store = Session::flash("error", "Kayıt ekleme işlemi esnasında bir hata ile karşılaşıldı. Lütfen daha sonra tekrar deneyiniz.");
                        return $store;
                        break;
                    case "update":
                        $update = Session::flash("error", "Kayıt güncelleme işlemi esnasında bir hata ile karşılaşıldı. Lütfen daha sonra tekrar deneyiniz.");
                        return $update;
                        break;
                    case "destroy":
                        $destroy = Session::flash("error", "Kayıt silme işlemi esnasında bir hata ile karşılaşıldı. Lütfen daha sonra tekrar deneyiniz.");
                        return $destroy;
                        break;
                    case "copy":
                        $destroy = Session::flash("error", "Kayıt kopyalama işlemi esnasında bir hata ile karşılaşıldı. Lütfen daha sonra tekrar deneyiniz.");
                        return $destroy;
                        break;
                    case "file_delete":
                        $destroy = Session::flash("error", "İlgili kayıta ait resim silinme işlemi gerçekleştirilemedi. Lütfen daha sonra tekrar deneyiniz.");
                        return $destroy;
                        break;
                }
                break;
            case "info":
                switch ($action) {
                    case "passive":
                        $passive = Session::flash("info", "İlgili kayıt pasif hale getirilmiştir. Daha sonradan tekrar kullanılabilir hale getirilebilir.");
                        return $passive;
                        break;
                    case "child_ages":
                        $passive = Session::flash("info", "Çocuk yaşlarını tekrar kontrol edip deneyiniz.");
                        return $passive;
                        break;
                }
                break;
            default:
                return false;
                break;
        }
    }

    public static function custom_upload_single_image($image, $path, $file_type_id = null)
    {
        if (self::custom_check_empty($image) !== false) {
            $name = self::custom_encrypt_file_name();
            $save_name = $name . '.' . $image->getClientOriginalExtension();
            $image->move($path, $save_name);
            return $save_name;
        }
        return false;
    }

    public static function custom_encrypt_file_name()
    {
        $file_name = sha1(date('YmdHis') . str_random(30));
        return $file_name;
    }

    public static function custom_delete_single_file($file_path)
    {
        if (self::custom_check_empty($file_path) !== false) {
            if (file_exists($file_path)) {
                if(unlink($file_path)){
                    return true;
                }
            }
            return false;
        }
        return false;
    }

    public static function custom_recursive_remove_directory($directory)
    {
        if (self::custom_check_empty($directory) !== false) {
            foreach(glob("{$directory}/*") as $file) {
                if(is_dir($file)) {
                    Helper::custom_recursive_remove_directory($file);
                } else {
                    unlink($file);
                }
            }
           if(file_exists($directory)){
               rmdir($directory);
               return true;
           }
        }
        return false;
    }

    public static function custom_text_shaper($text)
    {
        if (self::custom_check_empty($text) !== false) {
            return print("<span style='font-size:17px; color:red;'><strong>" . $text . "</strong></span>");
        }
        return false;
    }

    public static function custom_where_am_i($array)
    {
        if (self::custom_check_empty($array) !== false) {
            if (is_array($array)) {
                $text = "";
                foreach ($array as $arr) {
                    $text .= $arr . " -> ";
                }
                $text = rtrim($text, " -> ");
                return $text;
            }
        }
        return false;
    }

    public static function custom_check_double($number)
    {
        if (self::custom_check_empty($number) !== false) {
            if (self::custom_check_numeric($number)) {
                if (is_double($number) && is_float($number)) {
                    return $number;
                }
                return false;
            }
            return false;
        }
        return false;
    }

    public static function custom_carbon_today()
    {
        $now = Carbon::today()->format('d/m/Y');
        return $now;
    }

    public static function custom_carbon_today_after($date, $day=1)
    {
        if (self::custom_check_empty($date) !== false) {
            $changed_format=Helper::change_date_format($date,"d/m/Y");
            $date = Carbon::parse($changed_format)->addDay($day)->format('d/m/Y');
            return $date;
        }
        return false;
    }

    public static function custom_absolute_number($number)
    {
        if (self::custom_check_empty($number) !== false) {
            if (self::custom_check_numeric($number) !== false) {
                return abs($number);
            }
            return false;
        }
        return false;
    }

    public static function custom_calculate_sdtq_factor_for_pp_price($pp_price, $sdtq)
    {
        // sdtq açılımı Single Double Triple Quad
        if (self::custom_check_empty($pp_price) !== false && self::custom_check_empty($sdtq) !== false) {
            $factored_sdtq = [];
            $factored_sdtq['single_price'] = $pp_price * $sdtq['single_factor'];
            $factored_sdtq['double_price'] = $pp_price * $sdtq['double_factor'];
            $factored_sdtq['triple_price'] = $pp_price * $sdtq['triple_factor'];
            $factored_sdtq['quad_price'] = $pp_price * $sdtq['quad_factor'];
            $factored_sdtq['five_price'] = $pp_price * $sdtq['five_factor'];
            $factored_sdtq['six_price'] = $pp_price * $sdtq['six_factor'];
            return $factored_sdtq;
        }
        return false;
    }

    public static function custom_date_replace($date,$fromFormat,$toFormat)
    {
        if (self::custom_check_empty($date) !== false) {
            if(strpos($date,"/")){
                $changed_date = explode($fromFormat,$date);
                $last_date=implode($toFormat,$changed_date);
                return $last_date;
            }
            if(strpos($date,".")){
                $changed_date = explode($fromFormat,$date);
                $last_date=implode($toFormat,$changed_date);
                return $last_date;
            }
            if(strpos($date,"-")){
                $changed_date = explode($fromFormat,$date);
                $last_date=implode($toFormat,$changed_date);
                return $last_date;
            }
            return $date;

        }
        return false;
    }


    public static function custom_database_insert_column_value($table,$columns,$array)
    {
        if (self::custom_check_empty($table) !== false && self::custom_check_empty($columns) !== false && self::custom_check_empty($array) !== false) {
            if(count($columns) > 0 && count($array) > 0){
                foreach($array as $arr){
                    DB::table($table)->insert([
                        [
                            $columns[0] => $arr[0],
                            $columns[1] => $arr[1],
                            $columns[2] => $arr[2],
                            $columns[3] => $arr[3],
                        ]
                    ]);
                }
            }
            return false;
        }
        return false;
    }

    public static function convertToCurrency($amount)
    {
        if (!session()->has('localize.currency'))
        {
            session()->put(['localize.currency' => "TRY"]);
        }

        if (!session()->has('localize.usd') || !session()->has('localize.eur') || !session()->has('localize.gbp'))
        {
            $exchange = ExchangeRate::orderBy('date', 'desc')->first();

            if(Helper::custom_check_empty($exchange) !== false)
            {
                session()->put(['localize.usd' => $exchange->usd]);
                session()->put(['localize.eur' => $exchange->eur]);
                session()->put(['localize.gbp' => $exchange->gbp]);
                session()->put(['localize.date' => $exchange->date]);
            }
        }

        $price = $amount;

        if (session('localize.currency') === 'USD')
        {
            $price =  ( $amount / session('localize.usd') );
        }
        elseif (session('localize.currency') === 'EUR')
        {
            $price = ( $amount / session('localize.eur') );
        }
        elseif (session('localize.currency') === 'GBP')
        {
            $price = ( $amount / session('localize.gbp') );
        }

        return $price;
    }

    public static function generate_unique_number($from=1000000,$to=9999999)
    {
        $generated_number =  mt_rand($from,$to) + strtotime(date(now()));
        return (int) round($generated_number);
    }

    public static function custom_carbon_calculate_age($date)
    {
        if(Helper::custom_check_empty($date) !== false){
            return Carbon::parse($date)->age;
        }
        return false;
    }

}
