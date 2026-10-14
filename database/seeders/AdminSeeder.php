<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // firstOrCreate: tidak menimpa password admin yang sudah ada
        Admin::firstOrCreate(
            ['username' => 'admin'],
            ['password' => 'admin123', 'nama' => 'Administrator']
        );
    }
}