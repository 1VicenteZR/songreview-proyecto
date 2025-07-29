<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalificacionAlbum extends Model
{
    use HasFactory;
    protected $table = 'calificacion_album';
    protected $fillable = ['usuario_id', 'album_id', 'valor', 'comentario'];
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class);
    }

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }
}
