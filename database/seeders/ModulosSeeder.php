<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Modulo;
class ModulosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Modulo::create([
            'nombre' => 'Panel',
            'slug' => 'PN',
        ]);
        Modulo::create([
            'nombre' => 'Usuarios',
            'slug' => 'US',
        ]);

        Modulo::create([
            'nombre' => 'Operacion',
            'slug' => 'OP',
        ]);
       
        Modulo::create([
            'nombre' => 'Gremios',
            'slug' => 'GM',
        ]);
        Modulo::create([
            'nombre' => 'Carnet Operacional',
            'slug' => 'CO',
        ]);
    }
}
