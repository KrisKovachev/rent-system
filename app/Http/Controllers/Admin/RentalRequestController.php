<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentalRequest;
use App\Models\RentalAgreement;

class RentalRequestController extends Controller
{
    public function index()
    {
        $rentalRequests = RentalRequest::with(['apartment', 'tenant'])
            ->latest()
            ->get();

        return view('admin.dashboard', compact('rentalRequests'));
    }

    // APPROVE RENTAL REQUEST
    public function approve(RentalRequest $rentalRequest)
    {
        if (RentalAgreement::overlapsForApartment(
            (int) $rentalRequest->apartment_id,
            $rentalRequest->start_date,
            $rentalRequest->end_date
        )) {
            return back()
                ->withErrors(['start_date' => 'This apartment already has a lease overlapping this period.']);
        }

        RentalAgreement::create([
            'apartment_id' => $rentalRequest->apartment_id,
            'tenant_id'    => $rentalRequest->tenant_id,
            'start_date'   => $rentalRequest->start_date,
            'end_date'     => $rentalRequest->end_date,
            'status'       => 'active',
        ]);

        $rentalRequest->update([
            'status' => 'approved',
        ]);

        return back()->with('success', 'Rental request approved.');
    }

    public function reject(RentalRequest $rentalRequest)
    {
        $rentalRequest->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Rental request rejected.');
    }

    public function destroy(RentalRequest $rentalRequest)
    {
        if ($rentalRequest->status === 'pending') {
            abort(403);
        }

        $rentalRequest->delete();

        return back()->with('success', 'Rental request removed.');
    }
}
