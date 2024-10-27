<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
                'password' => '$2y$10$fskXMFFybYlubJ6WLrctGuE.lvcflC0QOhhyNQhUguBz7yVuXkgZC', //middleman.2510
                'name' => 'superadmin',
                'role' => 'superadmin',
            ],
            [
                'id' => 2,
                'username' => 'admin1',
                'password' => '$2y$10$nLEmSnCLaAmtVQZ6DPShr.H7v.nL165DDnOTmJXo1rLz19bCg2Ky.', //admin123
                'name' => 'Admin Lucky',
                'role' => 'admin',
            ],
            [
                'id' => 3,
                'username' => 'admin2',
                'password' => '$2y$10$nLEmSnCLaAmtVQZ6DPShr.H7v.nL165DDnOTmJXo1rLz19bCg2Ky.', 
                'name' => 'Admin Latif',
                'role' => 'admin',
            ],
            [
                'id' => 4,
                'username' => 'admin3',
                'password' => '$2y$10$nLEmSnCLaAmtVQZ6DPShr.H7v.nL165DDnOTmJXo1rLz19bCg2Ky.',
                'name' => 'Admin Imel',
                'role' => 'admin',
            ],
            [
                'id' => 5,
                'username' => 'admin4',
                'password' => '$2y$10$nLEmSnCLaAmtVQZ6DPShr.H7v.nL165DDnOTmJXo1rLz19bCg2Ky.',
                'name' => 'Admin Fadil',
                'role' => 'admin',
            ],
            [
                'id' => 6,
                'username' => 'admin5',
                'password' => '$2y$10$nLEmSnCLaAmtVQZ6DPShr.H7v.nL165DDnOTmJXo1rLz19bCg2Ky.',
                'name' => 'Admin Fauzan',
                'role' => 'admin',
            ],
        ]);
    }
}
