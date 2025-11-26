<?php

namespace App\Helpers;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    public static function log($action, $description = null)
    {
        Activity::create([
            'user_id' => Auth::id(),
            'action'  => $action,
            'description' => $description,
        ]);
    }
}
