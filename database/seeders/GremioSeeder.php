<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gremio;

class GremioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gremio::create([
            'nombre' => 'Nueva Juventud',
            'abreviatura' => 'NUJU',
            'descripcion' => 'Al frende del colegio Santa Cruz',
        ]);
    }
}
