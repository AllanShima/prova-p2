<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
Use App\Models\Review;

class User2 extends Model
{
    protected $table = 'users2';
    protected $fillable = ['name','email', 'password'];

    public function reviews(){
        return $this->hasMany(Review::class,'user_id','id');
    }
}