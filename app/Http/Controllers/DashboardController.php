<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard'); // Pastikan nama view sesuai dengan yang Anda buat (dashboard.blade.php)
    }
}
