<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\PermissionRegistrar;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Reset permission cache
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /*
        |--------------------------------------------------------------------------
        | PERMISSIONS
        |--------------------------------------------------------------------------
        */

        $permissions = [

            // DASHBOARD
            'view dashboard',

            // POSTS
            'create posts',
            'edit posts',
            'delete posts',
            'publish posts',
            'manage posts',

            // MEDIA
            'manage albums',
            'manage sliders',
            'manage gallery',

            // DATA
            'manage teachers',
            'manage subjects',

            // SYSTEM
            'manage users',
            'manage settings'
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        /*
        |--------------------------------------------------------------------------
        | ROLES
        |--------------------------------------------------------------------------
        */

        $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        $admin      = Role::firstOrCreate(['name' => 'admin']);
        $content    = Role::firstOrCreate(['name' => 'content-maker']);

        /*
        |--------------------------------------------------------------------------
        | ASSIGN PERMISSIONS
        |--------------------------------------------------------------------------
        */

        // SUPER ADMIN → FULL ACCESS
        $superAdmin->syncPermissions(Permission::all());

        // ADMIN
        $admin->syncPermissions([
            'view dashboard',
            'create posts',
            'edit posts',
            'delete posts',
            'publish posts',
            'manage posts',

            'manage albums',
            'manage sliders',
            'manage gallery',

            'manage teachers',
            'manage subjects',
        ]);

        // CONTENT MAKER
        $content->syncPermissions([
            'view dashboard',

            'create posts',
            'edit posts',
            'delete posts',
            'manage albums',
            'manage gallery',
        ]);

        /*
        |--------------------------------------------------------------------------
        | CREATE DEFAULT SUPER ADMIN USER
        |--------------------------------------------------------------------------
        */

        $superAdminUser = User::firstOrCreate(
            ['email' => 'superadmin@tintaemas.sch.id'],
            [
                'name' => 'Super Administrator',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'Admin123!')),
            ]
        );

        if (!$superAdminUser->hasRole('super-admin')) {
            $superAdminUser->assignRole($superAdmin);
        }
    }
}