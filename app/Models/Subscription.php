<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $fillable = [
        'user_id',
        'category',
        'signal_id',
        'plan',
        'amount',
        'reference',
        'status',
    ];
}
