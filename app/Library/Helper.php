<?php
if (!function_exists('handle')) {
    function handle($request)
    {
        $input = $request->all();
        if ($input) {
            array_walk_recursive($input, function (&$item) {
                $item = trim($item);
                $item = ($item == "") ? null : $item;
            });
            $request->merge($input);
        }
        return $request->all();
    }
}
if(!function_exists('uploadImage')){
    function uploadImage($img){
        $nameAvatar = rand().$img->getClientOriginalName();
        $img->move('uploads/customer/', $nameAvatar);
        return '/uploads/customer/'.$nameAvatar;
    }
}
if(!function_exists('stripVN')){
    function stripVN($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);
    
        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        return $str;
    }
}
if (!function_exists('getConfig')) {
    function getConfig($key)
    {
        $setting = new \App\models\Client\Setting();
        return $setting->getValue($key);
    }
}

if (!function_exists('getLanguage')) {
    function getLanguage($key)
    {
        $session =  Session::get('locale');
        if($session != null){
            $code = Session::get('locale');
        }else{
            Session::put('locale', app()->getLocale());
        }
        $code = Session::get('locale');
        $lang = new \App\models\frontend\LanguageStaticByLang();
        return $lang->getLanguageValue($key, $code);
    }
}
if(!function_exists('toArrayLanguage')){
    function toArrayLanguage($value){
        $session =  Session::get('locale');
        if($session != null){
            $code = Session::get('locale');
        }else{
            Session::put('locale', app()->getLocale());
        }
        $code = Session::get('locale');
        $arr = [];
        $obj = new stdClass();
        $obj->lang_code = $code;
        $obj->content = $value;
        $arr[] = $obj;
        return json_encode($arr);
    }
}
if(!function_exists('languageName')){
    function languageName($arrName){
        $arr = json_decode($arrName);
        $session =  Session::get('locale');
        if($session != null){
            $code = Session::get('locale');
        }else{
            Session::put('locale', app()->getLocale());
        }
        $code = Session::get('locale');
        foreach($arr as $item){
            if($item->lang_code == $code){
                return $item->content;
            }
        }
    }
}
if(!function_exists('checkExistCart')){
    function checkExistCart($proid){
        $cart = Session::get('cart', []);
        foreach($cart as $item){
            if($item['idpro'] == $proid){
                return true;
            }else{
                return false;
            }
        }
    }
}
if (!function_exists('getMenu')) {
    function getMenu($position)
    {
        $data = [];
        $menu = new \App\models\Client\Menu();
        $menuGroup = new \App\models\Client\MenuGroup();
        $result = $menuGroup->getMenuPosition($position);
        foreach ($result as $i => $item) {
            $data[$i] = $menu->getTree(1, $item['id'], getConfig('config_logo'));
        }
        return $data;
    }
}

if (!function_exists('getActiveLanguages')) {
    function getActiveLanguages()
    {
        $language = new \App\models\frontend\Language();
        $data = $language->getLanguages();
        return $data;
    }
}

if (!function_exists('getCurrentLang')) {

    function getCurrentLang()
    {
        $locale = request()->cookie('locale');
        if (!isset($locale)) {
            $locale = getConfig('config_language');
        }
        return $locale;
    }
}

if (!function_exists('shorten_string')) {
    function shorten_string($string, $words = 50)
    {
        $string = preg_replace('/(?<=\S,)(?=\S)/', ' ', $string);
        $string = str_replace("\n", " ", $string);
        $array = explode(" ", $string);
        if (count($array) <= $words) {
            $retval = $string;
        } else {
            array_splice($array, $words);
            $retval = implode(" ", $array) . " ...";
        }
        return $retval;
    }
}

if(!function_exists('to_slug')){
    function to_slug($str){
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }
}

if (!function_exists('resizeImage')) {
    function resizeImage($originalImagePath, $newImagePath, $width = 50, $height = 50)
    {
        $name = preg_split('/[\/]+/', $originalImagePath);
        if (!file_exists('cache/' . $name[0] . '/' . $name[1])) {
            mkdir('cache/' . $name[0] . '/' . $name[1], 0777, true);
        }
        if (file_exists($originalImagePath)) {
            if (!file_exists($newImagePath)) {
                $image = imagecreatefromstring(file_get_contents($originalImagePath));
                $thumb_width = $width;
                $thumb_height = $height;
                $width = imagesx($image);
                $height = imagesy($image);
                $original_aspect = $width / $height;
                $thumb_aspect = $thumb_width / $thumb_height;
                if ($original_aspect >= $thumb_aspect) {
                    $new_height = $thumb_height;
                    $new_width = $width / ($height / $thumb_height);
                } else {
                    $new_width = $thumb_width;
                    $new_height = $height / ($width / $thumb_width);
                }
                $thumb = imagecreatetruecolor($thumb_width, $thumb_height);
                imagecopyresampled($thumb,
                    $image,
                    0 - ($new_width - $thumb_width) / 2,
                    0 - ($new_height - $thumb_height) / 2,
                    0, 0,
                    $new_width, $new_height,
                    $width, $height);
                imagejpeg($thumb, $newImagePath, 80);
            }
        }
    }
}
