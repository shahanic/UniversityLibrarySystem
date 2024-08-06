<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Photo;
use App\Models\Gallery;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ArticlesController extends Controller
{
    public function saveArticle(Request $request){
        if($request->id){
            $new = Article::find($request->id);
        }else{
            $new = new Article;
            $gallery = new Gallery;
            $gallery->title = $request->title;
            $gallery->slug = $request->slug;
            $gallery->status = $request->status; // edit where it can be changed
            $gallery->save();

            $new->gallery_id = $gallery->id;
        }
        $new->title = $request->title; 
        $new->abstract = $request->abstract; 
        $new->slug = $request->slug; 
        $new->content = $request->content;    
        $new->status = $request->status;    
        $new->date = $request->date; 
        
        $res = $new->save();
        // Call method to handle image uploads
        if ($request->hasFile('src')) {
            $this->saveImages($request->file('src'), $new->gallery_id, $request->slug);
        }

        return response()->json($new);
    }

    // Method to save images
    public function saveImages(Request $request, $galleryId, $slug) {
        foreach ($request->file('src') as $file) {
            $filename = time() . '-' . $file->getClientOriginalName();
            // $file->storeAs('public/images', $filename); // Adjust path as needed
            $file->move(public_path('images'), $filename);

            $image = new Photo();
            $image->gallery_id = $galleryId;
            $image->name = $slug; // Or set to some meaningful name
            // $image->slug = $slug;
            $image->src = 'images/' . $filename;
            $image->save();
        }
    }
    public function getArticles(){
        return Article:: all();
    }

    public function deleteArticles(Request $request){
        Article::where('id', $request->id)->delete();
        return 1;
    }

    public function index(){
        return view('admin');
    }

    public function retrieveArticle($id){
        return DB::table('pages')
        ->rightjoin('articles', 'pages.id', '=', 'articles.pages_id')
        ->where('pages.id', $id)
        ->select('articles.id', 'articles.title', 'articles.abstract', 'articles.content')
        ->get();
    }

   public function retrieveEditArticle($id){
        return Article::where('articles.id', $id)
        ->select(
            'articles.title',
            'articles.abstract',
            'articles.slug',
            'articles.content',
            'articles.title',
            'articles.gallery_id',
            'articles.date',
        )
        ->get();
    }

    // public function store(Request $request)
    // {
    //     $file = $request->image;
    //     $filename = $file->getClientOriginalName();
    //     // $ext = $file->getClientOriginalExtension();
    //     // $filename = $originalFileName . '.' . $ext;
        
    //     Storage::disk('public')->put('/imgs/' . $filename, File::get($file));

    //     $imageModel = new Photo();
    //     $imageModel->name = $filename;
    //     $imageModel->save();

    //     return 1;
    // }


}
 