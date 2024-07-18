<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Navigation;

use Illuminate\Support\Facades\DB;

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

    // public function getSubNav(Request $request){
    //     return Navigation::innerJoin();
    // }

    public function innerJoin(){
        $return = DB::table('navigations')
        ->rightjoin('sub_menus', 'navigations.id', '=', 'sub_menus.navigation_id')
        ->select('sub_menus.id', 'sub_menus.submenu')
        ->get();

        return $return;
    }

}
