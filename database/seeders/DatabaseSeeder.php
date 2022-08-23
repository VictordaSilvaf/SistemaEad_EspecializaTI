<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(4)->create();
        \App\Models\Module::factory(4)->create();
        \App\Models\Lesson::factory(4)->create();
        \App\Models\Course::factory(4)->create();
        \App\Models\Support::factory(2)->create();
    }
}
