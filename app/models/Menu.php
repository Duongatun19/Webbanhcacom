<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = "menu";
    public function getList(){
        $query = $this->get()->toArray();
        $data = $this->buildTree($query,0);
        return $data;
    }
    public function rule()
    {
        return [
            'title' => 'required',
            'link' => 'required',
            'status' => 'required',
            'parent_id' => 'required'
        ];
    }
    public function ruleEdit()
    {
        return [
            'title' => 'required',
            'link' => 'required',
            'status' => 'required',
        ];
    }
    public function buildTree($elements, $parentId = 0) {
        $branch = array();
        foreach ($elements as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = $this->buildTree($elements, $element['id']);
                $element['children'] = isset($children) ? $children : [];
                $branch[] = $element;
            }
        }
        return $branch;
    }

    public function saveTreeMenu($inputTreeMenu)
    {
        // var_dump($inputTreeMenu);
        $del = Menu::truncate();
        foreach($inputTreeMenu as $item){
            $query = new Menu();
            $query->parent_id = $item['parent_id'];
            $query->title = $item['title'];
            $query->link = $item['link'];
            $query->group_id = $item['group_id'];
            $query->item_id = $item['item_id'];
            $query->position = $item['position'];
            $query->status = $item['status'];
            $query->save();
        }
        return $query;
    }
    public function saveNewMenu($request)
    {
        $query = new Menu();
        $query->title = $request->title;
        $query->link = $request->link;
        $query->parent_id = $request->parent_id;
        $query->status = $request->status;
        $query->save();
        return $query;
    }
    public function saveEditMenuById($request, $id)
    {
        $query = $this->where('id',$id)->first();
        $query->title = $request->title;
        $query->link = $request->link;
        $query->status = $request->status;
        $query->save();
        return $query;
    }
    public function deleteMenu($id)
    {
        $query = $this->where('id',$id)->first();
        // $id_one = $query->id;
        // $parentMenu = $this->where('parent_id',$id_one)->get()->toArray();
        // if(count($parentMenu) > 0){
        //     $parent_new = $this->where('parent_id',$id_one)->first();
        //     $parent_new->parent_id = $query->parent_id;
        //     $parent_new->save();
        //     $query->delete();
        // }else{
        //     $query->delete();
        // }
        $query->delete();
    }
}
