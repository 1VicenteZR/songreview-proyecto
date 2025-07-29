<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuario extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'email', 'password', 'rol'];

    // Mutador para encriptar la contraseña automáticamente
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function calificacionesAlbum(): HasMany
    {
        return $this->hasMany(CalificacionAlbum::class);
    }
    
    public function calificacionesCancion(): HasMany
    {
        return $this->hasMany(CalificacionCancion::class);
    }
    
    public function playlists(): HasMany
    {
        return $this->hasMany(Playlist::class);
    }
}
