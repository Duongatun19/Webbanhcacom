<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\models\product\ProductCombo;
use Illuminate\Http\Request;

class ProductComboController extends Controller
{
    public function add(Request $request, ProductCombo $productCombo)
    {
        $data = $productCombo->createOrEdit($request);
        return response()->json([
            'message' => 'Save Success',
            'data'=> $data
        ],200);
    }
    public function list(Request $request, ProductCombo $productCombo)
    {
        $data = $productCombo->getAll($request);
        return response()->json([
            'message' => 'Get data Success',
            'data'=> $data
        ],200);
    }
    public function edit($id, ProductCombo $productCombo)
    {
        $data = $productCombo->with([
            'products'=>function($query){
                $query->with('cate')->with('brand')->where(['status'=>1])->select();
            }
        ])->find($id);
        return response()->json([
            'message' => 'Get data Success',
            'data'=> $data
        ],200);
    }
    public function delete($id, ProductCombo $productCombo)
    {
        $data = $productCombo->deleteBrands($id);
        return response()->json([
            'message' => 'Delete data Success',
            'data'=> $data
        ],200);
    }
}
