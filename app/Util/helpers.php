<?php
/**
 * Created by PhpStorm.
 * User: ubuntu
 * Date: 3/15/18
 * Time: 4:37 PM
 */

if (!function_exists('int_random')) {

    /**
     * generate secure random numbers
     *
     * @param int $min
     * @param int $max
     *
     * @param int $bytes
     *
     * @return int|number
     */
    function int_random($min = 10000000, $max = 99999999, $bytes = 4)
    {
        if (function_exists('openssl_random_pseudo_bytes')) {
            $strong = true;
            $n = 0;

            do {
                $n = hexdec(
                    bin2hex(openssl_random_pseudo_bytes($bytes, $strong))
                );
            } while ($n < $min || $n > $max);

            return $n;
        } else {
            return mt_rand($min, $max);
        }
    }
}


if (!function_exists('get_company_name')) {

    /**
     * get company name
     *
     * @param int $min
     * @param int $max
     *
     * @param int $bytes
     *
     * @return int|number
     */
    function get_company_name($id = 1)
    {
        $compname = \App\Models\Company::find($id) ->value('name');

        return $compname;
    }

}

if (!function_exists('get_company_address')) {

    /**
     * get company address
     *
     * @param int $min
     * @param int $max
     *
     * @param int $bytes
     *
     * @return int|number
     */
    function get_company_address($id = 1)
    {
        $address = \App\Models\Company::find($id) ->value('address');

        return $address;
    }
}


if (!function_exists('check_privilege')) {

    /**
     * check users privilege
     *
     * @param int $email
     * @param var $privilege id
     *
     * @param var $use case id
     *
     * @return boolean
     */
    function check_privilege($uid, $pid) //$pid= 1=view, 2=add, 3=edit, 4=delete
    {
        $id = \Illuminate\Support\Facades\Auth::user()->id;
        switch($pid)
        {
            case 1:

                $value = \App\Models\Privilege::query()->where('user_id',$id)
                    ->where('menu_id',$uid)->where('view',true)->first();

                break;

            case 2:
                $value = \App\Models\Privilege::query()->where('user_id',$id)
                    ->where('menu_id',$uid)->where('add',true)->first();
                break;

            case 3:
                $value = \App\Models\Privilege::query()->where('user_id',$id)
                    ->where('menu_id',$uid)->where('edit',true)->first();
                break;

            case 4:
                $value = \App\Models\Privilege::query()->where('user_id',$id)
                    ->where('menu_id',$uid)->where('delete',true)->first();
                break;

            default:
                $value = '';
        }

//        dd($pid);

        if(!empty($value))
        {
            return true;
        }else{
            return false;
        }
    }
}


if (!function_exists('addMonths')) {

    /**
     * get company address
     *
     * @param int $min
     * @param int $max
     *
     * @param int $bytes
     *
     * @return int|number
     */
    function addMonths($date, $months)
    {
        {
            $date = new \DateTime($date);
            $date->modify("+" . $months . " months");

            $date->modify("-1 day");

            return $date->format('Y-m-d');
        }
    }
}



if (!function_exists('get_resource_id')) {

    /**
     * get company address
     *
     * @param int $min
     * @param int $max
     *
     * @param int $bytes
     *
     * @return int|number
     */
    function get_resource_id($email)
    {

        $data = \App\Models\Hresource::query()->where('email',$email)->first();
        return $data->id;
    }

}

function convertToCamelCase(string $value, string $encoding = null) {
    if ($encoding == null){
        $encoding = mb_internal_encoding();
    }
    $stripChars = "()[]{}=?!.:,-_+\"#~/";
    $len = strlen( $stripChars );
    for($i = 0; $len > $i; $i ++) {
        $value = str_replace( $stripChars [$i], " ", $value );
    }
    $value = mb_convert_case( $value, MB_CASE_TITLE, $encoding );
    $value = preg_replace( "/\s+/", " ", $value );
    return $value;
}


if (!function_exists('get_doctor_external_id')) {

    /**
     * get company address
     *
     * @param int $min
     * @param int $max
     *
     * @param int $bytes
     *
     * @return int|number
     */
    function get_doctor_external_id($id)
    {
        $data = \App\Models\Hresource::query()->where('id',$id)->first();
        return $data->external_id;
    }

}



