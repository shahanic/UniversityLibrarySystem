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
            $new = Generic::find($request->id);
        }else{
            $new = new Generic;
        }
        $new->title = $request->title; 
        $new->menu_title = $request->menu_title; 
        $new->slug = $request->slug;  
        $new->abstract = $request->abstract;  
        $new->content = $request->content;  
        $new->navigation_id = $request->navigation_id;  
        $new->sub_menu_id = $request->sub_menu_id;

        $res = $new->save();
        return $res;
        
    }
    public function retrieveAllPages() {
        return DB::table('sub_menus')
            ->join('generics', 'sub_menus.id', '=', 'generics.sub_menu_id')
            ->select('generics.id', 'generics.title', 'generics.menu_title', 'generics.abstract', 'generics.content', 'generics.sub_menu_id', 'sub_menus.submenu')
            ->get();
    }
    

    public function deletePages(Request $request){
        Generic::where('id', $request->id)->delete();
        return 1;
    }

    public function index(){
        return view('admin');
    }

    public function retrievePages($id){
        return DB::table('sub_menus')
        ->rightjoin('generics', 'sub_menus.id', '=', 'generics.sub_menu_id')
        ->where('sub_menus.id', $id)
        ->select('generics.id', 'generics.title', 'generics.menu_title', 'generics.slug', 'generics.abstract', 'generics.content', 'generics.navigation_id', 'generics.sub_menu_id', 'sub_menus.submenu')
        ->get();
    }

    public function retrieveEditPage($id){
        return DB::table('sub_menus')
        ->rightjoin('generics', 'sub_menus.id', '=', 'generics.sub_menu_id')
        ->where('sub_menus.id', $id)
        ->select('generics.id', 'generics.title', 'generics.menu_title', 'generics.slug', 'generics.abstract', 'generics.content', 'generics.navigation_id', 'generics.sub_menu_id', 'sub_menus.submenu')
        ->get();
    }



}
