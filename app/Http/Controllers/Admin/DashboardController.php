<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\RentalAgreement;
use App\Models\User;
use App\Models\RentalRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $rentalRequests = RentalRequest::with(['apartment', 'user'])
            ->latest()
            ->get();

        return view('admin.dashboard', compact('rentalRequests'));
        $recentRentals = RentalAgreement::latest()->take(5)->get();
        return view('admin.dashboard', [
            
            'propertiesCount'    => Apartment::count(),
            'activeLeasesCount'  => RentalAgreement::where('status', 'active')->count(),
            'pendingLeasesCount' => RentalAgreement::where('status', 'pending')->count(),
            'tenantsCount'       => User::count(),
            'recentRentals' => $recentRentals,
            
        ]);
        
    }
}
