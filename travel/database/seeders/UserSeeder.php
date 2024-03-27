<?php

namespace Database\Seeders;

use App\Models\User;
use App\Http\Controllers\AuthController;
use Illuminate\Database\Seeder;

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
            'name' => 'Iqbal Firdaus',
            'email' => 'iqbal@gmail.com',
            'password' => bcrypt('iqbal038'),
            'type' => 'admin',
        ]);

        User::create([
            'name' => 'Nisha Sri Mulyani',
            'email' => 'nisha@gmail.com',
            'password' => bcrypt('nisha123'),
            'type' => 'user',
        ]);

        User::create([
            'name' => 'Rian Arzial',
            'email' => 'rian@gmail.com',
            'password' => bcrypt('rian1234'),
            'type' => 'supir',
        ]);
    }
}
