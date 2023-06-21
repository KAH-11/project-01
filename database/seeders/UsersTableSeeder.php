<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    
    public function run(): void
    {
        // DB::table('users')->insert([
        //     'name' => 'Hadi N',
        //     'email' => 'hadi@n.com',
        //     'password' => Hash::make('password')
        // ]);
    }
    
}
