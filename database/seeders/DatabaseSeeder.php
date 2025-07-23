<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $Superadmin = Role::create(['name' => 'SuperAdmin']);
        $admin = Role::create(['name' => 'Admin']);
        $vendedor = Role::create(['name' => 'Vendedor']);

        Permission::create(['name' => 'clientes'])->syncRoles([$admin, $Superadmin]);
        Permission::create(['name' => 'vendedores'])->syncRoles([$admin, $Superadmin]);
        Permission::create(['name' => 'reportes'])->syncRoles([$admin, $Superadmin]);
        Permission::create(['name' => 'perfil'])->syncRoles([$admin, $Superadmin]);
        Permission::create(['name' => 'ventas'])->syncRoles([$vendedor, $admin, $Superadmin]);
        Permission::create(['name' => 'administradores'])->assignRole($Superadmin);

        User::factory()->create([
            'name' => 'Luis',
            'apellido' => 'Acosta',
            'telefono' => '01343431343',
            'cedula' => '30139928',
            'tipo' => 'SuperAdmin',
            'email' => 'admin@example.com',
            'password' => Hash::make('1212121212')
        ])->assignRole($Superadmin);
    }
}
