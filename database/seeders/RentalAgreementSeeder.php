<?php
//TESTS FOR ACTIVE/FINISHED RENTAL AGREEMENTS
namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\RentalAgreement;
use App\Models\User;
use Illuminate\Database\Seeder;

class RentalAgreementSeeder extends Seeder
{
    public function run(): void
    {
        $tenant1 = User::factory()->create(['role' => 'user']);
        $tenant2 = User::factory()->create(['role' => 'user']);

        $owner = User::where('role', 'admin')->first();

        $a1 = Apartment::create([
            'type'     => 'apartment',
            'address'  => 'Maria Gabrovska 2A, Veliko Tarnovo',
            'price'    => 250,
            'area'     => 70,
            'owner_id' => $owner->id,
        ]);

        $a2 = Apartment::create([
            'type'     => 'house',
            'address'  => 'Ledenik 15, Veliko Tarnovo',
            'price'    => 350,
            'area'     => 130,
            'owner_id' => $owner->id,
        ]);

        RentalAgreement::create([
            'apartment_id' => $a1->id,
            'tenant_id'    => $tenant1->id,
            'start_date'   => now()->subMonths(2)->toDateString(),
            'end_date'     => null,
            'status'       => 'pending',
        ]);

        RentalAgreement::create([
            'apartment_id' => $a2->id,
            'tenant_id'    => $tenant2->id,
            'start_date'   => now()->addWeek()->toDateString(),
            'end_date'     => now()->addMonths(6)->toDateString(),
            'status'       => 'pending',
        ]);
    }
}
