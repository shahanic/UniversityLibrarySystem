<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\SubMenu;

class SubNavigationController extends Controller
{
    public function index(){
        return view('admin');
    }

    public function navsubnav($id){
        return DB::table('navigations')
        ->join('sub_menus', 'navigations.id', '=', 'sub_menus.navigation_id')
        ->where('navigations.id', $id)
        ->select('sub_menus.id', 
                 'sub_menus.submenu', 
                 'navigations.id as nav_id',
                 'navigations.menu')
        ->get();
    }

    // public function navsubnav($id) {
    //     // Query for all sub_menus with their related navigations
    //     $subMenus = DB::table('navigations')
    //         ->leftJoin('sub_menus', 'navigations.id', '=', 'sub_menus.navigation_id')
    //         ->where('navigations.id', $id)
    //         ->select('sub_menus.id as sub_menu_id',
    //                  'sub_menus.navigation_id as sub_menu_navigation_id', 
    //                  'sub_menus.submenu', 
    //                  'navigations.id as navigation_id',
    //                  'navigations.menu');
    
    //     // Query for all navigations with their related sub_menus
    //     $navigations = DB::table('sub_menus')
    //         ->rightJoin('navigations', 'sub_menus.navigation_id', '=', 'navigations.id')
    //         ->where('navigations.id', $id)
    //         ->select('sub_menus.id as sub_menu_id',
    //                  'sub_menus.navigation_id as sub_menu_navigation_id', 
    //                  'sub_menus.submenu', 
    //                  'navigations.id as navigation_id',
    //                  'navigations.menu');
    
    //     // Combine both queries
    //     return $subMenus->union($navigations)
    //         ->get();
    // }
    

    public function saveSubNav(Request $request){
        // dd('hello');
        if($request->id){
            $new = SubMenu::find($request->id);   
           
        }else{ 
            $new = new SubMenu;
        }
        
        $new->navigation_id = $request->navigation_id;
        $new->submenu = $request->submenu;    
        $new->slug = $request->slug;
     
        $res = $new->save();

        return response()->json(['success' => $res]);
        
    }
    public function getSubNavs(){
        return SubMenu:: all();
    }

    public function deleteSubNavs(Request $request){
        SubMenu::where('id', $request->id)->delete();
        return 1;
    }

    





}