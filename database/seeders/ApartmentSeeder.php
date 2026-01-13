<?php
//TEST SEEDER FOR APARTMENTS (trying to add apartments)
namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Seeder;
use App\Models\User;

class ApartmentSeeder extends Seeder
{
    public function run(): void
    {
        Apartment::query()->delete();

        $owner = User::where('role', 'admin')->first()
            ?? User::factory()->create(['role' => 'admin']);

        Apartment::create([
            'type'     => 'apartment',
            'address'  => 'Maria Gabrovska 2A, Veliko Tarnovo',
            'price'    => 200,
            'area'     => 65,
            'owner_id' => $owner->id,
        ]);
    }
}
