<?php

namespace App\models\frontend;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Cache;

class Language extends Model
{
    protected $table = 'language';

    public function getLanguages()
    {
        $expiresAt = Carbon::now()->addHours(24);
        if (Cache::has('languages')) {
            $value = Cache::get('languages');
            return $value;
        } else {
            $query = Language::where('status', 1)->get();
            $data = [];
            foreach ($query as $item) {
                $data[$item->code] = $item;
            }
            return $data;
        }
    }
}
