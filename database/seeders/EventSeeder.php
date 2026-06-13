<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::create([
        'title' => 'Webinar Akselerasi Karir UI/UX Designer 2026',
        'speaker' => 'Evan Wijaya (Ex-Simplepay)',
        'category' => 'UI/UX',
        'type' => 'online',
        'description' => 'Belajar fundamental UI/UX dari nol hingga siap kerja di industri.',
        'location' => 'Zoom Meeting',
        'event_date' => '2026-07-20 13:00:00',
        'price' => 50000,
        'ticket_quantity' => 100,
    ]);

        Event::create([
            'title' => 'Workshop Full-Stack Laravel untuk Pemula',
            'speaker' => 'Rian Putra (Diskominfo)',
            'category' => 'Web Dev',
            'type' => 'offline',
            'description' => 'Praktek langsung membuat aplikasi web monolith menggunakan Laravel.',
            'location' => 'Aula Kampus Utama',
            'event_date' => '2026-08-15 09:00:00',
            'price' => 0, // Gratis
            'ticket_quantity' => 50,
        ]);
    }
}
