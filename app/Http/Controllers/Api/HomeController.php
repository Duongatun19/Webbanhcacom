<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Bill\Bill;
use Carbon\Carbon;
use App\Customer;
use Spatie\Analytics\Period;
use App\models\product\Product;
use  App\models\product\Category;

class HomeController extends Controller
{
    public function chart(Request $request)
    {
        $dayStart = $request->dateStart && $request->dateEnd ? $request->dateStart : Carbon::now()->subDay(6)->toDateString();
        $dayEnd = $request->dateStart && $request->dateEnd ? $request->dateEnd : Carbon::now()->toDateString();

        $start = strtotime($dayStart);
        $end1 = strtotime($dayEnd);
        $interval   = 1*24*60*60;
        
        $chunks = array();
        for($time=$start; $time<=$end1; $time+=$interval){
            $chunks[] = date('Y-m-d', $time);
        }
        $data = [];
        $monney = [];
        return response()->json([
            'data'=> [],
            'message' => 'success'
        ]);
    }
    public function revenue()
    {
        $obj = new \stdClass;
        $today = Carbon::now()->toDateString();
        $totalrevenue = $billForDay = Bill::where('updated_at', 'like', '%' .$today . '%')
        ->get();
        $new_customer = 0;
        foreach($totalrevenue as $item){
            $email_custom_build = $item->cus_email;
            $checkIsset = Customer::where('email',$email_custom_build)->first();
            if(!$checkIsset){
                $new_customer = ++$new_customer;
            }
        }
        $new_register_custom = Customer::where('updated_at', 'like', '%' .$today . '%')->get();
        if(count($new_register_custom) > 0){
            $new_customer = $new_customer + count($new_register_custom);
        }
        $obj->revenue = number_format($totalrevenue->sum('total_money'));
        $obj->total_bill = count($totalrevenue);
        $obj->new_cus = $new_customer;
        return response()->json([
            'data'=> $obj,
            'message' => 'success'
        ]);
    }
    public function statisticalBill()
    {
        // $chua_thanh_toan = Bill::where('statu',0)->get()->count();
        // $chua_giao_hang = Bill::where('statu',1)->get()->count(); //đơn hàng chưa giao là đơn hàng đã thanh toán nhưng chưa giao
        // $chua_hoan_tat = Bill::where(['statu' => 0,'statu' => 1])->get()->count(); // đơn hàng chưa hoàn tất là đơn hàng mà khách hàng thêm vào giỏ hàng nhưng chưa thanh toán hoặc chưa vân chuyển
        // $dang_giao_hang = Bill::where('statu',2)->get()->count();
        // $obj = new \stdClass;
        // $obj->chua_thanh_toan = $chua_thanh_toan;
        // $obj->chua_giao_hang = $chua_giao_hang;
        // $obj->chua_hoan_tat = $chua_hoan_tat;
        // $obj->dang_giao_hang = $dang_giao_hang;
        return response()->json([
            'data'=> [],
            'message' => 'success'
        ]);
    }
    public function searchNavbar(Request $request)
    {
        $keyword = $request->keyword;
        $data = [];
        if($keyword){
            $product = Product::where('name', 'like', '%' .$keyword . '%')->where('language','vi')->get();
            $customer = Customer::where('name', 'like', '%' .$keyword . '%')->get();
            // $bill = Bill::where('cus_name','like', '%' .$keyword . '%')->get();
            if(count($product)>0){
                foreach($product as $item){
                    $cate = Category::where('id',$item->category)->where('language','vi')->first();
                    $obj = new \stdClass;
                    $obj->name = $item->name;
                    $obj->id = $item->code;
                    $obj->image = $item->images ? json_decode($item->images)[0] : '';
                    $obj->option =  $cate->name;
                    $obj->type =  'product';
                    $data[]=$obj;
                }
            }
            if(count($customer)>0){
                foreach($customer as $item){
                    $obj = new \stdClass;
                    $obj->name = $item->name;
                    $obj->id = $item->id;
                    $obj->image = 'https://cube.elemecdn.com/3/7c/3ea6beec64369c2642b92c6726f1epng.png';
                    $obj->option =  $cate->email;
                    $obj->type =  'customer';
                    $data[]=$obj;
                }
            }
            if(count($bill)>0){
                foreach($bill as $item){
                    $obj = new \stdClass;
                    $obj->name = $item->cus_name;
                    $obj->id = $item->code_bill;
                    $obj->image = 'https://st4.depositphotos.com/16262510/21432/v/1600/depositphotos_214326750-stock-illustration-bill-vector-icon-isolated-on.jpg';
                    $obj->option =  $item->created_at;
                    $obj->type =  'bill';
                    $data[]=$obj;
                }
            }
        }
        return response()->json([
            'data'=> $data,
            'message' => 'success'
        ]);
    }
}
