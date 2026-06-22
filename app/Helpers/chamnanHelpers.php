<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Write code on Method
 *
 * @return response()
 */
if (! function_exists('convertYmdToMdy')) {

    function convertYmdToMdy($date)
    {
        return Carbon::createFromFormat('Y-m-d', $date)->format('m-d-Y');
    }
}

if (!function_exists('admin_layout')) {
    function admin_layout($layout)
    {
        return 'themes/admin/' . $layout;
    }
}

if (!function_exists('front_layout')) {
    function front_layout($layout)
    {
        return 'themes/shop/' . $layout;
    }
}

//get reference_no
if (!function_exists('reference_no')) {
    function reference_no($code, $length)
    {
        $reference_no = '';
        $degit = 0;

        switch ($length) {
            case 1:
                $degit = 9;
                break;
            case 2:
                $degit = 99;
                break;
            case 3:
                $degit = 999;
                break;
            case 4:
                $degit = 9999;
                break;
            case 5:
                $degit = 99999;
                break;
            case 6:
                $degit = 999999;
                break;
            case 7:
                $degit = 9999999;
                break;
            case 8:
                $degit = 99999999;
                break;
            case 9:
                $degit = 999999999;
                break;
            case 10:
                $degit = 9999999999;
                break;
            case 11:
                $degit = 99999999999;
                break;
            case 12:
                $degit = 999999999999;
                break;
            case 13:
                $degit = 9999999999999;
                break;
            case 14:
                $degit = 99999999999999;
                break;
            case 15:
                $degit = 999999999999999;
                break;
            case 16:
                $degit = 9999999999999999;
                break;
            case 17:
                $degit = 99999999999999999;
                break;
            case 18:
                $degit = 999999999999999999;
                break;
            case 19:
                $degit = 9999999999999999999;
                break;
            case 20:
                $degit = 99999999999999999999;
                break;

            default:
                echo "Under 20 degits";
                break;
        }

        $setting = DB::table('settings')->first();

        switch ($code) {
            case 'student':
                $reference_no = $setting->student_prefix . '-' . random_int(0, $degit);
                break;
            case 'attendance':
                $reference_no = $setting->attendance_prefix . '-' . random_int(0, $degit);
                break;
            case 'book':
                $reference_no = $setting->book_prefix . '-' . random_int(0, $degit);
                break;
            case 'borrow':
                $reference_no = $setting->borrow_prefix . '-' . random_int(0, $degit);
                break;
            default:
                $reference_no = 'No prefix data';
        }

        return $reference_no;
    }
}

/**
 * Write code on Method
 *
 * @return response()
 */
if (! function_exists('convertMdyToYmd')) {
    function convertMdyToYmd($date)
    {
        return Carbon::createFromFormat('m-d-Y', $date)->format('Y-m-d');
    }
}

/*
 * Method for check status  
 */

if (!function_exists('checkStatus')) {

    function checkStatus($status)
    {
        if ($status == 'pending') {
            return "<span class='badge badge-warning text-white'>" . __('admin.' . $status) . "</span>";
        } elseif ($status == 'success' || $status == 'borrowed') {
            return "<span class='badge badge-success text-white'>" . __('admin.' . $status) . "</span>";
        } elseif ($status == 'repayed') {
            return "<span class='badge badge-secondary'>" . __('admin.' . $status) . "</span>";
        } elseif ($status == 'disable') {
            return "<span class='badge badge-danger text-white'>" . __('admin.' . $status) . "</span>";
        }
    }
}

if (!function_exists('api_status')) {

    function api_status($status)
    {
        if ($status == '1') {
            return "<span class='badge badge-success text-white'>" . __('admin.active') . "</span>";
        } elseif ($status == 0) {
            return "<span class='badge badge-danger text-white'>" . __('admin.inactive') . "</span>";
        } 
    }
}

/**
 * Method check credit card (Mastercard , visa card, ....)
 */

if (!function_exists('checkCreditCard')) {
    function checkCreditCard($card_number)
    {
        return 'hello world ';
    }
}

/*
 * Method admin url()
 */

if (!function_exists('admin_url')) {
    function admin_url($url)
    {
        $prefix = prefix_url();
        $prefix = trim($prefix, '/');
        $url = ltrim($url, '/');
        $path = $prefix === '' ? 'admin' : ($prefix . '/admin');
        $path = $url === '' ? $path : ($path . '/' . $url);
        return url($path);
    }
}

if (!function_exists('front_url')) {
    function front_url($url)
    {
        return url($url);
    }
}

if (!function_exists('image_encrypt')) {
    function image_encrypt($asset)
    {
        return hash('sha256', '<img class="img-fluid" src="' . asset($asset) . '">');
    }
}

if (!function_exists('is_active')) {
    function is_active()
    {
        return (request()->is(request()->path()) ? 'active' : '');
    }
}

if (!function_exists('clear_tag')) {
    function clear_tag($html)
    {
        return htmlentities($html, ENT_QUOTES, 'UTF-8', false);
    }
}

if (!function_exists('decode_html')) {
    function decode_html($script)
    {
        return html_entity_decode($script);
    }
}

// admin redirect
if (!function_exists('admin_redirect')) {
    function admin_redirect($url)
    {
        return redirect(prefix_url() . '/admin/' . $url);
    }
}

// Encryption function
if (!function_exists('encrypt')) {
    function encrypt($data, $encryptionKey)
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('AES-128-CBC'));
        $encrypted = openssl_encrypt($data, 'AES-128-CBC', $encryptionKey, 0, $iv);
        return base64_encode($iv . $encrypted);
    }
}

// Decryption function
if (!function_exists('decrypt')) {
    function decrypt($encryptedData, $encryptionKey)
    {
        $encryptedData = base64_decode($encryptedData);
        $ivLength = openssl_cipher_iv_length('AES-128-CBC');
        $iv = substr($encryptedData, 0, $ivLength);
        $encrypted = substr($encryptedData, $ivLength);
        return openssl_decrypt($encrypted, 'AES-128-CBC', $encryptionKey, 0, $iv);
    }
}

if (!function_exists('prefix_url')) {
    function prefix_url()
    {
        try {
            $prefix = DB::table('settings')->first()?->site_prefix ?? '';
            // normalize: remove surrounding slashes and whitespace
            return is_string($prefix) ? trim($prefix) : '';
        } catch (\Throwable $e) {
            return '';
        }
    }
}

