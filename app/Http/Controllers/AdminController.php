<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function dashboardAdmin()
    {
        // Ambil semua pengguna yang memiliki role 'user'
        $users = User::where('role', 'user')->get();

        // Kirim data pengguna ke view
        return view('admin.dashboard', compact('users'));
    }
}
