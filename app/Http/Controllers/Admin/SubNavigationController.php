<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Navigation;
use App\Models\SubMenu;

class SubNavigationController extends Controller
{
    public function saveSubNav(Request $request){
        if($request->id){
            $new = SubMenu::find($request->id);
        }else{
            $new = new SubMenu;
        }
        $new->navigation_id = $request->navigation_id; 
        $new->submenu = $request->submenu;    
     
        $res = $new->save();
        return $res;
        
    }
    public function getSubNavs(){
        return SubMenu:: all();
    }

    public function deleteSubNavs(Request $request){
        SubMenu::where('id', $request->id)->delete();
        return 1;
    }

    public function index(){
        return view('admin');
    }




}
