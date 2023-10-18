<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\language\Language;
use App\models\language\LanguageStatic;
use App\models\language\LanguageStaticByLang;
use DB;

class LanguageController extends Controller
{
    public function saveLanguage(Request $request, Language $language)
    {
        $data = $language->saveData($request);
        return $data;
    }

    public function detailLanguage(Request $request, Language $language)
    {
        $data = $language->detail($request);
        return $data;
    }

    public function searchLanguage(Request $request, Language $language)
    {
        $data = $language->search($request);
        return $data;
    }

    public function deleteLanguage(Language $language,$code)
    {
        $data = $language->deleteLang($code);
        return response()->json([
            'success' => true,
            "message" => "Delete success",
        ]);
    }

    public function getActiveLanguage()
    {
        $languages = Language::where('status', 1)->orderBy('priority', 'ASC')->get();
        return response()->json([
            'success' => true,
            "message" => "GetListLanguageSuccess",
            'data' => $languages,
        ]);
    }

    public function saveLanguageStatic(Request $request, LanguageStatic $languageStatic)
    {
        $languageKey = $request->languageKey;
        $data = LanguageStatic::where('languageKey', $languageKey)->first();
        if ($data) {
            $languageStatic->editLanguageStatic($request);
            return response()->json([
                'success' => true,
                'message' => "EditSuccess",
            ]);
        } else {
            $languageStatic->addLanguageStatic($request);
            return response()->json([
                'success' => true,
                'message' => "AddSuccess",
            ]);
        }
    }

    public function saveLanguageStaticByLang(Request $request)
    {
        $staticText = json_decode($request->static);
        LanguageStaticByLang::query()->delete();
        for ($i = 0; $i < count($staticText); $i++) {
            $data = [];
            $lang = (array)$staticText[$i]->lang;
            if (!empty($lang)) {
                foreach ($lang as $k => $itemLang) {
                    $data[] = [
                        'languageStaticKey' => $staticText[$i]->info->languageKey,
                        'languageCode' => $k,
                        'languageValue' => $itemLang,
                    ];
                }
                LanguageStaticByLang::insert($data);
            }
        }
        return response()->json([
            'success' => true,
            'message' => "EditSuccess",
        ]);
    }

    public function searchLanguageStatic()
    {
        $objLang = new Language();
        $data['languages'] = $objLang->get();

        $langStatic = LanguageStatic::get();
        $dataLangStatic = [];
        foreach ($langStatic as $i => $item) {
            $dataLangStatic [$i]['languageKey'] = $item->languageKey;
            $dataLangStatic [$i]['languageDefaultValue'] = $item->languageDefaultValue;
        }
        $langStaticByLang = LanguageStaticByLang::get();
        $dataLangStaticByLang = [];
        foreach ($langStaticByLang as $k => $item) {
            $dataLangStaticByLang [$k]['languageStaticKey'] = $item->languageStaticKey;
            $dataLangStaticByLang [$k]['languageCode'] = $item->languageCode;
            $dataLangStaticByLang [$k]['languageValue'] = $item->languageValue;
        }
        $data = [];
        for ($i = 0; $i < count($dataLangStatic); $i++) {
            $vco = [];
            for ($k = 0; $k < count($dataLangStaticByLang); $k++) {
                if ($dataLangStaticByLang[$k]['languageStaticKey'] === $dataLangStatic[$i]['languageKey'] && $dataLangStaticByLang[$k]['languageCode'] !== '') {
                    $vco[$dataLangStaticByLang[$k]['languageCode']] = $dataLangStaticByLang[$k]['languageValue'];
                }
            }
            $data[$i]['info'] = $dataLangStatic[$i];
            $data[$i]['lang'] = (object)$vco;
        }
        return response()->json([
            'success' => true,
            "message" => "Get List Language Success",
            'data' => $data,
        ]);
    }
}
