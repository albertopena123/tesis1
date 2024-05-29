<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carnet extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'placa', 'fecha_soat', 'estado', 'fotocarnet','pdf','gremio',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
