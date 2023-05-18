<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminCreateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = array(
            'name' => 'Админ',
            'login' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'type' => 'admin',
        );
        DB::table('users')->insert($data);
    }
}
