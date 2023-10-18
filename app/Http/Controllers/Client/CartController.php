<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\product\Product;
use Cart;
use App\models\Bill\BillDetail;
use App\models\Bill\Bill;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


 


class CartController extends Controller
{


    public function checkout(){
            $data['cart'] = session()->get('cart', []);
            $data['profile'] = Auth::guard('customer')->user();
            return view('cart.checkout',$data);
        
    }
    public function postBill(Request $request){
        $profile = Auth::guard('customer')->user();
        $cart = session()->get('cart', []);
        $code_bill = rand();
        $address = $request->billingAddress . ', ' . $request->billingAddress2 .', '. $request->billingAddress1;
        DB::beginTransaction();
			try {
				$query = new Bill();
				$query->code_bill = $code_bill;
				$query->code_customer = $profile ? $profile->id : 0;
				$query->total_money = $request->total_money;
				$query->statu = 0;
				$query->note = $request->note;
                $query->cus_name = $request->billingName;
                $query->cus_phone = $request->billingPhone;
                $query->cus_email = $request->billingEmail;
                $query->cus_address = $address;
                $query->transport_price = $request->shippingMethod ? $request->shippingMethod : 0;
				$query->save();
					
                foreach($cart as $key => $item){
                    $billdetail = new BillDetail();
                    $billdetail->code_bill = $code_bill;
                    $billdetail->code_product = $item['id'];
                    $billdetail->name = languageName($item['name']);
                    $billdetail->price = $item['price'];
                    $billdetail->qty = $item['quantity'];
                    $billdetail->images = $item['image'];
                    $billdetail->discount = $item['discount'];
                    $billdetail->save();
                }
				DB::commit();
                $request->session()->forget('cart');
                return Redirect::to('/')->with('successBill', 'Gửi đơn hàng thành công');
			} catch (\Throwable $e) {
			DB::rollBack();
			throw $e;
                return back()->with('error','Gửi đơn hàng thất bại');
			}
    }
    public function listCart(){
        $data['cart'] = session()->get('cart', []);
        return view('cart.list',$data);
    }
    public function addToCart(Request $request)
    {
        $id = $request->id;
        $product = Product::findOrFail($id);
        $cart = session()->get('cart',[]);
        if (isset($request->quantity)) {
            if(isset($cart[$id])) {
                $cart[$id]['quantity'] = $cart[$id]['quantity'] + $request->quantity;

            } else {
                $cart[$id] = [
                    "id" => $product->id,
                    "name" => $product->name,
                    "quantity" => $request->quantity,
                    "price" => $product->price,
                    "discount" => $product->discount,
                    "cate_slug" => $product->cate_slug,
                    "type_slug" => $product->type_slug,
                    "slug"=>$product->slug,
                    "image" => json_decode($product->images)[0],
                ];
            }
        } else {
            if(isset($cart[$id])) {
                $cart[$id]['quantity'] = $cart[$id]['quantity'] + 1;
         
            } else {
                $cart[$id] = [
                    "id" => $product->id,
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                    "discount" => $product->discount,
                    "cate_slug" => $product->cate_slug,
                    "type_slug" => $product->type_slug,
                    "slug"=>$product->slug,
                    "image" => json_decode($product->images)[0],
                    
                ];
            }
        }
        
        session()->put('cart', $cart);
        $data['cart'] = session()->get('cart',[]);
        $data['cartItemName'] = $cart[$id]['name'];
        $view1 = view('cart.header-cart', $data)->render();
        $view2 = view('cou', $data)->render();
        // $view4 = view('cart.popup-cart-desktop', $data)->render();
        // $view5 = view('cart.popup-cart-mobile',$data)->render();
        return response()->json([
         
            'html2' => $view2,
            // 'html3' => $view4,
            // 'html5' => $view5
        ]);
    }
    public function update(Request $request)
    {
        if($request->id && $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            $data['cart'] = session()->get('cart',[]);
            $data['cartItemName'] = $cart[$request->id]['name'];
            $view1 = view('cart.header-cart', $data)->render();
            $view2 = view('cart.count-cart', $data)->render();
            $view3 = view('cart.list-cart-ajax', $data)->render();
            // $view4 = view('cart.popup-cart-desktop', $data)->render();
            // $view5 = view('cart.popup-cart-mobile',$data)->render();
            // $view6 = view('cart.list-cart-mobile',$data)->render();
            return response()->json([
                'html1' => $view1,
                'html2' => $view2,
                'html3' => $view3,
                // 'html4' => $view4,
                // 'html5' => $view5,
                // 'html6' => $view6
            ]);
        }
        
    }
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            $data['cartItemName'] = $cart[$request->id]['name'];
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            $data['cart'] = session()->get('cart',[]);
            $view1 = view('cart.header-cart', $data)->render();
            $view2 = view('cart.count-cart', $data)->render();
            $view3 = view('cart.list-cart-ajax', $data)->render();
            // $view4 = view('cart.popup-cart-desktop', $data)->render();
            // $view6 = view('cart.list-cart-mobile',$data)->render();
            return response()->json([
                'html1' => $view1,
                'html2' => $view2,
                'html3' => $view3,
                // 'html4' => $view4,
                // 'html6' => $view6

            ]);
        }
    }
}
