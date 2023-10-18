<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\models\product\ProductBrands;
use Illuminate\Http\Request;

class ProductBrandController extends Controller
{
    public function add(Request $request, ProductBrands $productBrands)
    {
        $data = $productBrands->createOrEdit($request);
        return response()->json([
            'message' => 'Save Success',
            'data'=> $data
        ],200);
    }
    public function list(Request $request, ProductBrands $productBrands)
    {
        $data = $productBrands->getAll($request);
        return response()->json([
            'message' => 'Get data Success',
            'data'=> $data
        ],200);
    }
    public function edit($id, ProductBrands $productBrands)
    {
        $data = $productBrands->find($id);
        return response()->json([
            'message' => 'Get data Success',
            'data'=> $data
        ],200);
    }
    public function delete($id, ProductBrands $productBrands)
    {
        $data = $productBrands->deleteBrands($id);
        return response()->json([
            'message' => 'Delete data Success',
            'data'=> $data
        ],200);
    }
}
