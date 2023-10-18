<?php

namespace App\models\language;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'language';

    protected $fillable = [
        'code', 'name', 'status', 'priority', 'flagIcon', 'viName'
    ];
    protected $guarded = [
        'code', 'name', 'status', 'priority', 'flagIcon', 'viName'
    ];

    public function saveData($request)
    {
        $code = $request->code;
        $data = Language::where('code', $code)->first();
        if ($data) {
            Language::where('code', $request->code)->update([
                'name' => $request->name, 'status' => $request->status, 'priority' => $request->priority, 'flagIcon' => $request->flagIcon, 'viName' => $request->viName
            ]);
            return response()->json([
                'success' => true,
                'message' => "Update success",
            ]);
        } else {
            Language::create([
                'code' => $request->code, 'name' => $request->name, 'status' => $request->status, 'priority' => $request->priority, 'flagIcon' => $request->flagIcon, 'viName' => $request->viName
            ]);
            return response()->json([
                'success' => true,
                'message' => "Add success",
            ]);
        }
    }

    public function search($request)
    {
        $query = Language::where(function ($query) use ($request) {
            if (isset($request->name) && $request->name != '') {
                $query->where('name', 'like', '%' . $request->name . '%');
            }
            if (isset($request->status) && $request->status != -1) {
                $query->where('status', '=', $request->status);
            }
        })
            ->select('language.*')
            ->orderBy('priority', 'ASC');

        $totalRow = $query->get();

        if (isset($request->pageIndex) && $request->pageIndex > 0) {
            if ($request->pageIndex == 1) {
                $query->offset(0);
            } else {
                $query->offset(($request->pageIndex - 1) * $request->pageSize);
            }
        }

        if ($request->pageSize == null) {
            $data = $query->get();
        } else {
            $data = $query->limit($request->pageSize)->get();
        }
        return response()->json([
            'success' => true,
            'message' => "Search success",
            'data' => $data,
            'totalRow' => $totalRow->count(),
        ]);
    }

    public function detail($request)
    {
        $code = $request->code;
        $data = Language::where('code', $code)->first();
        return response()->json([
            'success' => true,
            'message' => "Get success",
            'data' => $data,
        ]);
    }

    public function deleteLang($code)
    {
        $lang = Language::where('code', $code)->first();
        $lang->delete();
        return response()->json([
            'success' => true,
            "message" => "Delete success",
        ]);
    }
}
