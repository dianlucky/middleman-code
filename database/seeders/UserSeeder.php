<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'username' => 'superadmin',
                'password' => Hash::make('middleman.2510'),
                'name' => 'superadmin',
                'role' => 'superadmin',
            ],
            [
                'id' => 2,
                'username' => 'admin1',
                'password' => Hash::make('admin123'),
                'name' => 'Admin Lucky',
                'role' => 'admin',
            ],
            [
                'id' => 3,
                'username' => 'admin2',
                'password' => Hash::make('admin123'),
                'name' => 'Admin Latif',
                'role' => 'admin',
            ],
            [
                'id' => 4,
                'username' => 'admin3',
                'password' => Hash::make('admin123'),
                'name' => 'Admin Imel',
                'role' => 'admin',
            ],
            [
                'id' => 5,
                'username' => 'admin4',
                'password' => Hash::make('admin123'),
                'name' => 'Admin Fadil',
                'role' => 'admin',
            ],
            [
                'id' => 6,
                'username' => 'admin5',
                'password' => Hash::make('admin123'),
                'name' => 'Admin Fauzan',
                'role' => 'admin',
            ],
            [
                'id' => 7,
                'username' => 'member1',
                'password' => Hash::make('member123'),
                'name' => 'Member 1',
                'role' => 'member',
            ],
            [
                'id' => 8,
                'username' => 'member2',
                'password' => Hash::make('member123'),
                'name' => 'Member 2',
                'role' => 'member',
            ],
            [
                'id' => 9,
                'username' => 'member3',
                'password' => Hash::make('member123'),
                'name' => 'Member 3',
                'role' => 'member',
            ],
            
        ]);
    }
}
