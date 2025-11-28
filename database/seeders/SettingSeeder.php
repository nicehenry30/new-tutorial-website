<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'title' => 'SignalLearn',
            'logo' => 'logo.png',
            'favicon' => 'favicon.ico',
            'currency' => 'NGN',
        ]);
    }
}
