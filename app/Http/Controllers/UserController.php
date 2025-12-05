<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use App\Models\Course;
use App\Models\Signal;
use App\Models\Setting;

class UserController extends Controller
{
    // Show user dashboard with tutorials
    public function index()
    {
        $settings = Setting::first();
        $courses = Course::all();
        $bots = Bot::all();
        $signals = Signal::all();

        return view('user.index', compact('settings', 'courses', 'bots', 'signals'))->with('success', 'Login successful.');;
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
