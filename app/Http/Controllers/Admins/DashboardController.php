<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->hasRole('SuperAdmin') or $user->hasRole('Admin')) {
            return view('dashboard');
        }
        return redirect()->route('ventas');
    }

    
}
