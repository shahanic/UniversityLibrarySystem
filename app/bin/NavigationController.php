<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Navigation;

class NavigationController extends Controller
{
    public function saveNav(Request $request){
        if($request->id){
            $new = Navigation::find($request->id);
        }else{
            $new = new Navigation;
        }

        $new->menu = $request->menu;    
     
        $res = $new->save();
        return $res;
        
    }
    public function getNavs(){
        return Navigation:: all();
    }

    public function deleteNavs(Request $request){
        Navigation::where('id', $request->id)->delete();
        return 1;
    }

    public function index(){
        return view('admin');
    }

}
