<?php

namespace Database\Seeders;

use App\Models\Setting;
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
        // Seed Master Admin User
        User::updateOrCreate(
            ['email' => 'admin@mail.com'],
            [
                'name' => 'Master Admin',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
            ]
        );

        // Seed Default Settings
        $defaultSettings = [
            'contact_mobile' => '+91 87439 78796',
            'contact_email' => 'support@maharajalottery.com',
            'contact_address' => 'Lottery Directorate Complex, Vikas Bhavan, Thiruvananthapuram, Kerala 695033',
            'social_whatsapp' => 'https://wa.me/918743978796',
            'social_facebook' => 'https://facebook.com',
            'social_instagram' => 'https://instagram.com',
            'social_twitter' => 'https://twitter.com',
            'hero_title' => 'Maharaja Lottery',
            'hero_subtitle' => 'Tickets, Results & Support',
            'hero_description' => 'Explore current ticket availability, follow verified draw updates and receive clear guidance for winner verification and prize claims.',
            'hero_banner_image' => '',
        ];

        foreach ($defaultSettings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
    }
}
