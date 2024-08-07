<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Faq;


class FaqsController extends Controller
{
  
    public function saveFaq(Request $request){
        if($request->id){
            $new = Faq::find($request->id);
        }else{
            $new = new Faq;
        }

        $new->question = $request->question;    
        $new->answer = $request->answer;
        $new->slug = $request->slug;
        $new->category = $request->category;
        $new->status = $request->status;
        $new->views = 1;


        $res = $new->save();
        return $res;
        
    }
    public function getFaqs(){
        return Faq:: all();
    }

    public function deleteFaq(Request $request){
        Faq::where('id', $request->id)->delete();
        return 1;
    }
    public function index(){
        return view('admin');
    }
    public function __construct()
    {
        $this->middleware('auth');
    }

    
}