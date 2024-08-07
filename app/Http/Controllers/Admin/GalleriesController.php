<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\Photos;
use Illuminate\Support\Facades\DB;

class GalleriesController extends Controller{

    // '/save-nav'
    public function saveGallery(Request $request){
        if($request->id){
            $new = Gallery::find($request->id);
        }else{
            $new = new Gallery;
        }

        $new->title = $request->title;    
        $new->slug = $request->slug; 
        
        $res = $new->save();
        return $res;
        
    }
    // '/get-navs'
    public function getGalleries(){
        return Gallery:: all();
    }

    // '/delete-navs'
    public function deleteGalleries(Request $request){
        Gallery::where('id', $request->id)->delete();
        return 1;
    }

    public function index(){
        return view('admin');
    }

    public function getGallery(Request $request){
        // Create an instance of Navigation model
        $gallery = new Gallery();
        // Call the instance method
        $result = $gallery->innerJoin($request->id);
        return response()->json($result);
    }
        
    // '/retrieve-navs'
    public function retrieveGalleries(){
        return response()->json(Gallery::select('galleries.id', 'galleries.title')->get());
    }
    public function __construct()
    {
        $this->middleware('auth');
    }
}
