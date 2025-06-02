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

        // New Year Concert Event
        Event::create([
            'organization_id' => 2, // BDM
            'title' => 'New Year Concert 10.0',
            'description' => 'A grand musical performance by BDM featuring orchestral and big band collaborations to welcome the new year!',
            'event_date' => Carbon::create(2026, 1, 20),
            'image' => 'events/new_year_concert_10.jpg',
            'location' => 'BINUS Anggrek Auditorium',
            'ticket_price' => 30000,
            'registration_link' => 'https://bit.ly/bdmconcert2026'
        ]);

        // Free Outdoor Music Event
        Event::create([
            'organization_id' => 2,
            'title' => 'Music in The Park',
            'description' => 'A free acoustic performance by BDM held in the campus garden, open to everyone!',
            'event_date' => Carbon::create(2025, 9, 5),
            'image' => 'events/music_in_the_park.jpg',
            'location' => 'BINUS Square Garden',
            'ticket_price' => 0,
        ]);

        // Online Music Workshop
        Event::create([
            'organization_id' => 2,
            'title' => 'BDM Music Arrangement Workshop',
            'description' => 'Learn from BDM\'s composers and arrangers how to create orchestral and big band music arrangements.',
            'event_date' => Carbon::create(2025, 10, 12),
            'image' => 'events/arrangement_workshop.jpg',
            'location' => 'Online',
            'zoom_link' => 'https://zoom.us/bdmworkshop2025',
            'ticket_price' => 20000,
            'registration_link' => 'https://bdm.binus.or.id/register/arrangement'
        ]);

        // Event 1: Hybrid, berbayar
        Event::create([
            'organization_id' => 3, // HIMTI
            'title' => 'HISHOT 2025: Build Your First AI App',
            'description' => 'Hands-on workshop for building a simple AI-based app using Python. Suitable for beginners!',
            'event_date' => Carbon::create(2025, 8, 9),
            'image' => 'events/hishot_2025.jpg',
            'location' => 'BINUS Anggrek - Room 807',
            'zoom_link' => 'https://zoom.us/hishot2025',
            'ticket_price' => 20000,
            'registration_link' => 'https://bit.ly/hishot2025register'
        ]);

        // Event 2: Offline, gratis
        Event::create([
            'organization_id' => 3,
            'title' => 'HIMTI Meet & Greet 2025',
            'description' => 'An offline bonding session to welcome new HIMTI members! Games, snacks, and a whole lotta fun!',
            'event_date' => Carbon::create(2025, 9, 5),
            'image' => 'events/himti_meet_2025.jpg',
            'location' => 'BINUS Syahdan - Hall 4th Floor',
            'ticket_price' => 0,
        ]);

        // Event 3: Online-only, gratis
        Event::create([
            'organization_id' => 3,
            'title' => 'TechTalk: Navigating a Career in Cyber Security',
            'description' => 'A free online seminar featuring industry experts on how to get into Cyber Security.',
            'event_date' => Carbon::create(2025, 7, 20),
            'image' => 'events/techtalk_cyber.jpg',
            'location' => 'Online',
            'zoom_link' => 'https://zoom.us/himticybercareer',
            'ticket_price' => 0,
            'registration_link' => 'https://bit.ly/techtalkcyber2025'
        ]);

        Event::create([
            'organization_id' => 4, // SWANARAPALA
            'title' => 'SWANARAPALA Basic Training 2024',
            'description' => 'A foundational training program for prospective SWANARAPALA members to develop survival skills and environmental awareness.',
            'location' => 'Mount Salak, West Java',
            'event_date' => Carbon::create(2024, 6, 30),
            'image' => 'events/diklat_2024.jpg',
            'zoom_link' => null,
            'ticket_price' => 0,
            'registration_link' => null,
        ]);

        Event::create([
            'organization_id' => 4, // SWANARAPALA
            'title' => 'Caving Division Exploration Trip',
            'description' => 'An exciting cave exploration with the caving division to learn about speleology and caving techniques.',
            'location' => 'Jomblang Cave, Yogyakarta',
            'event_date' => Carbon::create(2023, 10, 28),
            'image' => 'events/caving_trip.jpg',
            'zoom_link' => null,
            'ticket_price' => 0,
            'registration_link' => null,
        ]);

        Event::create([
            'organization_id' => 4, // SWANARAPALA
            'title' => 'Introduction to Climbing Gear and Wall Climbing Trial',
            'description' => 'A beginner-friendly workshop introducing rock climbing equipment and basic wall climbing techniques.',
            'location' => 'Wall Climbing Facility, BINUS Anggrek Campus',
            'event_date' => Carbon::create(2023, 8, 10),
            'image' => 'events/wall_climbing.jpg',
            'zoom_link' => null,
            'ticket_price' => 0,
            'registration_link' => null,
        ]);

        Event::create([
            'organization_id' => 5, // BNEC
            'title' => 'English Learning Forum 2025: Enhancing Professional Communication for Global Careers',
            'description' => 'A forum that equips students with the skills and confidence to communicate effectively in global professional settings.',
            'event_date' => Carbon::create(2025, 5, 31),
            'image' => 'events/bnec_elf2025.jpg',
            'location' => 'Auditorium BINUS Anggrek',
            'ticket_price' => 0,
        ]);

        Event::create([
            'organization_id' => 5, // BNEC
            'title' => 'The Extraordinary Quest: Riding the Trail to Greatness',
            'description' => 'An onboarding event for new BNEC members packed with excitement, challenges, and insights into the club’s culture.',
            'event_date' => Carbon::create(2025, 5, 17),
            'image' => 'events/bnec_recruitment2025.jpg',
            'ticket_price' => 0,
        ]);

        Event::create([
            'organization_id' => 5, // BNEC
            'title' => 'Kompetisi Debat Mahasiswa Indonesia (KDMI) 2024',
            'description' => 'A national debate competition where BNEC debaters represent BINUS in a battle of logic, argument, and eloquence.',
            'event_date' => Carbon::create(2024, 8, 21),
            'image' => 'events/bnec_kdmi2024.jpg',
            'location' => 'Universitas Indonesia, Depok',
            'ticket_price' => 0,
        ]);

    }
}
