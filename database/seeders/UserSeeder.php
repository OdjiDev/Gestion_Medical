<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'user']);
        Role::firstOrCreate(['name' => 'pharmacien']);
        Role::firstOrCreate(['name' => 'medecin']);

        $admin = User::firstOrCreate(
            ['email' => 'djibidouc17@gmail.com'],
            [
                'name' => 'Djibril',
                'telephone' => '61180828',
                'password' => bcrypt('douc2@26'),
            ]
        );

        $admin->syncRoles(['admin']);
    }
}