<?php

namespace App\models\language;

use Illuminate\Database\Eloquent\Model;

class LanguageStatic extends Model
{
    protected $table = 'language_static';
    protected $fillable = [
        'languageKey', 'languageDefaultValue'
    ];
    protected $guarded = [
        'languageKey', 'languageDefaultValue'
    ];

    public function addLanguageStatic($request)
    {
        $query = new LanguageStatic();
        $query->languageKey = trim($request->languageKey);
        $query->languageDefaultValue = trim($request->languageDefaultValue);
        $query->save();
        return $query;
    }

    public function editLanguageStatic($request)
    {
        $query = LanguageStatic::where('languageKey', $request->languageKey)->update(handle($request));
        return $query;
    }
}
