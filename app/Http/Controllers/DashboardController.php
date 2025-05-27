<?php

namespace App\Http\Controllers;

class DashboardController
{
    public static function index(){
        return view('dashboard.index');
    }
}
