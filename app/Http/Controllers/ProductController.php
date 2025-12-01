<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use App\Models\Course;
use App\Models\Signal;
use App\Models\Setting;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /* ActivityLogger::log('Transaction Created', "Transaction #{$transaction->id} created by {$transaction->user->email}");
 */

    public function index()
    {
        $settings = Setting::first();
        $courses = Course::latest()->get();
        $signals = Signal::latest()->get();
        $bots = Bot::latest()->get();

        return view('admin.products.index', compact('courses', 'signals', 'bots', 'settings'));
    }

    public function create_course()
    {
        $settings = Setting::first();
        return view('admin.courses.create')->with(compact('settings'));
    }

    public function store_course(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'small_description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $course = new Course();
        $course->title = $request->input('title');
        $course->small_description = $request->input('small_description');
        $course->price = $request->input('price');

        $image_path = null;
        
        if ($request->hasFile('image')) {
            $image_path = time().'.'.$request->image->extension();$request->image->move(public_path('images'), $image_path);
            $course->image_path = $image_path;
        }

        $course->save();

        return redirect()->route('admin.products')->with('success', 'Course created successfully.');
    }

    public function edit_course($id)
    {
        $settings = Setting::first();
        $course = Course::findOrFail($id);

        return view('admin.courses.edit', compact('course', 'settings'));
    }

    public function update_course(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'small_description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $course = Course::findOrFail($id);
        $course->title = $request->input('title');
        $course->small_description = $request->input('small_description');
        $course->price = $request->input('price');

        if ($request->hasFile('image')) {
            $image_path = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $image_path);
            $course->image_path = $image_path;
        }

        $course->save();

        return redirect()->route('admin.products')->with('success', 'Course updated successfully.');
    }

    public function destroy_course($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return redirect()->route('admin.products')->with('success', 'Course deleted successfully.');
    }

    public function create_signal()
    {
        $settings = Setting::first();
        return view('admin.signals.create')->with(compact('settings'));
    }

    public function store_signal(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tp' => 'required|numeric',
            'sl' => 'required|numeric',
            'monthly_price' => 'required|numeric',
            'yearly_price' => 'required|numeric',
            
        ]);

        $signal = new Signal();
        $signal->title = $request->input('title');
        $signal->description = $request->input('description');
        $signal->TP = $request->input('tp');
        $signal->SL = $request->input('sl');
        $signal->monthly_price = $request->input('monthly_price');
        $signal->yearly_price = $request->input('yearly_price');
        $signal->save();

        return redirect()->route('admin.products')->with('success', 'Signal created successfully.');
    }

    public function edit_signal($id)
    {
        $settings = Setting::first();
        $signal = Signal::findOrFail($id);

        return view('admin.signals.edit', compact('signal', 'settings'));
    }

    public function update_signal(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'tp' => 'required|numeric',
            'sl' => 'required|numeric',
            'monthly_price' => 'required|numeric',
            'yearly_price' => 'required|numeric',
        ]);

        $signal = Signal::findOrFail($id);
        $signal->title = $request->input('title');
        $signal->description = $request->input('description');
        $signal->TP = $request->input('tp');
        $signal->SL = $request->input('sl');
        $signal->monthly_price = $request->input('monthly_price');
        $signal->yearly_price = $request->input('yearly_price');
        $signal->save();

        return redirect()->route('admin.products')->with('success', 'Signal updated successfully.');
    }

    public function destroy_signal($id)
    {
        $signal = Signal::findOrFail($id);
        $signal->delete();

        return redirect()->route('admin.products')->with('success', 'Signal deleted successfully.');
    }

    public function create_bot()
    {
        $settings = Setting::first();
        return view('admin.bots.create')->with(compact('settings'));
    }

    public function store_bot(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'monthly_price' => 'required|numeric',
            'yearly_price' => 'required|numeric',
            'demo_link' => 'nullable|url',
        ]);

        $bot = new Bot();
        $bot->title = $request->input('title');
        $bot->description = $request->input('description');
        $bot->monthly_price = $request->input('monthly_price');
        $bot->yearly_price = $request->input('yearly_price');
        $bot->demo_link = $request->input('demo_link');
        $bot->save();

        return redirect()->route('admin.products')->with('success', 'Bot created successfully.');
    }

    public function edit_bot($id)
    {
        $settings = Setting::first();
        $bot = Bot::findOrFail($id);

        return view('admin.bots.edit', compact('bot', 'settings'));
    }

    public function update_bot(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'monthly_price' => 'required|numeric',
            'yearly_price' => 'required|numeric',
            'demo_link' => 'nullable|url',
        ]);

        $bot = Bot::findOrFail($id);
        $bot->title = $request->input('title');
        $bot->description = $request->input('description');
        $bot->monthly_price = $request->input('monthly_price');
        $bot->yearly_price = $request->input('yearly_price');
        $bot->demo_link = $request->input('demo_link');
        $bot->save();

        return redirect()->route('admin.products')->with('success', 'Bot updated successfully.');
    }

    public function destroy_bot($id)
    {
        $bot = Bot::findOrFail($id);
        $bot->delete();

        return redirect()->route('admin.products')->with('success', 'Bot deleted successfully.');
    }
}
