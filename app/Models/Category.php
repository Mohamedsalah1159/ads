<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'  
    ];
    ############################ relations ########################

    public function ads(){
        return $this->hasMany('App\Models\Ad', 'cat_id', 'id');
    }
}
