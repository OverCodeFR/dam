<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        DB::enableQueryLog();
        $users = User::withoutGlobalScopes()->get();
        dd(DB::getQueryLog()); // Affiche la requête SQL
        return response()->json(['users' => $users]);
    }
}
