<?php

namespace App\models\Bill;

use Illuminate\Database\Eloquent\Model;
use App\models\Bill\BillDetail;
use DB;

class Bill extends Model
{
	protected $table = "bill"; 
	public function bill_detail()
    {
        return $this->hasMany(BillDetail::class, 'code_bill', 'code_bill')
            ->select(['code_bill', 'code_product', 'qty', 'name', 'price', 'images','discount', 'color', 'size']);
	}
	public function getDetail($code)
	{
		$query = $this->with(['bill_detail'])->where('code_bill',$code)->first();
		return $query;
	}
    public function saveBill($request)
    {
		if($request->code_bill != ""){
			DB::beginTransaction();
			try {
				$query = Bill::where('code_bill',$request->code_bill)->first();
				$query->code_customer = $request->code_customer;
				$query->total_money = $request->total_money;
				$query->note = $request->note;
				$query->promotion = 0;
				$query->transport = $request->transport;
				$query->transport_price = $request->transport_price;
				$query->save();
				if(count($request->bill_detail)> 0){
                    $billdelete = BillDetail::where('code_bill',$request->code_bill)->get();
                    foreach($billdelete as $item){
                        if ($item != null) {
                            $item->delete();
                        }
                    }
                            
					foreach ($request->bill_detail as $value) {
						if(isset($value['code_bill'])){
							
							$billDetail = new BillDetail();
							$billDetail->code_product = $value['code_product'];
							$billDetail->code_bill = $value['code_bill'];
							$billDetail->qty = $value['qty'];
							$billDetail->name = $value['name'];
							$billDetail->price = $value['price'];
							$billDetail->images = $value['images'];
							// $billDetail->discount = $value['discount'];
							$billDetail->save();
						}else{
							$billDetails = new BillDetail();
							$billDetails->code_product = $value['id'];
							$billDetails->qty = $value['qty'];
							$billDetails->code_bill = $request->code_bill;
							$billDetails->name = $value['name'];
							$billDetails->price = $value['price'];
							$billDetails->images = $value['images'];
							// $billDetails->discount = $value['discount'];
							$billDetails->save();
						}
					}
				}
				DB::commit();
			} catch (\Throwable $e) {
				DB::rollBack();
				throw $e;
			}
		}else{
			DB::beginTransaction();
			try {
				$billCode = rand();
				$query = new Bill();
				$query->code_bill = $billCode;
				$query->code_customer = $request->code_customer;
				$query->total_money = $request->total_money;
				$query->statu = 0;
				$query->note = $request->note;
				$query->promotion = 0;
				$query->transport = $request->transport;
				$query->transport_price = $request->transport_price;
				$query->save();

				if(count($request->bill_detail)> 0){
					foreach ($request->bill_detail as $value) {
						$billDetail = new BillDetail();
						$billDetail->code_bill = $billCode;
						$billDetail->code_product = $value['id'];
						$billDetail->qty = $value['qty'];
						$billDetail->name = $value['name'];
						$billDetail->price = $value['price'];
						$billDetail->images = $value['images'];
						// $billDetail->discount = $value['discount'];
						$billDetail->save();
					}
				}
				DB::commit();
			} catch (\Throwable $e) {
			DB::rollBack();
			throw $e;
			}
		}
    	
    	return $query;
    }
    
}
