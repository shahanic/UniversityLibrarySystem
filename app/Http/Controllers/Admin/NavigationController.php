<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Navigation;
use App\Models\SubMenu;
use Illuminate\Support\Facades\DB;

class NavigationController extends Controller{

    // '/save-nav'
    public function saveNav(Request $request){
        if($request->id){
            $new = Navigation::find($request->id);
        }else{
            $new = new Navigation;
        }

        $new->menu = $request->menu;    
        $new->slug = $request->slug; 
        
        $res = $new->save();
        return $res;
        
    }
    // '/get-navs'
    public function getNavs(){
        return Navigation:: all();
    }

    // '/delete-navs'
    public function deleteNavs(Request $request){
        Navigation::where('id', $request->id)->delete();
        return 1;
    }

    public function index(){
        return view('admin');
    }

    public function getSubNav(Request $request){
        // Create an instance of Navigation model
        $navigation = new Navigation();
        // Call the instance method
        $result = $navigation->innerJoin($request->id);
        return response()->json($result);
    }
        
    // '/retrieve-navs'
    public function retrieveNavs(){
        return response()->json(Navigation::select('navigations.id', 'navigations.menu')->get());
    }
    public function __construct()
    {
        $this->middleware('auth');
    }

}
