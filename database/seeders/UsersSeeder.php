<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'role' => 'admin',
            'password' => bcrypt('admin')
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'kepalabidang@admin.com',
            'role' => 'kepala_bidang',
            'password' => bcrypt('admin')
        ]);
    }
}
