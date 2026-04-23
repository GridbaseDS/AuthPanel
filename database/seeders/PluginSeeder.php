<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PluginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Plugin::firstOrCreate([
            'slug' => 'dummy-plugin',
        ], [
            'name' => 'Dummy Plugin',
            'type' => 'free',
        ]);
    }
}
