<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = [
        'id',
        'name',
        'ads_id',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'  
    ];
    ############################ relations ########################

    public function ads(){
        return $this->belongsTo('App\Models\Ad', 'ads_id', 'id');
    }
}
