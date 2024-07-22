<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Pages;
use App\Models\SubMenu;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function savePages(Request $request){
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
        ->where('subnav.id', $id)
        ->select('pages.id', 'pages.name', 'pages.code', 'pages.nav_id', 'pages.subnav_id')
        ->get();
    }



}
