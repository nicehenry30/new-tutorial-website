<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;

class UserController extends Controller
{
    // Show user dashboard with tutorials
    public function index()
    {
        $settings = Setting::first();
        $courses = Course::all();
        $bots = Bot::all();
        $signals = Signal::all();

        return view('dashboard', compact('settings', 'courses', 'bots', 'signals'));
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
