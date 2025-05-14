<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organization;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class OrganizationSeeder extends Seeder
{
    public function run()
    {
        Organization::create([
            'name' => 'Bina Nusantara Computer Club',
            'description' => 'A leading tech organization of Bina Nusantara.',
            'email' => 'bncc@gmail.com',
            'phone' => '081234567899',
            'website' => 'https://bncc.org',
            'banner_image' => 'banners/bncc.jpg',
            'logo' => 'logos/bncc_logo.jpg',
        ]);

        Organization::create([
            'name' => 'Bersama Dalam Musik',
            'description' => 'Music Talent and Skill Development Organization.',
            'email' => 'bdm@gmail.com',
            'phone' => '081234567900',
            'website' => 'https://student-activity.binus.ac.id/bdm/program/',
            'banner_image' => 'banners/aisociety.jpg',
            'logo' => 'logos/bdm_logo.jpg',
        ]);

        Organization::create([
            'name' => 'BINUS English Club',
            'description' => 'Developing English skills through classes and competitions.',
            'email' => 'bnec@binus.edu',
            'phone' => '081234567901',
            'website' => 'https://student-activity.binus.ac.id/bnec',
            'banner_image' => 'banners/bnec.jpg',
            'logo' => 'logos/bnec_logo.jpg',
        ]);

        Organization::create([
            'name' => 'BINUS Mandarin Club',
            'description' => 'Promoting Mandarin language and culture among students.',
            'email' => 'bnmc@binus.edu',
            'phone' => '081234567902',
            'website' => 'https://student-activity.binus.ac.id/bnmc',
            'banner_image' => 'banners/bnmc.jpg',
            'logo' => 'logos/bnmc_logo.jpg',
        ]);

        Organization::create([
            'name' => 'Nippon Club',
            'description' => 'Exploring Japanese culture and language.',
            'email' => 'nipponclub@binus.edu',
            'phone' => '081234567903',
            'website' => 'https://student-activity.binus.ac.id/nipponclub',
            'banner_image' => 'banners/nipponclub.jpg',
            'logo' => 'logos/nipponclub_logo.jpg',
        ]);

        Organization::create([
            'name' => 'Binus Entrepreneur (B-Preneur)',
            'description' => 'Fostering entrepreneurship among students.',
            'email' => 'bpreneur@binus.edu',
            'phone' => '081234567904',
            'website' => 'https://student-activity.binus.ac.id/bpreneur',
            'banner_image' => 'banners/bpreneur.jpg',
            'logo' => 'logos/bpreneur_logo.jpg',
        ]);

        Organization::create([
            'name' => 'Cyber Security Community (CSC)',
            'description' => 'Promoting cybersecurity awareness and skills.',
            'email' => 'csc@binus.edu',
            'phone' => '081234567906',
            'website' => 'https://student-activity.binus.ac.id/csc',
            'banner_image' => 'banners/csc.jpg',
            'logo' => 'logos/csc_logo.jpg',
        ]);

        Organization::create([
            'name' => 'BINUS TV Club',
            'description' => 'Student-run television club producing various content.',
            'email' => 'binustv@binus.edu',
            'phone' => '081234567907',
            'website' => 'https://student-activity.binus.ac.id/binustv',
            'banner_image' => 'banners/binustv.jpg',
            'logo' => 'logos/binustv_logo.jpg',
        ]);

        Organization::create([
            'name' => 'Klub Seni Fotografi Bina Nusantara (KLIFONARA)',
            'description' => 'Photography club capturing moments and stories.',
            'email' => 'klifonara@binus.edu',
            'phone' => '081234567908',
            'website' => 'https://student-activity.binus.ac.id/klifonara',
            'banner_image' => 'banners/klifonara.jpg',
            'logo' => 'logos/klifonara_logo.jpg',
        ]);

        Organization::create([
            'name' => 'Seni Tari Mahasiswa Bina Nusantara (STAMANARA)',
            'description' => 'Traditional and modern dance performances by students.',
            'email' => 'stamanara@binus.edu',
            'phone' => '081234567910',
            'website' => 'https://student-activity.binus.ac.id/stamanara',
            'banner_image' => 'banners/stamanara.jpg',
            'logo' => 'logos/stamanara_logo.jpg',
        ]);

        Organization::create([
            'name' => 'Seni Teater Mahasiswa Bina Nusantara (STMANIS)',
            'description' => 'Theater club showcasing student acting talents.',
            'email' => 'stmanis@binus.edu',
            'phone' => '081234567911',
            'website' => 'https://student-activity.binus.ac.id/stmanis',
            'banner_image' => 'banners/stmanis.jpg',
            'logo' => 'logos/stmanis_logo.jpg',
        ]);

        Organization::create([
            'name' => 'Modeling Club BINUS (MCB)',
            'description' => 'Fashion and modeling activities for students.',
            'email' => 'mcb@binus.edu',
            'phone' => '081234567912',
            'website' => 'https://student-activity.binus.ac.id/mcb',
            'banner_image' => 'banners/mcb.jpg',
            'logo' => 'logos/mcb_logo.jpg',
        ]);
    }
}
