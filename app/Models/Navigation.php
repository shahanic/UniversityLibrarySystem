<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubMenu;


class Navigation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'menu',
    ];

    public function subnav(){
        return $this->hasMany(SubMenu::class, 'navigation_id', 'id');
    }


}
