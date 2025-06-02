<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'organization_id' => 1, // BNCC
            'category_id' => 1,
            'name' => 'BNCC Hoodie',
            'price' => 500000,
            'stock' => 100,
            'image' => 'products/bncc_hoodie.jpg',
        ]);

        Product::create([
            'organization_id' => 1, // BNCC
            'category_id' => 2,
            'name' => 'BNCC Notebook',
            'price' => 75000,
            'stock' => 200,
            'image' => 'products/bncc_notebook.jpg',
        ]);

        Product::create([
            'organization_id' => 1, // BNCC
            'category_id' => 3,
            'name' => 'BNCC Sticker Pack',
            'price' => 25000,
            'stock' => 500,
            'image' => 'products/bncc_sticker.jpg',
        ]);

        Product::create([
            'organization_id' => 2, // BDM
            'category_id' => 1,
            'name' => 'BDM Official Hoodie – "Feel the Beat"',
            'price' => 320000,
            'stock' => 75,
            'image' => 'products/bdm_hoodie.jpg',
        ]);

        Product::create([
            'organization_id' => 2, // BDM
            'category_id' => 2,
            'name' => 'BDM Lanyard – Orchestra Edition',
            'price' => 45000,
            'stock' => 150,
            'image' => 'products/bdm_lanyard.jpg',
        ]);

        Product::create([
            'organization_id' => 2, // BDM
            'category_id' => 3,
            'name' => 'BDM Custom Enamel Pin Set – Music Vibes',
            'price' => 30000,
            'stock' => 300,
            'image' => 'products/bdm_pin_set.jpg',
        ]);

        Product::create([
            'organization_id' => 3, // HIMTI
            'category_id' => 1, 
            'name' => 'HIMTI Hoodie - One Family Edition',
            'price' => 450000,
            'stock' => 80,
            'image' => 'products/himti_hoodie.jpg',
        ]);

        Product::create([
            'organization_id' => 3,
            'category_id' => 2, 
            'name' => 'HIMTI Stainless Tumbler 2025',
            'price' => 120000,
            'stock' => 150,
            'image' => 'products/himti_tumbler.jpg',
        ]);

        Product::create([
            'organization_id' => 3,
            'category_id' => 3, 
            'name' => 'HIMTI Sticker Pack - Tech Series',
            'price' => 20000,
            'stock' => 300,
            'image' => 'products/himti_stickers.jpg',
        ]);

        Product::create([
            'organization_id' => 4, // SWANARAPALA
            'category_id' => 1,
            'name' => 'SWANARAPALA Adventure Hoodie',
            'price' => 480000,
            'stock' => 80,
            'image' => 'products/swanarapala_hoodie.jpg',
        ]);

        Product::create([
            'organization_id' => 4,
            'category_id' => 2,
            'name' => 'SWANARAPALA Enamel Mug',
            'price' => 95000,
            'stock' => 150,
            'image' => 'products/swanarapala_mug.jpg',
        ]);

        Product::create([
            'organization_id' => 4,
            'category_id' => 3, 
            'name' => 'SWANARAPALA Carabiner Keychain',
            'price' => 30000,
            'stock' => 300,
            'image' => 'products/swanarapala_carabiner.jpg',
        ]);

        Product::create([
            'organization_id' => 5, // BNEC
            'category_id' => 1, 
            'name' => 'BNEC T-Shirt: Speak with Confidence',
            'price' => 120000,
            'stock' => 100,
            'image' => 'products/bnec_tshirt.jpg',
        ]);

        Product::create([
            'organization_id' => 5,
            'category_id' => 2, 
            'name' => 'BNEC English Warrior Totebag',
            'price' => 80000,
            'stock' => 150,
            'image' => 'products/bnec_totebag.jpg',
        ]);

        Product::create([
            'organization_id' => 5,
            'category_id' => 3, 
            'name' => 'TOEFL Vocabulary Flashcards',
            'price' => 95000,
            'stock' => 75,
            'image' => 'products/bnec_flashcards.jpg',
        ]);
    }
}
