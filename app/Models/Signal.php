<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Signal extends Model
{
    protected $fillable = [
        'title',
        'description',
        'TP',
        'SL',
        'monthly_price',
        'yearly_price',
    ];
}
