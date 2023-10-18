<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class BannerAds extends Model
{
    protected $table = "banner_ads";
    public function saveBanner($request)
    {
    	$id = $request->id;
        if($id != ""){
            $query = BannerAds::where([
                'id' => $id
             ])->first();
            if ($query) {
                $query->name = $request->name;
                $query->slug = to_slug($request->name);
                $query->content = json_encode($request->content);
                $query->description = json_encode($request->description);
                $query->status = $request->status;
                $query->image = $request->image;
                $query->save();
            }else{
                $query = new BannerAds();
                $query->name = $request->name;
                $query->slug = to_slug($request->name);
                $query->content = json_encode($request->content);
                $query->description = json_encode($request->description);
                $query->status = $request->status;
                $query->image = $request->image;
                $query->save();
            }
            
        }else{
                $query = new BannerAds();
                $query->name = $request->name;
                $query->slug = to_slug($request->name);
                $query->content = json_encode($request->content);
                $query->description = json_encode($request->description);
                $query->status = $request->status;
                $query->image = $request->image;
                $query->save();
            
        }
        return $query;
    }
}
