<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'dwiputra',
            'phone' => '083874793420',
            'role' => 'admin',
            'region' => 'bogor',
            'email' => 'deria3789@gmail.com',
            'password' => bcrypt('bacot889')
        ]);
        User::create([
            'name' => 'daniel',
            'phone' => '123456787654',
            'role' => 'user',
            'region' => 'bogor',
            'email' => 'daniel@gmail.com',
            'password' => bcrypt('danielanjaymabar')
        ]);
        
    }
}
