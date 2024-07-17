<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;


class AccountsController extends Controller
{
  
    public function saveUser(Request $request){
        if($request->id){
            $new = User::find($request->id);
        }else{
            $new = new User;
        }

        $new->name = $request->name;    
        $new->username = $request->username;
        $new->email = $request->email;
        $new->role = $request->role;
        $new->password = $request->password;

        $res = $new->save();
        return $res;
        
    }
    public function getUsers(){
        return User:: all();
    }

    public function deleteUser(Request $request){
        User::where('id', $request->id)->delete();
        return 1;
    }
    public function index(){
        return view('admin');
    }












}
