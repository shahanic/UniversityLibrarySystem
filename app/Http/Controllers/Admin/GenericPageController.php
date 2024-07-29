<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Generic;
use App\Models\SubMenu;
use Illuminate\Support\Facades\DB;

class GenericPageController extends Controller
{
    public function savePage(Request $request){
        if($request->id){
            $new = Pages::find($request->id);
        }else{
            $new = new Pages;
        }
        $new->name = $request->name; 
        $new->code = $request->code;  
        $new->nav_id = $request->nav_id;  
        $res = $new->save();
        return $res;
        
    }
    public function getPages(){
        return Pages:: all();
    }

    public function deletePages(Request $request){
        Pages::where('id', $request->id)->delete();
        return 1;
    }

    public function index(){
        return view('admin');
    }

    public function retrievePages($id){
        return DB::table('sub_menus')
        ->rightjoin('pages', 'sub_menus.id', '=', 'pages.subnav_id')
        ->where('sub_menus.id', $id)
        ->select('pages.name', 'pages.code', 'sub_menus.submenu')
        ->get();
    }



}
