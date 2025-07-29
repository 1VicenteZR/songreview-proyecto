<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cancion extends Model
{
    use HasFactory;
    protected $table = 'canciones';
    protected $fillable = [
        'titulo',
        'urlSpotify',
        'duracion',
        'ruta_audio',
        'album_id'
    ];

    public function artistas()
    {
        return $this->belongsToMany(Artista::class, 'artista_cancion');
    }
    public function artista(): BelongsTo
    {
        return $this->belongsTo(Artista::class);
    }

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    public function calificaciones(): HasMany
    {
        return $this->hasMany(CalificacionCancion::class);
    }

    public function playlists(): BelongsToMany
    {
        return $this->belongsToMany(Playlist::class, 'playlist_canciones');
    }
}
