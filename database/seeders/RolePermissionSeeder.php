<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $createPost = Permission::create([
            'name' => 'create posts'
        ]);

        $showPost = Permission::create([
        'name' => 'show posts'
        ]);

        $editPost = Permission::create([
            'name' => 'edit posts'
        ]);

        $deletePost = Permission::create([
            'name' => 'delete posts'
        ]);
       

$admin = Role::create([
        'name' => 'admin'
    ]);

    $user = Role::create([
        'name' => 'user'
    ]);

    $pharmacien = Role::create([
        'name' => 'pharmacien'
    ]);

    $medecin = Role::create([
        'name' => 'medecin'
    ]);

        $admin->givePermissionTo($createPost);
        $admin->givePermissionTo($editPost);
        $admin->givePermissionTo($deletePost);
        $admin->givePermissionTo($showPost);
        
        $user->givePermissionTo($createPost);
        $user->givePermissionTo($editPost);
        $user->givePermissionTo($deletePost);
        $user->givePermissionTo($showPost);

        $pharmacien->givePermissionTo($createPost);
        $pharmacien->givePermissionTo($editPost);
        $pharmacien->givePermissionTo($deletePost);
        $pharmacien->givePermissionTo($showPost);

        $medecin->givePermissionTo($createPost);
        $medecin->givePermissionTo($editPost);
        $medecin->givePermissionTo($deletePost);
        $medecin->givePermissionTo($showPost);

    }
}
