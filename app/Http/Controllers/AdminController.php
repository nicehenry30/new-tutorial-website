<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Activity;
use App\Models\Tutorial;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Show the admin dashboard with upload form
    public function index()
    {
        $users = User::where('role', 'user')->get();
        $activities = Activity::latest()->paginate(10);

        return view('admin.dashboard', compact('users', 'activities'));
    }

    public function users()
    {
        $users = User::where('role', 'user')->latest()->get();

        return view('admin.users', compact('users'));
    }

}
