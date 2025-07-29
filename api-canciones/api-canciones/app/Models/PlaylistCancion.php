<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlaylistCancion extends Model
{
    use HasFactory;
    
    protected $table = 'playlist_canciones';
    protected $fillable = ['playlist_id', 'cancion_id'];
    
    public $timestamps = true; // Habilitar timestamps

    public function playlist(): BelongsTo
    {
        return $this->belongsTo(Playlist::class);
    }

    public function cancion(): BelongsTo
    {
        return $this->belongsTo(Cancion::class);
    }
}
