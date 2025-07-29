<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artista extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'descripcion', 'imagen', 'urlSpotify'];
    public function albums()
    {
        return $this->belongsToMany(Album::class, 'album_artista');
    }

    public function canciones()
    {
        return $this->belongsToMany(Cancion::class, 'artista_cancion');
    }
}
