<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run()
    {
        // Event lengkap
        Event::create([
            'organization_id' => 1, // BNCC
            'title' => 'Tech Talk 2025',
            'description' => 'A discussion on the latest in technology.',
            'event_date' => Carbon::now()->addDays(30),
            'image' => 'events/tech_talk.jpg',
            'location' => 'Auditorium BINUS Alam Sutera',
            'zoom_link' => 'https://zoom.us/tt2025',
            'ticket_price' => 25000,
            'registration_link' => 'https://forms.gle/tt2025form'
        ]);

        // Event gratis, offline, tanpa Zoom
        Event::create([
            'organization_id' => 1,
            'title' => 'Programming Workshop',
            'description' => 'Learn to code with BNCC experts.',
            'event_date' => Carbon::now()->addDays(45),
            'image' => 'events/workshop.jpg',
            'ticket_price' => 0,
        ]);

        // Event online-only, berbayar
        Event::create([
            'organization_id' => 1,
            'title' => 'Cyber Security Awareness',
            'description' => 'Protect yourself in the digital world.',
            'event_date' => Carbon::now()->addDays(60),
            'image' => 'events/cyber_security.jpg',
            'location' => 'Online',
            'zoom_link' => 'https://zoom.us/cybersecure2025',
            'ticket_price' => 15000,
            'registration_link' => 'https://event.bncc.org/cybersecure'
        ]);
    }
}
