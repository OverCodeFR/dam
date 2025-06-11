<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;

class DashboardController
{
    public static function index(Request $request){

        $search = $request->query('search');
        $user = auth()->user();


        $stocks = Stock::with('treatment.patient.user');
            if ($user->role->key !== 'admin') {
                $stocks =$stocks ->whereHas('treatment.patient', function ($query) use ($user) {
                    $query->where('user_id', $user->id);
                });
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

        $stocks = $stocks->orderBy('amount', 'asc')->paginate(6);

        return view('dashboard.index', compact('stocks'));
    }
}
