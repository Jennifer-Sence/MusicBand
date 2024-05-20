<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
    protected $table = 'bandas';
    use HasFactory;


    protected $fillable = [
        'name',
        'photo',
        'albums_count'
    ];

    public function albuns(){
        return $this->hasMany(Album:: class,'band_id');
    }
}
