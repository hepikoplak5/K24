<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $permissions = [
            'Admin',
            'User'
         ];
      
         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }

        Role::create(['name' => 'Admin'])->givePermissionTo('Admin');
        Role::create(['name' => 'User'])->givePermissionTo('User');

        User::create([
            'name' => 'Admin', 
            'username' => 'Admin', 
            'nohp' => '6281358820785', 
            'tgl_lahir' => Carbon::create('2000', '01', '01'), 
            'noktp' => '3517090512010003', 
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Admin');

        User::create([
            'name' => 'User', 
            'username' => 'User', 
            'nohp' => '6281358820785', 
            'tgl_lahir' => Carbon::create('2001', '01', '01'), 
            'noktp' => '3517092405980003', 
            'email' => 'user@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('User');
    }
}
