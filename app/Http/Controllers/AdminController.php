<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Show the admin dashboard with upload form
    public function index()
    {
        // Optionally, pass all tutorials to the view
        $tutorials = Tutorial::latest()->get();

        return view('admin.dashboard', compact('tutorials'));
    }

    // Handle tutorial upload
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video' => 'nullable|mimes:mp4,avi,mov|max:20480', // 20MB max
            'file' => 'nullable|mimes:pdf,zip,docx|max:10240', // 10MB max
        ]);

        $tutorial = new Tutorial;
        $tutorial->title = $request->title;
        $tutorial->description = $request->description;

        if ($request->hasFile('video')) {
            $tutorial->video_path = $request->file('video')->store('videos', 'public');
        }

        if ($request->hasFile('file')) {
            $tutorial->file_path = $request->file('file')->store('files', 'public');
        }

        $tutorial->save();

        return redirect()->back()->with('success', 'Tutorial uploaded successfully!');
    }
}
