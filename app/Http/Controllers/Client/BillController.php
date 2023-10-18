<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\bill\Bill;
use App\models\bill\BillDetail;
use Auth,DB;

class BillController extends Controller
{
    public function createBill(Request $request){
        if(Auth::guard('customer')->user() == null){
            $cart = session()->get('cart', []);
            $code_bill = rand();
            DB::beginTransaction();
            try {
                $bill = new Bill();
                $bill->code_customer = 0;
                $bill->code_bill = $code_bill;
                $bill->cus_phone = $request->phone;
                $bill->cus_address = $request->address;
                $bill->cus_name = $request->name_customer;
                $bill->note = $request->note;
                $bill->cus_email= $request->email ;
                $bill->statu = 0;
                $bill->save();
                
                $billdetail = new BillDetail();
                $billdetail->code_bill = $code_bill;
                $billdetail->code_product = $request->idpro;
                $billdetail->name = $request->proname;
                $billdetail->price = $request->proprice;
                $billdetail->qty = 1;
                $billdetail->images = $request->proimage;
                $billdetail->save();
                
                DB::commit();
                session()->forget('cart');
                return redirect()->route('home')->with('success',"Gửi đơn hàng thành công");
            } catch (Exception $e) {
                DB::rollBack();
                return back()->with('error',"Gửi đơn hàng thất bại");
                throw new Exception($e->getMessage());
            }
            
        }
        
    }
}
