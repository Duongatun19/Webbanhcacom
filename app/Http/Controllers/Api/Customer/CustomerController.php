<?php

namespace App\Http\Controllers\Api\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;

class CustomerController extends Controller
{
    public function list(Request $request)
    {
        $keyword = $request->keyword;
        if($keyword == ""){
            $data = Customer::orderBy('id','DESC')->get();
        }else{
            $data = Customer::where('name', 'LIKE', '%'.$keyword.'%')->orderBy('id','DESC')->get()->toArray();
        }
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }
    public function create(Request $request)
    {
        $data = new Customer();
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->note = $request->note;
        $data->status = 0;
        $data->save();
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }
    public function getEdit($id)
    {
        $data = Customer::find($id);
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }
    public function activeCustomer(Request $request)
    {
        $data = Customer::where('email',$request->email)->first();
        $data->status = 1;
        $data->password = bcrypt($request->password);
        $data->save();
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }
    public function changeStatus(Request $request)
    {
        $data = Customer::where('email',$request->email)->first();
        $data->status = 0;
        $data->save();
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }
    public function postEdit(Request $request)
    {
        $data = Customer::where('id',$request->id)->first();
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->save();
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }
}
