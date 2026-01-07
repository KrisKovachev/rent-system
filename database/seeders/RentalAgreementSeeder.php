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
        RentalAgreement::query()->delete();

        $tenant1 = User::where('email', 'tenant1@demo.test')->first();
        $tenant2 = User::where('email', 'tenant2@demo.test')->first();

        $a1 = Apartment::where('address', 'Sofia, Center 1')->first();
        $a2 = Apartment::where('address', 'Sofia, Boyana 12')->first();

        // ACTIVE RENTAL AGREEMENT
        RentalAgreement::create([
            'apartment_id' => $a1->id,
            'user_id' => $tenant1->id,
            'start_date' => now()->subMonths(2)->toDateString(),
            'end_date' => null,
        ]);

        // FINISHED RENTAL AGREEMENT
        RentalAgreement::create([
            'apartment_id' => $a2->id,
            'user_id' => $tenant2->id,
            'start_date' => now()->subYear()->toDateString(),
            'end_date' => now()->subMonths(6)->toDateString(),
        ]);
    }
}
