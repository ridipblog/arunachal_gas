<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use App\Models\Service;
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
        // 1. Seed or update the Admin User
        User::updateOrCreate(
            ['email' => 'admin@agpl.in'],
            [
                'name' => 'AGPL Administrator',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ]
        );

        // 2. Seed the 6 Initial Services for "Explore Our Services" Accordion
        $services = [
            [
                'number_label' => '01/',
                'title' => 'Domestic PNG',
                'slug' => 'domestic-png',
                'card_heading' => 'Convenient piped natural gas for everyday cooking',
                'badges' => ['Safe & Reliable', 'Continuous Supply', 'Zero Cylinder Booking'],
                'image_path' => 'images/assets/domestic_png_kitchen.png',
                'image_alt' => 'AGPL Domestic PNG Kitchen Connection with Safe Blue Gas Flame',
                'description' => 'Enjoy cooking without the hassle of heavy cylinders, booking delays, or gas refills. AGPL\'s pipeline network delivers clean, uninterrupted piped natural gas directly to your home kitchen 24 hours a day.',
                'button_text' => 'Know More',
                'button_url' => '#contact',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'number_label' => '02/',
                'title' => 'Commercial and Industrial PNG',
                'slug' => 'commercial-and-industrial-png',
                'card_heading' => 'High-calorific uninterrupted fuel for hotels, hospitals, and industrial facilities',
                'badges' => ['High Calorific Value', 'Zero Storage Hassle', 'Accurate Metering'],
                'image_path' => 'images/assets/Pipeline Construction in Green Mountains 1.png',
                'image_alt' => 'Commercial and Industrial Natural Gas Connection',
                'description' => 'Power your commercial kitchens, boilers, and industrial furnaces with uninterrupted piped natural gas. Cut fuel storage costs, avoid pilferage, and significantly lower emissions.',
                'button_text' => 'Know More',
                'button_url' => '#contact',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'number_label' => '03/',
                'title' => 'CNG for Transportation',
                'slug' => 'cng-for-transportation',
                'card_heading' => 'Economical and eco-friendly automotive fuel for public and private mobility',
                'badges' => ['Up to 40% Fuel Savings', 'Zero Adulteration', 'Fast & Safe Refueling'],
                'image_path' => 'images/assets/gas_station.png',
                'image_alt' => 'AGPL Modern CNG Station Dispenser',
                'description' => 'Compressed Natural Gas (CNG) is the greener and more economical fuel choice for taxis, private cars, and commercial transport fleets across Arunachal Pradesh.',
                'button_text' => 'Know More',
                'button_url' => '#contact',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'number_label' => '04/',
                'title' => 'CGD Infrastructure',
                'slug' => 'cgd-infrastructure',
                'card_heading' => 'Building long-term regional assets: City Gate Stations, MDPE pipelines and trunk networks',
                'badges' => ['SCADA Monitored', 'High Pressure Steel', 'Cascade Refueling'],
                'image_path' => 'images/assets/Pipeline Construction in Green Mountains 1.png',
                'image_alt' => 'CGD Infrastructure Development in Arunachal Pradesh',
                'description' => 'Building resilient City Gate Stations (CGS), steel mother networks, and MDPE distribution lines designed specifically for Arunachal\'s rugged mountainous terrain.',
                'button_text' => 'Know More',
                'button_url' => '#contact',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'number_label' => '05/',
                'title' => 'Tenders and Procurement',
                'slug' => 'tenders-and-procurement',
                'card_heading' => 'Transparent e-procurement portal for contractors, suppliers, and engineering partners',
                'badges' => ['E-Tendering Portal', 'Vendor Empanelment', 'Fair & Transparent'],
                'image_path' => 'images/assets/Misty Mountain Wave Landscape 1.png',
                'image_alt' => 'AGPL Transparent Tenders and Procurement',
                'description' => 'Participate in AGPL procurement opportunities, equipment supply tenders, and infrastructure construction contracts with a 100% transparent bidding framework.',
                'button_text' => 'Know More',
                'button_url' => '#contact',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'number_label' => '06/',
                'title' => 'Customer Support',
                'slug' => 'customer-support',
                'card_heading' => 'Round-the-clock emergency response, billing assistance, and grievance resolution',
                'badges' => ['24x7 Emergency Line', 'Rapid Grievance Redressal', 'Consumer Safety Camps'],
                'image_path' => 'images/assets/gas_station.png',
                'image_alt' => 'AGPL Customer Care & Emergency Services',
                'description' => 'Dedicated customer support with rapid dispatch emergency vans, multilingual helpline, quick meter reading assistance, and localized walk-in customer facilitation centers.',
                'button_text' => 'Know More',
                'button_url' => '#contact',
                'order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($services as $svc) {
            Service::updateOrCreate(
                ['slug' => $svc['slug']],
                $svc
            );
        }

        // 3. Seed Initial 3 Hero Slides
        $heroSlides = [
            [
                'title' => 'Connecting Arunachal Pradesh to a Cleaner Energy Future',
                'image_path' => 'images/assets/Group 1000002719.png',
                'image_alt' => 'Connecting Arunachal Pradesh to a Cleaner Energy Future',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Empowering Transportation with Cleaner Energy for a Better Tomorrow',
                'image_path' => 'images/assets/hero_2.png',
                'image_alt' => 'Empowering Transportation with Cleaner Energy for a Better Tomorrow',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Bringing Safe and Reliable Natural Gas to Your Home',
                'image_path' => 'images/assets/hero_3.png',
                'image_alt' => 'Bringing Safe and Reliable Natural Gas to Your Home',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($heroSlides as $slide) {
            HeroSlide::updateOrCreate(
                ['title' => $slide['title']],
                $slide
            );
        }
    }
}
