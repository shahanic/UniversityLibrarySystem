<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Generic;
use App\Models\SubMenu;
use App\Models\Navigation;
use Illuminate\Support\Facades\DB;

class GenericPageController extends Controller
{   
    // '/save-page'
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
        return response()->json(['success' => $res]);
        
    }

    // '/save-new-page'
    public function saveNewPage($sub_id, Request $request){
        $ids =  SubMenu::where('sub_menus.id', $sub_id)
        ->select('sub_menus.id',
                'sub_menus.navigation_id',
                )
        ->first();
        if ($ids) {
            $new = new Generic;
            $new->title = $request->title; 
            $new->menu_title = $request->menu_title; 
            $new->slug = $request->slug;  
            $new->abstract = $request->abstract;  
            $new->content = $request->content;  
            $new->navigation_id = $ids->navigation_id;  
            $new->sub_menu_id = $ids->id;
            $res = $new->save();

            return response()->json(['success' => $res]);
        }
    }


    // '/get-pages'
    public function retrieveAllPages() {
        return DB::table('sub_menus')
            ->join('generics', 'sub_menus.id', '=', 'generics.sub_menu_id')
            ->select('generics.id', 
                    'generics.title', 
                    'generics.menu_title', 
                    'generics.slug', 
                    'generics.abstract', 
                    'generics.content', 
                    'generics.sub_menu_id', 
                    'sub_menus.navigation_id',
                    'sub_menus.submenu')
            ->get();
    }
    
    // '/delete-pages'
    public function deletePages(Request $request){
        Generic::where('id', $request->id)->delete();
        return 1;
    }

    public function index(){
        return view('admin');
    }

    // /get-page/{id}'
    public function retrievePages($id){
        return DB::table('sub_menus')
        ->rightjoin('generics', 'sub_menus.id', '=', 'generics.sub_menu_id')
        ->where('sub_menus.id', $id)
        ->select('generics.id', 
                'generics.title', 
                'generics.menu_title', 
                'generics.slug', 
                'generics.abstract', 
                'generics.content', 
                'generics.navigation_id', 
                'sub_menus.navigation_id',
                'generics.sub_menu_id',
                'sub_menus.submenu')
        ->get();
    }

    //'/edit-page/{id}'
    public function retrieveEditPage($id){
        return DB::table('sub_menus')
        ->rightjoin('generics', 'sub_menus.id', '=', 'generics.sub_menu_id')
        ->where('generics.id', $id)
        ->select('generics.id', 
                'generics.title', 
                'generics.menu_title', 
                'generics.slug', 
                'generics.abstract', 
                'generics.content', 
                'generics.navigation_id', 
                'generics.sub_menu_id', 
                'sub_menus.submenu')
        ->get();
    }

}
