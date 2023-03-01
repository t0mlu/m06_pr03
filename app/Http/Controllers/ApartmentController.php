<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Http\Requests\StoreApartmentRequest;
use App\Http\Requests\UpdateApartmentRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Platform;

class ApartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('apartmentValidate')->only(['store', 'update']);
        $this->middleware('apartmentRequired')->only('store');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['apartments' => Apartment::with(['user', 'platforms'])->get()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreApartmentRequest $request)
    {
        $apartment = Apartment::create([
            'address' => request()->address,
            'city' => request()->city,
            'postal_code' => request()->postal_code,
            'rented_price' => $request->filled('rented_price') ? request()->rented_price : null,
            'rented' => request()->rented,
            'user_id' => request()->user()->id
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Apartment $apartment)
    {
        $apartment->user;
        $apartment->platforms;
        return $apartment;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateApartmentRequest $request, Apartment $apartment)
    {
        if ($request->user()->cannot('update', $apartment)) {
            abort(403);
        }

        $apartment->fill($request->all())->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Apartment $apartment)
    {
        if ($request->user()->cannot('delete', $apartment)) {
            abort(403);
        }

        $apartment->delete();
        return response()->noContent();
    }


    // Non CRUD functions

    public function apartmentsInPlatform($id)
    {
        return Apartment::whereRelation('platforms', 'platform_id', '=', $id)
            ->orderBy('id')
            ->with('user')
            ->get();
    }

    public function rentedApartments(Request $request)
    {
        $this->validate($request, [
            'rented' => ['required', 'boolean']
        ]);

        return Apartment::where('rented', $request->rented)
            ->orderBy('id')
            ->with('user')
            ->get();
    }

    public function apartmentsPremium()
    {
        return Apartment::where('rented_price', '>', 1000)
            ->orderBy('id')
            ->with('user')
            ->get();
    }
}
