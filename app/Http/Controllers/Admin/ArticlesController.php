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
        $new->type = $request->type;    
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
    public function saveImages(Request $request, $galleryId, $slug, $type) {
        // dd($request->src);
        // dd($request->file('src'));
            foreach ($request->file('src') as $file) {
            $filename = time() . '-' . $file->getClientOriginalName();
            // $file->storeAs('public/images', $filename); // Adjust path as needed
            // $file->move(public_path('images'), $filename);

            Storage::disk('public')->put('/images/'.$filename, $request);

            $image = new Photo();
            $image->gallery_id = $galleryId;
            $image->name = $slug; // Or set to some meaningful name
            $image->type = $type;
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

    public function deleteImage(Request $request)
    {
    $filename = $request->input('src');
    $path = 'public/' . $filename;

        if (Storage::exists($path)) {
            Storage::delete($path);
            return response()->json(['success' => 'Image deleted successfully.']);
        } else {
            return response()->json(['error' => 'Image not found.'], 404);
        }


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

   public function retrieveEditArticle($id){ //dont forget to put if where theres no gallery id!
        $article = Article::where('articles.id', $id)
        ->select(
            'articles.title',
            'articles.abstract',
            'articles.slug',
            'articles.content',
            'articles.status',
            'articles.gallery_id',
            'articles.date',
        )
        ->first();

        if ($article->gallery_id) {
            // Retrieve photo URLs related to the gallery
            $photos = DB::table('articles')
                ->join('galleries', 'articles.gallery_id', '=', 'galleries.id')
                ->join('photos', 'galleries.id', '=', 'photos.gallery_id')
                ->where('articles.id', $id)
                ->select('photos.src')
                ->get();
            
            // Convert the photos to an array of URLs
            $photoUrls = $photos->pluck('src');
        } else {
            $photoUrls = [];
        }
    
        // Append photos to the article data
        $article->photos = $photoUrls;
    
        
        return $article;

 
    }



    public function retrieveImages($id)
    {
        return DB::table('articles')
            ->join('galleries', 'articles.gallery_id', '=', 'galleries.id')
            ->join('photos', 'galleries.id', '=', 'photos.gallery_id')
            ->where('articles.id', $id)
            ->select(
                'photos.id as photo_id',
                'photos.src',
                'photos.name'
            )
            ->get();
    }


    public function __construct()
    {
        $this->middleware('auth');
    }

}
 