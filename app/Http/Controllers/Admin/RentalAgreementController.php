<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\RentalAgreement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Notifications\RentalRejectedNotification;

class RentalAgreementController extends Controller
{
    public function index()
    {
        return view('admin.rentals.index', [
            'rentals' => RentalAgreement::with(['apartment', 'tenant'])
                ->orderByDesc('id')
                ->get(),
        ]);
    }
    //ADMIN VIEW FOR CREATING RENTAL
    public function create()
    {
        return view('admin.rentals.create', [
            'apartments' => Apartment::orderBy('address')->get(),
            'tenants'    => User::orderBy('name')->get(),
        ]);
    }
    //ADMIN STORE AFTER CREATING RENTAL
    public function store(Request $request)
    {
        $validated = $request->validate([
            'apartment_id' => ['required', 'exists:apartments,id'],
            'tenant_id'    => ['required', 'exists:users,id'],
            'start_date'   => ['required', 'date'],
            'end_date'     => ['nullable', 'date', 'after_or_equal:start_date'],
        ]);

        if (RentalAgreement::overlapsForApartment(
            (int) $validated['apartment_id'],
            $validated['start_date'],
            $validated['end_date'] ?? null
        )) {
            return back()
                ->withErrors(['start_date' => 'This apartment already has a lease overlapping this period.'])
                ->withInput();
        }

        RentalAgreement::create([
            'apartment_id' => $validated['apartment_id'],
            'tenant_id'    => $validated['tenant_id'],
            'start_date'   => $validated['start_date'],
            'end_date'     => $validated['end_date'],
            'status'       => 'pending',
        ]);

        return redirect()
            ->route('admin.rentals.index')
            ->with('success', 'Lease created.');
    }
    //ADMIN VIEW FOR RENTAL EDIT
    public function edit(RentalAgreement $rental)
    {
        return view('admin.rentals.edit', [
            'rental'     => $rental,
            'apartments' => Apartment::orderBy('address')->get(),
            'tenants'    => User::orderBy('name')->get(),
        ]);
    }
    //ADMIN UPDATE AFTER RENTAL EDIT
    public function update(Request $request, RentalAgreement $rental)
    {
        $validated = $request->validate([
            'apartment_id' => ['required', 'exists:apartments,id'],
            'start_date'   => ['required', 'date'],
            'end_date'     => ['nullable', 'date', 'after_or_equal:start_date'],
        ]);

        if (RentalAgreement::overlapsForApartment(
            (int) $validated['apartment_id'],
            $validated['start_date'],
            $validated['end_date'] ?? null,
            $rental->id
        )) {
            return back()
                ->withErrors(['start_date' => 'This apartment already has a lease overlapping this period.'])
                ->withInput();
        }

        $rental->update([
            'apartment_id' => $validated['apartment_id'],
            'start_date'   => $validated['start_date'],
            'end_date'     => $validated['end_date'],
        ]);

        return redirect()
            ->route('admin.rentals.index')
            ->with('success', 'Lease updated.');
    }
    //DELETE RENTAL
    public function destroy(RentalAgreement $rental)
    {
        $rental->delete();

        return back()->with('success', 'Lease deleted.');
    }
    //APPROVE RENTAL REQUEST
    public function approve(RentalAgreement $rental)
    {
        if ($rental->status !== 'pending') {
            abort(400, 'Rental is not pending');
        }

        $rental->update([
            'status' => 'active',
        ]);

        return back()->with('success', 'Rental approved.');
    }
    //REJECT RENTAL REQUEST
    public function reject(RentalAgreement $rental)
    {
        if ($rental->status !== 'pending') {
            abort(400, 'Rental is not pending');
        }

        $rental->update([
            'status' => 'rejected',
        ]);

        Log::info('Rental rejected', [
            'rental_id'    => $rental->id,
            'tenant_id'    => $rental->tenant_id,
            'apartment_id' => $rental->apartment_id,
        ]);

        if ($rental->tenant) {
            $rental->tenant->notify(
                new RentalRejectedNotification($rental)
            );
        }

        return back()->with('success', 'Rental rejected.');
    }
}
