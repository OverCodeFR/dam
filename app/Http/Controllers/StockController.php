<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Stock::class);

        $search = $request->query('search');
        $user = auth()->user();

        $patient = $request->query('patient');

        $stocks = Stock::with('treatment.patient.user');
        if ($user->role->key === 'admin') {
            $stocks = Stock::with('treatment.patient.user');
        } elseif ($user->role->key === 'patient') {
            $stocks = $stocks ->whereHas('treatment.patient', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        } elseif ($patient !== null) {
            $stocks = $stocks->whereHas('treatment', function ($query) use ($patient) {
                $query->where('patient_id', $patient);
            });
        } else {
            abort(404, 'Page not found');
        }

        if ($search) {
            $stocks = $stocks->where(function ($query) use ($search) {
                $query->whereHas('treatment', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })->orWhereHas('treatment.patient', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
                        ->orWhere('address', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                })->orWhereHas('treatment.patient.user', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            });
        }

        $stocks = $stocks->orderBy('amount', 'asc')->paginate(10);

        return view('stocks.index', compact('stocks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
