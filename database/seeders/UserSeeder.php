<?php
//ADDING ADMINS HERE 
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->delete();

        // ADMIN
        User::create([
            'name' => 'Kris',
            'email' => 'kikomikobg123@gmail.com',
            'password' => Hash::make('556742krisko'),
            'is_admin' => true,
        ]);
    }
}

//USE 'php artisan db:seed' TO ADD ;)