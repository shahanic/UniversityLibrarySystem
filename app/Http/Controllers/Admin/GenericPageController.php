<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Generic;
use App\Models\SubMenu;
use App\Models\Navigation;
use App\Models\Gallery;
use App\Models\Photo;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
// use Intervention\Image\ImageManagerStatic as Image;


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
        $new->status = $request->status;

        $res = $new->save();
        return response()->json(['success' => $res]);
        
    }

    // '/save-new-page'
    public function fetchSubAndNav($sub_id){
        return SubMenu::where('sub_menus.id', $sub_id)
        ->select('sub_menus.id',
                'sub_menus.navigation_id',
                )
        ->first();

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
                    'generics.status', 
                    'generics.content', 
                    'generics.sub_menu_id', 
                    'sub_menus.navigation_id',
                    'sub_menus.submenu')
            ->get();
    }

    
    
    // '/delete-pages'
    public function deletePages(Request $request){
        Generic::where('id', $request->id)->delete();
        return response()->json(['status' => 'success', 'code' => 1]);
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
                'generics.status', 
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
                'generics.status', 
                'sub_menus.submenu')
        ->get();
    }

    // public function uploadImage(Request $request)
    // {
    //     // Ensure the file is present in the request
    //     if (!$request->hasFile('upload')) {
    //         return response()->json(['error' => 'No file uploaded'], 400);
    //     }

    //     $file = $request->file('upload');
    //     $ext = $file->getClientOriginalExtension();
    //     $filename = explode('.', $file->getClientOriginalName())[0] . '_' . md5(now()) . '.' . $ext;

    //     // Initialize ImageManager with the specified driver
    //     $manager = new ImageManager(['driver' => 'imagick']); // Use 'imagick' if you prefer

    //     // Create the image and resize it
    //     $image = $manager->make($file)->resize(1920, null, function ($constraint) {
    //         $constraint->aspectRatio();
    //     });

    //     // Save the image to storage
    //     Storage::disk('public')->put('/images/' . $filename, (string) $image->encode());

    //     return response()->json(['url' => '/storage/images/' . $filename]);
    // }

    public function uploadImage(Request $request){
        $file = $request->upload;
        $ext = $file->getClientOriginalExtension();
        $filename = explode('.', $file->getClientOriginalName())[0].'_'.md5(now()).'.'.$ext;

        $manager = new ImageManager(new Driver);
        $image = $manager->read('data:image/jpeg;base64,'.base64_encode(File::get($file)));
        $image->scale(width: 1920);
        // insert watermark
        //$image->place('images/watermark.png');
        Storage::disk('public')->put('/article/'.$filename, $image->encode());

        return ['url' => '/storage/article/'.$filename];

    }

        // if($request->id){
        //     $new = Generic::find($request->id);
        //     $photo = new Photo;            
        //     $new->gallery_id = $request->gallery_id; 
        //     $new->gallery_id = $photo->gallery_id; 
        //     $res = $new->save();
        //     return response()->json(['success' => $res]);
            
        // }else{
        //     $new = new Generic;
        //     $new->title = $request->title; 
        //     $new->menu_title = $request->menu_title; 
        //     $new->slug = $request->slug;  
        //     $new->abstract = $request->abstract;  
        //     $new->content = $request->content;  
        //     $new->gallery_id = $request->gallery_id; 
        //     $new->navigation_id = $request->navigation_id;  
        //     $new->sub_menu_id = $request->sub_menu_id;
        //     $res = $new->save();
        //     return response()->json(['success' => $res]);
        // }
        
    // }
    public function __construct()
    {
        $this->middleware('auth');
    }



}
