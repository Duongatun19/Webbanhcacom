<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Menu;

class MenuController extends Controller
{
    public function getAllMenu()
    {
        $data = Menu::get();
        return response()->json([
    		'message' => 'Success',
    		'data' => $data
    	]);
    }
    public function listMenu(Menu $menu)
    {
        $data = $menu->getList();
        return response()->json([
    		'message' => 'Success',
    		'data' => $data
    	]);
    }
    public function saveChangemenu(Request $request, Menu $menu){
        $inputTreeMenu = $request->menu;
        $data = $menu->saveTreeMenu($inputTreeMenu);
        return response()->json([
            'message' => 'Success'
        ]);
    }
    public function addNewMenu(Request $request, Menu $menu)
    {
        $request->validate($menu->rule());
        $data = $menu->saveNewMenu($request);
        return response()->json([
            'message' => 'Success'
        ]);
    }
    public function getEditMenu($id)
    {
        $data = Menu::where('id',$id)->first();
        if($data->status == 1){
            $data->status = true;
        }else{
            $data->status = false;
        }
        return response()->json([
    		'message' => 'Success',
    		'data' => $data
    	]);
    }
    public function saveEditMenuById(Request $request,Menu $menu, $id)
    {
        $request->validate($menu->ruleEdit());
        $data = $menu->saveEditMenuById($request, $id);
        return response()->json([
    		'message' => 'Success'
    	]);
    }
    public function deleteMenuById(Menu $menu, $id)
    {
        $data = $menu->deleteMenu($id);
        return response()->json([
    		'message' => 'Success'
    	]);
    }
}
