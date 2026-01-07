<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RentalRequest;
use App\Models\RentalAgreement;

class RentalRequestController extends Controller
{
    public function index()
    {
        $rentalRequests = RentalRequest::with(['apartment', 'user'])
            ->latest()
            ->get();

        return view('admin.dashboard', compact('rentalRequests'));
    }
    //APPROVE RENTAL REQUEST
    public function approve(RentalRequest $rentalRequest)
    {
        // Create rental agreement
        RentalAgreement::create([
            'apartment_id' => $rentalRequest->apartment_id,
            'tenant_id'    => $rentalRequest->user_id,
            'start_date'   => $rentalRequest->start_date,
            'end_date'     => $rentalRequest->end_date,
            'status'       => 'active',
        ]);

        $rentalRequest->update([
            'status' => 'approved',
        ]);

        return back()->with('success', 'Rental request approved.');
    }
    //REJECT RENTAL REQUEST
    public function reject(RentalRequest $rentalRequest)
    {
        $rentalRequest->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Rental request rejected.');
    }
    //DELETE RENTAL REQUEST AFTER APPROVE/REJECT (IF REQUEST PENDING = 403)
    public function destroy(RentalRequest $rentalRequest)
    {
        if ($rentalRequest->status === 'pending') {
            abort(403);
        }

        $rentalRequest->delete();

        return back()->with('success', 'Rental request removed.');
    }
}
