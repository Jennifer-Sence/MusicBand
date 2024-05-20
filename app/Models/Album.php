<?php

namespace App\Models;

use App\Models\Band;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Album extends Model
{
    protected $table = 'albuns';
    use HasFactory;

    public function banda(){
        return $this-> belongsTo(Band::class,'band_id');
    }
}
