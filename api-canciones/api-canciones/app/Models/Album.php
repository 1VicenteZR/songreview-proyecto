<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    use HasFactory;
    protected $table = 'albumes';
    protected $fillable = [
        'titulo',
        'fecha_lanzamiento',
        'imagen',
        'urlSpotify'
    ];

    // Relación many-to-many con artistas
    public function artistas()
    {
        return $this->belongsToMany(Artista::class, 'album_artista', 'album_id', 'artista_id');
    }
    
    // Mantener relación singular para compatibilidad
    public function artista()
    {
        return $this->belongsTo(Artista::class);
    }

    public function canciones()
    {
        return $this->hasMany(Cancion::class);
    }

    public function calificaciones()
    {
        return $this->hasMany(CalificacionAlbum::class);
    }
}
