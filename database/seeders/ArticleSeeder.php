<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Organization;
use App\Models\Event;
use App\Models\Article;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        Article::create([
            'organization_id' => 1, // BNCC
            'title' => 'The Future of Programming',
            'description' => 'A deep dive into what the future holds for developers.',
            'image' => 'articles/future_programming.jpg',
        ]);

        Article::create([
            'organization_id' => 1, // BNCC
            'title' => 'AI and Its Impact on Society',
            'description' => 'Understanding how AI is shaping the world.',
            'image' => 'articles/ai_impact.jpg',
        ]);

        Article::create([
            'organization_id' => 1, // BNCC
            'title' => 'Best Coding Practices',
            'description' => 'Learn the best coding practices for efficiency and security.',
            'image' => 'articles/coding_practices.jpg',
        ]);

        Article::create([
            'organization_id' => 2, // BDM
            'title' => 'Behind the Scenes of New Year Concert 9.0',
            'description' => 'Ever wondered what it takes to prepare for one of BDM\'s biggest performances of the year? In this article, we take you behind the curtains of New Year Concert 9.0—rehearsals, outfit chaos, and the adrenaline rush before going on stage.',
            'image' => 'articles/behind_concert9.jpg',
        ]);

        Article::create([
            'organization_id' => 2, // BDM
            'title' => 'Why Joining a Music Organization Improves Your Soft Skills',
            'description' => 'Think BDM is just about music? Think again. This article explores how being part of a musical organization can boost your communication, leadership, and teamwork abilities—skills you didn’t know you were practicing while jamming with friends.',
            'image' => 'articles/music_softskills.jpg',
        ]);

        Article::create([
            'organization_id' => 2, // BDM
            'title' => 'Meet the Talents: BDM\'s Rising Stars',
            'description' => 'Get to know the passionate individuals behind the melodies. From soloists to saxophonists, this article highlights BDM’s standout members and their stories of growth, grind, and groove.',
            'image' => 'articles/talent_spotlight.jpg',
        ]);

        Article::create([
            'organization_id' => 3, // HIMTI BINUS
            'title' => 'HISHOT 2024: Level Up Your Coding Skills',
            'description' => 'HISHOT 2024 was successfully held with workshops on the latest technologies, helping students enhance their technical skills and expand their network.',
            'image' => 'articles/himti_hishot2024.jpg',
        ]);

        Article::create([
            'organization_id' => 3, // HIMTI BINUS
            'title' => 'TECHFEST 2024: Celebrating Innovation & Creativity',
            'description' => 'TECHFEST became a platform for showcasing impressive student projects in Informatics Engineering, featuring competitions, seminars, and tech exhibitions.',
            'image' => 'articles/himti_techfest2024.jpg',
        ]);

        Article::create([
            'organization_id' => 3, // HIMTI BINUS
            'title' => 'HIMTI CARE: Empowering Communities through Kindness',
            'description' => 'Through the HIMTI CARE initiative, students demonstrated social responsibility by organizing inspiring community service activities.',
            'image' => 'articles/himti_care2024.jpg',
        ]);

        Article::create([
            'organization_id' => 4, // SWANARAPALA
            'title' => '5 Essential Hiking Tips for Beginners',
            'description' => 'Hiking is fun, but safety always comes first. Here are 5 essential tips for a safe and enjoyable trip: (1) Research your hiking route, (2) Use proper gear, (3) Don’t hike alone, (4) Pack enough food and water, and (5) Respect nature and follow trail rules. Remember — take nothing but pictures, leave nothing but footprints!',
            'image' => 'articles/tips_hiking.jpg',
        ]);

        Article::create([
            'organization_id' => 4, // SWANARAPALA
            'title' => 'Meet SWANARAPALA’s Caving Division',
            'description' => 'Our Caving Division is all about underground adventure. Members explore natural caves and learn about speleology, caving techniques, and how to preserve fragile underground ecosystems. It’s not just physically challenging — it also builds teamwork, curiosity, and a deep respect for nature’s hidden wonders.',
            'image' => 'articles/caving_division.jpg',
        ]);

        Article::create([
            'organization_id' => 4, // SWANARAPALA
            'title' => 'Celebrating SWANARAPALA’s 34th Anniversary',
            'description' => 'December 10th, 2024 marked the 34th anniversary of SWANARAPALA. From its humble beginnings as MAKOPALA to becoming an official student organization, our journey has been nothing short of inspiring. This year’s celebration included a group hike, a documentary screening, and an alumni sharing session. Thank you to all members — past and present — who have shaped our legacy!',
            'image' => 'articles/anniversary.jpg',
        ]);

        Article::create([
            'organization_id' => 5, // BNEC
            'title' => 'Mastering Public Speaking: Tips from the Pros',
            'description' => 'BNEC’s seasoned speakers share their secrets to delivering powerful and confident speeches in front of any audience.',
            'image' => 'articles/public_speaking_tips.jpg',
        ]);

        Article::create([
            'organization_id' => 5, // BNEC
            'title' => 'Level Up Your TOEFL Score with These Study Hacks',
            'description' => 'From time management to vocabulary drills—check out our top strategies to boost your TOEFL performance.',
            'image' => 'articles/toefl_study_hacks.jpg',
        ]);

        Article::create([
            'organization_id' => 5, // BNEC
            'title' => 'Inside The Asian English Olympics: A Journey of Passion and Precision',
            'description' => 'Relive the excitement of AEO 2025, where talented students from across Asia battled it out with words, wit, and wisdom.',
            'image' => 'articles/aeo_2025_recap.jpg',
        ]);
    }
}
