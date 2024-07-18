<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Navigation;

class SubMenu extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'navigation_id',
        'submenu',
    ];

    public function navigation(){
        return $this->belongsTo(Navigation::class);
    }
}
