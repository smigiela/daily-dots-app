<?php

namespace Database\Seeders;

use App\Models\Diary\Task;
use App\Models\User;
use Database\Seeders\Diary\TaskSeeder;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@app.com',
        ]);

        $this->call([
            TaskSeeder::class,
        ]);
    }
}
