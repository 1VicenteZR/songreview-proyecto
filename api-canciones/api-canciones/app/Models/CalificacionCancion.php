<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CalificacionCancion extends Model
{
    use HasFactory;
    
    protected $table = 'calificacion_cancion';
    
    protected $fillable = [
        'usuario_id',
        'cancion_id', 
        'calificacion',
        'comentario'
    ];

    protected $casts = [
        'calificacion' => 'integer',
        'usuario_id' => 'integer',
        'cancion_id' => 'integer'
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function cancion()
    {
        return $this->belongsTo(Cancion::class, 'cancion_id');
    }
}
