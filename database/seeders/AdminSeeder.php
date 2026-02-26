<?php

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

public function run(): void
{
    // =======================
    // BUAT ROLES
    // =======================
    $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
    $admin = Role::firstOrCreate(['name' => 'admin']);
    $content = Role::firstOrCreate(['name' => 'content-maker']);

    // =======================
    // BUAT PERMISSIONS
    // =======================
    $permissions = [
        'manage users',
        'manage teachers',
        'manage albums',
        'manage sliders',
        'manage posts'
    ];

    foreach ($permissions as $permission) {
        Permission::firstOrCreate(['name' => $permission]);
    }

    // =======================
    // ASSIGN PERMISSION
    // =======================
    $superAdmin->givePermissionTo(Permission::all());
    $superAdmin = User::firstOrCreate(
            ['email' => 'sup[eradmin@tintaemas.sch.id'],
            [
                'name' => 'super-Administrator',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'Admin123!')),
            ]
        );
    $admin->givePermissionTo([
        'manage teachers',
        'manage albums',
        'manage sliders',
        'manage posts'
    ]);
    $content->givePermissionTo([
        'manage posts'
    ]);

    // =======================
    // BUAT USER SUPER ADMIN
    // =======================
    $user = User::firstOrCreate(
        ['email' => 'superadmin@tintaemas.sch.id'],
        [
            'name' => 'Super Administrator',
            'password' => Hash::make(env('ADMIN_PASSWORD', 'SuperAdmin123!')),
        ]
    );

    if (!$user->hasRole('super-admin')) {
        $user->assignRole($superAdmin);
    }
}