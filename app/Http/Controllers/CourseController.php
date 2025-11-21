<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|url',
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
