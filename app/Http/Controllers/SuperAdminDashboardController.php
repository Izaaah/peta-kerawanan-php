<?php

namespace App\Http\Controllers;

use App\Models\User;

class SuperAdminDashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        return view('super-admin.dashboard', compact('totalUsers'));
    }
}
