<?php
//TEST SEEDER FOR APARTMENTS (trying to add apartments)
namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    public function run(): void
    {
        Apartment::query()->delete();

        Apartment::create(['type' => 'apartment', 'address' => 'Sofia, Center 1', 'price' => 900, 'area' => 60]);
        Apartment::create(['type' => 'house', 'address' => 'Sofia, Boyana 12', 'price' => 2500, 'area' => 180]);
        Apartment::create(['type' => 'studio', 'address' => 'Plovdiv, Kapana 7', 'price' => 650, 'area' => 35]);
    }
}
