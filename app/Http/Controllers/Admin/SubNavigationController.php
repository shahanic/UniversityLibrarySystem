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

// <?php

// namespace App\Http\Controllers\Admin;
// use App\Http\Controllers\Controller;

// use Illuminate\Http\Request;
// use App\Models\Navigation;
// use App\Models\Submenu;
// use Illuminate\Support\Facades\DB;

// class SubNavigationController extends Controller
// {
//     public function saveSubNav(Request $request){
//         if($request->id){
//             $new = SubMenu::find($request->id);
//         }else{
//             $new = new SubMenu;
//         }

//         $new->navigation_id = $request->navigation_id;   
//         $new->submenu = $request->submenu;    
     
//         $res = $new->save();
//         return $res;
        
//     }
//     public function getSubNavs(){
//         // return Navigation:: all();
//         return SubMenu:: all();
//     }

//     public function deleteSubNavs(Request $request){
//         // Navigation::where('id', $request->id)->delete();
//         SubMenu::where('id', $request->id)->delete();
//         return 1;
//     }

//     public function index(){
//         return view('admin');
//     }

//     public function navsubnav($id){
//         return DB::table('navigations')
//         ->rightjoin('sub_menus', 'navigations_id', '=', 'sub_menus.navigation_id')
//         ->where('navigation.id', $id)
//         ->select('sub_menus.id', 'sub_menus.navigation_id', 'sub_menus.submenu')
//         ->get();
//     }
    

// }
