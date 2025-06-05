<?php

namespace App\Models;

// Bibliotecas que facilitam o delete em cascata
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
Use App\Models\Review;

class User2 extends Model
{
    use HasFactory;

    protected $table = 'users2';
    protected $fillable = ['name','email', 'password'];

    public function reviews(){
        return $this->hasMany(Review::class,'user_id','id');
    }
    
    protected static function booted()
    {
        static::deleting(function ($user) {
            // Isso deletará automaticamente todas as reviews quando o user for deletado
            $user->reviews()->delete();
        });
    }
}