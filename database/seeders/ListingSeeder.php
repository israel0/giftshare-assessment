<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\ListingPhoto;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ListingSeeder extends Seeder
{
    protected array $listings = [
        [
            'title' => 'Mid-Century Modern Accent Chair',
            'description' => 'Comfortable fabric accent chair with wooden legs. Great condition, perfect for a reading nook.',
            'city' => 'San Diego',
            'weight' => 12.0,
            'dimensions' => '70x70x85 cm',
            'status' => 'available',
            'category_name' => 'Furniture',
            'image_file' => 'chair.png',
        ],
        [
            'title' => 'Compact Personal Freezer',
            'description' => 'Small upright freezer, perfect for an apartment or garage. Fully functional, frost-free.',
            'city' => 'Dallas',
            'weight' => 30.0,
            'dimensions' => '50x50x120 cm',
            'status' => 'available',
            'category_name' => 'Home & Garden',
            'image_file' => 'freezer.png',
        ],
        [
            'title' => 'Full-Size Upright Refrigerator/Fridge',
            'description' => 'Standard stainless steel fridge with top freezer. Excellent working order.',
            'city' => 'San Jose',
            'weight' => 75.0,
            'dimensions' => '70x70x170 cm',
            'status' => 'gifted',
            'category_name' => 'Home & Garden',
            'image_file' => 'frig.png',
        ],
        [
            'title' => 'High-Velocity Floor Fan',
            'description' => 'Three-speed oscillating floor fan.',
            'city' => 'Austin',
            'weight' => 4.5,
            'dimensions' => '40x20x45 cm',
            'status' => 'available',
            'category_name' => 'Home & Garden',
            'image_file' => 'fan.png',
        ],
        [
            'title' => 'Modern Minimalist House Sketch',
            'description' => 'A framed sketch of a modern house.',
            'city' => 'Fort Worth',
            'weight' => 1.5,
            'dimensions' => '40x60 cm',
            'status' => 'available',
            'category_name' => 'Art & Craft',
            'image_file' => 'house.png',
        ],
        [
            'title' => 'Sporty Sedan Model Car',
            'description' => 'High-end die-cast model car (1:18 scale).',
            'city' => 'Columbus',
            'weight' => 1.2,
            'dimensions' => '30x15x10 cm',
            'status' => 'available',
            'category_name' => 'Toys & Games',
            'image_file' => 'car.png',
        ],
        [
            'title' => 'Portable Electric Generator 2000W',
            'description' => 'Gas-powered generator, used once.',
            'city' => 'Jacksonville',
            'weight' => 25.0,
            'dimensions' => '60x40x50 cm',
            'status' => 'available',
            'category_name' => 'Tools & DIY',
            'image_file' => 'generator.png',
        ],
    ];

    public function run(): void
    {
        $users = User::all();
        $categories = Category::all()->keyBy('name');

        // ---------------------------------------------
        //  MOVE PUBLIC/IMAGES → STORAGE/LISTINGS
        // ---------------------------------------------
        $sourceDir = public_path('images');
        $targetDir = storage_path('app/public/listings');

        if (!File::exists($targetDir)) {
            File::makeDirectory($targetDir, 0777, true);
        }

        foreach (File::files($sourceDir) as $file) {
            $targetFile = $targetDir . '/' . $file->getFilename();

            // Copy only if not already copied
            if (!File::exists($targetFile)) {
                File::copy($file->getPathname(), $targetFile);
            }
        }

        $this->command->info('✔ Dummy images copied to storage/listings/');


        // ---------------------------------------------
        //  CREATE LISTINGS + IMAGE RECORDS
        // ---------------------------------------------
        foreach ($this->listings as $listingData) {

            $category = $categories[$listingData['category_name']];

            $listing = Listing::create([
                'user_id' => $users->random()->id,
                'category_id' => $category->id,
                'title' => $listingData['title'],
                'slug' => Str::slug($listingData['title']) . '-' . Str::random(6),
                'description' => $listingData['description'],
                'city' => $listingData['city'],
                'weight' => $listingData['weight'],
                'dimensions' => $listingData['dimensions'],
                'status' => $listingData['status'],
                'gifted_at' => $listingData['status'] === 'gifted' ? now()->subDays(rand(1, 30)) : null,
            ]);

            if ($listingData['image_file']) {

                ListingPhoto::create([
                    'listing_id' => $listing->id,
                    'path' => 'listings/' . $listingData['image_file'],
                    'thumbnail_path' => 'listings/' . $listingData['image_file'], // (optional)
                    'order' => 0,
                ]);
            }
        }

        $this->command->info(' Listings seeded successfully!');
    }
}
