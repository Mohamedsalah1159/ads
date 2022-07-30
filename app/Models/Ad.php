<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = 'ads';
    protected $fillable = [
        'id',
        'type',
        'title',
        'description',
        'tags',
        'start_date',
        'advertiser_id',
        'cat_id',

        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'  
    ];
    ############################ relations ########################
    public function category(){
        return $this->belongsTo('App\Models\Category', 'cat_id', 'id');
    }
    public function advertiser(){
        return $this->belongsTo('App\Models\Advertiser', 'advertiser_id', 'id');
    }
    public function tags(){
        return $this->hasMany('App\Models\Tag', 'ads_id', 'id');
    }
}
