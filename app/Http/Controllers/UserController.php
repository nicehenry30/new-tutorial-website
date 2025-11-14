<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;

class UserController extends Controller
{
    // Show user dashboard with tutorials
    public function index()
    {
        // Optionally, you can filter based on subscription
        $tutorials = Tutorial::latest()->get();

        return view('dashboard', compact('tutorials'));
    }

    // Show a single tutorial
    public function show($id)
    {
        $tutorial = Tutorial::findOrFail($id);

        // Optional: restrict premium content if user is not subscribed
        // if ($tutorial->is_premium && auth()->user()->subscription_status !== 'active') {
        //     return redirect()->route('dashboard')->with('error', 'Subscribe to access this tutorial.');
        // }

        return view('tutorial.show', compact('tutorial'));
    }
}
