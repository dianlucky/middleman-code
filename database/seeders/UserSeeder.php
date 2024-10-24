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
                'password' => '6E44065B9C2E9D7AFFC1FCD3019315E281890A05',
                'name' => 'superadmin',
                'role' => 'superadmin',
            ],
            [
                'id' => 2,
                'username' => 'admin1',
                'password' => '40BD001563085FC35165329EA1FF5C5ECBDBBEEF',
                'name' => 'Admin Lucky',
                'role' => 'admin',
            ],
            [
                'id' => 3,
                'username' => 'admin2',
                'password' => '40BD001563085FC35165329EA1FF5C5ECBDBBEEF',
                'name' => 'Admin Latif',
                'role' => 'admin',
            ],
            [
                'id' => 4,
                'username' => 'admin3',
                'password' => '40BD001563085FC35165329EA1FF5C5ECBDBBEEF',
                'name' => 'Admin Imel',
                'role' => 'admin',
            ],
            [
                'id' => 5,
                'username' => 'admin4',
                'password' => '40BD001563085FC35165329EA1FF5C5ECBDBBEEF',
                'name' => 'Admin Fadil',
                'role' => 'admin',
            ],
            [
                'id' => 6,
                'username' => 'admin5',
                'password' => '40BD001563085FC35165329EA1FF5C5ECBDBBEEF',
                'name' => 'Admin Fauzan',
                'role' => 'admin',
            ],
        ]);
    }
}
