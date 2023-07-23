<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


if (! function_exists('gs')) {
    function gs()
    {
        $general = Cache::get('GeneralSetting');
        if (!$general) {
            $general = Setting::first();
            Cache::put('GeneralSetting', $general);
        }
        return $general;
    }
}

if (!function_exists('generate_slug')) {
    /**
     * function generate unique slug
     *
     * @param  mixed $slug
     * @return string
     */
    function generate_slug($slug = null)
    {
        return $slug != null ? Str::slug($slug) : Str::random();
    }
}

if (!function_exists('translate')) {

    /**
     * translate
     *
     * @param  mixed $text
     * @param  mixed $vars
     * @return string
     */
    function translate($text, $vars = null)
    {
        return $vars !== null ? __("language.$text", $vars) : __("language.$text");
    }
}


if (!function_exists('file_upload')) {

    /**
     * upload file
     *
     * @param  mixed $file
     * @param  mixed $folder
     * @param  mixed $current
     * @return boolean
     */
    function file_upload($file, $folder, $current = null)
    {
        $filename = generate_slug() . '.' . $file->getClientOriginalExtension();

        if ($current != null) delete_uploaded_file($current);

        if (!Storage::disk('public')->exists($folder)) {
            Storage::disk('public')->makeDirectory($folder);
        }

        return $file->storeAs($folder, $filename, 'public');
    }
}

if (!function_exists('convert_amount')) {
    /**
     * convert_amount
     *
     * @param  mixed $amount
     * @return string
     */
    function convert_amount($amount)
    {
        $general = Cache::get('Setting');
        return $general->currency_symbol. number_format($amount, 2, '.', ',');
    }
}


if (!function_exists('uploaded_file')) {

    /**
     * get uploaded file
     *
     * @param  mixed $file
     * @return boolean
     */
    function uploaded_file($file)
    {
        if ($file != null && Storage::disk('public')->exists($file)) {
            return Storage::disk('public')->url($file);
        }

        // $general = Cache::get('GeneralSetting');

        // return Storage::disk('public')->url($general->default_image);
    }
}

if (!function_exists('delete_uploaded_file')) {

    /**
     * delete uploaded file
     *
     * @param  mixed $file
     * @return boolean
     */
    function delete_uploaded_file($file)
    {
        if ($file != null && Storage::disk('public')->exists($file)) {
            Storage::disk('public')->delete($file);
        }
        return true;
    }
}


if (!function_exists('image_allowed_extensions')) {

    /**
     * image_allowed_extensions
     *
     * @return string
     */
    function image_allowed_extensions()
    {
        return 'mimes:jpg,jpeg,png,svg,gif,bmp,webp';
    }
}







