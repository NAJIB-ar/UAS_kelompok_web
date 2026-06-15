<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'test123',
        ]);

        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@kampus.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Mahasiswa Reguler',
            'email' => 'mahasiswa@kampus.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        Event::create([
            'title' => 'Webinar Akselerasi Karir UI/UX Designer 2026',
            'speaker' => 'Evan Wijaya',
            'category' => 'UI/UX',
            'type' => 'online',
            'description' => 'Belajar fundamental UI/UX dari nol hingga siap kerja di industri.',
            'location' => 'Zoom Meeting',
            'event_date' => '2026-07-20 13:00:00',
            'price' => 50000,
            'ticket_quantity' => 100,
        ]);
    }
}
