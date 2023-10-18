<?php

namespace App\Library;

use App\models\Client\Language;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Config;

class Locate
{
    public function setLocate()
    {
        $code = '';
        $language = new Language();
        $languages = $language->getLanguages();
        if (Session::has('language')) {
            $code = Session::get('language');
        }
        if (Request::cookie('language') != null && !array_key_exists($code, $languages)) {
            $code = Request::cookie('language');
        }
        if (!empty(Request::server('HTTP_ACCEPT_LANGUAGE')) && !array_key_exists($code, $languages)) {
            $detect = '';
            $browser_languages = explode(',', Request::server('HTTP_ACCEPT_LANGUAGE'));
            foreach ($browser_languages as $browser_language) {
                foreach ($languages as $key => $value) {
                    $locale = explode(',', $value['locale']);
                    if (in_array($browser_language, $locale)) {
                        $detect = $key;
                        break 2;
                    }
                }
            }
            if (!$detect) {
                foreach ($browser_languages as $browser_language) {
                    if (array_key_exists(strtolower($browser_language), $languages)) {
                        $detect = strtolower($browser_language);
                        break;
                    }
                }
            }
            $code = $detect ? $detect : '';
        }
        if (!array_key_exists($code, $languages)) {
            $code = getConfig('config_language');
        }
        if (!Session::has('language') || Session::get('language') != $code) {
            Session::put('language', $code);
        }
        if (Request::cookie('language') == null || Request::cookie('language') != $code) {
            Cookie::queue('language', $code, time() + 60 * 60 * 24 * 30);
        }
        Config::set('app.locale', $code);
    }
}
