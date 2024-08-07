<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class QuickLinksController extends Controller
{
    public function index(){
        return view('admin');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

}
