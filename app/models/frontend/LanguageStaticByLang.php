<?php

namespace App\models\frontend;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Cache;

class LanguageStaticByLang extends Model
{
    protected $table = 'language_static_by_lang';
    
    public function getLanguageValue($key, $code)
    {
        $expiresAt = Carbon::now()->addHours(24);
        $result = LanguageStaticByLang::where([
            ['languageStaticKey', '=', $key],
            ['languageCode', '=', $code]
        ])->first();
        if ($result) {
            $value = $result['languageValue'];
        } else {
            $value = $key;
        }
        return $value;
    }
}
