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
                 'sub_menus.slug', 
                 'navigations.id as nav_id',
                 'navigations.menu')
        ->get();
    }

    //add and edit
    public function saveSubNav(Request $request){
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

    public function retrieveSubNavs($id){
        return SubMenu::where('sub_menus.navigation_id', $id)
        ->select('sub_menus.id', 
                 'sub_menus.submenu')
        ->get();
    }

}