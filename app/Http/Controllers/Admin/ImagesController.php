<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Photo;
use App\Models\Gallery;

use Illuminate\Http\Request;

class ImagesController extends Controller
{
    public function fetch()
    {
        return Photo::all();
    }

    public function index(){
        return view('admin');
    }
    
    public function galleryphoto($id){
        return Gallery::join('photos', 'galleries.id', 'photos.gallery_id')
        ->where('galleries.id', $id)
        ->select('photos.id', 
                'photos.name',
                'photos.type',
                'photos.src',
                'photos.gallery_id',
                'photos.updated_at',
                 'galleries.id as gal_id',
                 'galleries.title')
        ->get();

    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'gallery_id' => 'required|integer', 
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'src.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate each image file
        ]);

        $photos = [];

        if ($request->hasFile('src')) {
            foreach ($request->file('src') as $image) {
                // Handle the image file upload
                $imageName = time() . '_' . $image->getClientOriginalName(); // Create a unique file name
                $image->move(public_path('images'), $imageName); // Move the file to the public/images directory

                // Save the image data into the database
                $photo = new Photo();
                $photo->gallery_id = $validatedData['gallery_id'];  
                $photo->name = $validatedData['name'];
                $photo->type = $validatedData['type'];
                $photo->src = 'images/' . $imageName; // Save the path relative to the public directory
               
                $photo->save();

                $photos[] = $photo;
            }
        }

        return response()->json([
            'success' => 'Images uploaded successfully!', 
            'photos' => $photos
        ]);
    }


    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'type' => 'required|string|max:255',
    //         'src' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image file
    //     ]);
    
    //     // Handle the image file upload
    //     $image = $request->file('src');
    //     $imageName = time() . '_' . $image->getClientOriginalName(); // Create a unique file name
    //     $image->move(public_path('images'), $imageName); // Move the file to the public/images directory
    
    //     // Save the image data into the database
    //     $photo = new Photo();
    //     $photo->name = $validatedData['name'];
    //     $photo->type = $validatedData['type'];
    //     $photo->src = 'images/' . $imageName; // Save the path relative to the public directory
    //     $photo->save();
    
    //     return response()->json(['success' => 'Image uploaded successfully!', 'photo' => $photo]);
    // }
    

    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:photos,id'
        ]);

        $photos = Photo::findOrFail($request->id);

        // Delete the image file from storage
        \Storage::disk('public')->delete($photos->src);

        // Delete the image record from the database
        $photos->delete();

        return response()->json(['success' => 'Image deleted successfully!']);
    }
    
    public function getImages(){
        return Photo:: all();
        
}
    
public function retrieveImages($id){
    return SubMenu::where('photos.gallery_id', $id)
    ->select('photos.id', 
             'photos.photo')
    ->get();
}
public function __construct()
{
    $this->middleware('auth');
}


}
