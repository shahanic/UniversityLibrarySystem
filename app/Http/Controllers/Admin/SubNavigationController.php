<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Submenu;

class SubNavigationController extends Controller
{
    public function saveNav(Request $request){
        if($request->id){
            $new = Submenu::find($request->id);
        }else{
            $new = new Submenu;
        }

        $new->submenu = $request->submenu;    
     
        $res = $new->save();
        return $res;
        
    }
    public function getSubNavs(){
        return Navigation:: all();
    }

    public function deleteSubNavs(Request $request){
        Navigation::where('id', $request->id)->delete();
        return 1;
    }

    public function index(){
        return view('admin');
    }

}
