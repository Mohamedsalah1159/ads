<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertiser extends Model
{
    protected $table = 'advertiser';
    protected $fillable = [
        'id',
        'name',
        'email',
        'created_at',
        'updated_at',
    ];
    protected $hidden = [
        'created_at',
        'updated_at'  
    ];
    ############################ relations ########################
    public function ads(){
        return $this->hasOne('App\Models\Ad', 'advertiser_id', 'id');
    }
}
