<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Pages;
use Illuminate\Support\Facades\DB;

class ArticlesController extends Controller
{
    public function saveArticle(Request $request){
        if($request->id){
            $new = Article::find($request->id);
        }else{
            $new = new Article;
        }
        $new->title = $request->title; 
        $new->abstract = $request->abstract; 
        $new->slug = $request->slug; 
        $new->content = $request->content;    
        $new->status = $request->status;    
        $new->gallery_id = $request->gallery_id;    
        $new->date = $request->date;  
        $res = $new->save();
        return $res;
        
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

    


}
 