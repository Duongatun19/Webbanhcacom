<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $table = "promotion";
    public function savePromotion($request)
    {
    	$id = $request->id;
        if($id != ""){
            $query = Promotion::where([
                'id' => $id
             ])->first();
            if ($query) {
                $query->name = $request->name;
                $query->description = $request->description;
                $query->link = $request->link;
                $query->image = $request->image;
                $query->status = $request->status;
                $query->save();
            }else{
                $query = new Promotion();
                $query->name = $request->name;
                $query->description = $request->description;
                $query->link = $request->link;
                $query->image = $request->image;
                $query->status = $request->status;
                $query->save();
            }
            
        }else{
                $query = new Promotion();
                $query->name = $request->name;
                $query->description = $request->description;
                $query->link = $request->link;
                $query->image = $request->image;
                $query->status = $request->status;;
                $query->save();
            
        }
        return $query;
    }
}
