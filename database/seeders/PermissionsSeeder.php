<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;


class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Insertar el permiso "admin"
         Permission::create([
            'name' => 'Admin',
            'slug' => 'admin',
        ]);

        // Insertar otros permisos
        Permission::create([
            'name' => 'Miembro',
            'slug' => 'miembrov',
        ]);
    }
}
