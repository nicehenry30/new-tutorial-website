<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use App\Models\Course;
use App\Models\Signal;
use App\Models\Setting;

class UserController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        $courses = Course::all();
        $bots = Bot::all();
        $signals = Signal::all();

        return view('user.index', compact('settings', 'courses', 'bots', 'signals'))->with('success', 'Login successful.');
    }

    public function dashboard()
    {
        $settings = Setting::first();
        $courses = Course::all();
        $bots = Bot::all();
        $signals = Signal::all();

        return view('user.dashboard');
    }

}
