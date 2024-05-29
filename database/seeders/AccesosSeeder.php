<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Accesos;

class AccesosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Accesos::create([
            'permission_id' => 1,
            'modulo_id' => 1,
        ]);
        Accesos::create([
            'permission_id' => 1,
            'modulo_id' => 1,
        ]);
        Accesos::create([
            'permission_id' => 1,
            'modulo_id' => 1,
        ]);
        Accesos::create([
            'permission_id' => 1,
            'modulo_id' => 1,
        ]);
        Accesos::create([
            'permission_id' => 1,
            'modulo_id' => 1,
        ]);
    }
}
