<?php

namespace App\Http\Controllers;

use App\Models\Bot;
use App\Models\Course;
use App\Models\Signal;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /* ActivityLogger::log('Transaction Created', "Transaction #{$transaction->id} created by {$transaction->user->email}");
 */

    public function index()
    {
        $courses = Course::latest()->get();
        $signals = Signal::latest()->get();
        $bots = Bot::latest()->get();

        return view('admin.products', compact('courses', 'signals', 'bots'));
    }
}
