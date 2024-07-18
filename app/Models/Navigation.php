<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubMenu;
use Illuminate\Support\Facades\DB;

class Navigation extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'id',
    //     'menu',
    // ];

    // public function subnav(){
    //     return $this->hasMany(SubMenu::class, 'navigation_id', 'id');
    // }

    public function innerJoin($id){
        return DB::table('navigations')
        ->rightjoin('sub_menus', 'navigations.id', '=', 'sub_menus.navigation_id')
        ->where('navigations.id', $id)
        ->select('sub_menus.id', 'sub_menus.submenu')
        ->get();

    }
}
