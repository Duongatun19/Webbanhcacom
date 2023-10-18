<?php

namespace App\Http\Controllers\Api\Bill;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Bill\BillDetail;
use App\models\Bill\Bill;

class BillController extends Controller
{
    public function add(Request $request, Bill $bill)
    {
        $data = $bill->saveBill($request);
        return response()->json([
        	'data'=>$data,
        	'message'=>'success'
        ]);
    }
    public function draft(Request $request)
    {
        $keyword = $request->keyword;
        $status = $request->status;
        if($keyword == ""){
            $data = Bill::with([
                'bill_detail'=>function($query) {
                    $query->select('id','name','price','code_bill');
                }
            ])
            ->where('statu',$status)->leftJoin('customer', function($join){
                $join->on('customer.id','=','bill.code_customer');
            })
            ->select('bill.*','customer.name as customer_name')
            ->orderBy('id','DESC')->get();
        }else{
            $data = Bill::with([
                'bill_detail'=>function($query) {
                    $query->select('id','name','price', 'code_bill');
                }
            ])
            ->where('code_bill', 'LIKE', '%'.$keyword.'%')->where('statu',$status)->orderBy('id','DESC')->get()->toArray();
        }
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }
    public function detail($code, Bill $bill)
    {
        $data = $bill->getDetail($code);
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }
    public function changeStatus(Request $request)
    {
        $data = Bill::where('code_bill',$request->code_bill)->first();
        $data->statu = $request->status;
        $data->save();
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }
    public function deleteBill($code)
    {
        $dataBill = Bill::where('code_bill', $code);
        $dataBillDetail = BillDetail::where('code_bill', $code);
        $dataBill->delete();
        $dataBillDetail->delete();
        return response()->json([
            'message' => 'Delete success'
        ]);
    }
}
