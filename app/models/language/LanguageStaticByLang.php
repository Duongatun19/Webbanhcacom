<?php

namespace App\models\language;

use Illuminate\Database\Eloquent\Model;

class LanguageStaticByLang extends Model
{
    protected $table = 'language_static_by_lang';
    protected $fillable = [
        'languageStaticKey', 'languageCode', 'languageValue'
    ];
    protected $guarded = [
        'languageStaticKey', 'languageCode', 'languageValue'
    ];
}
