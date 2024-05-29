<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accesos extends Model
{
    use HasFactory;

    public function moduloPorPermiso($permissionId)
    {
        return $this->where('permission_id', $permissionId)->with('modulo')->get()->pluck('modulo');
    }

    public function modulo()
    {
        return $this->belongsTo(Modulo::class);
    }
}
