<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::find(1);

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'favicon' => 'nullable|image|max:2048',
            'currency' => 'required|string|max:10',
        ]);

        $settings = Setting::find(1);
        $settings->title = $request->input('title');
        
        $logo_name = $settings->logo;

        if ($request->hasFile('logo')) {
            $logo_name = time().'.'.$request->logo->extension();$request->logo->move(public_path('settings'), $logo_name);
            $settings->logo = $logo_name;
        }
        
        $favicon_name = $settings->favicon;
        if ($request->hasFile('favicon')) {
            $favicon_name = time().'.'.$request->favicon->extension();$request->favicon->move(public_path('settings'), $favicon_name);
            $settings->favicon = $favicon_name;
        }

        $settings->currency = $request->input('currency');
        $settings->save();

        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully.');
    }
}
