<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Show the admin dashboard with upload form
    public function index()
    {
        $users = User::where('role', 'user')->get();

        return view('admin.dashboard', compact('users'));
    }

}
