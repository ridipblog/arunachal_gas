<?php

namespace Database\Seeders;

use App\Enums\NoticeBadge;
use App\Enums\NoticeType;
use App\Models\HeroSlide;
use App\Models\JourneyCard;
use App\Models\Milestone;
use App\Models\Notice;
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

        // 4. Seed Initial 4 News, Events and Notices
        $notices = [
            [
                'title' => 'Quarterly Safety Audit',
                'description' => 'Scheduled for 24th Oct. All personnel are required to participate.',
                'date_text' => '23 Oct 2026 - 10:00 AM',
                'badge' => NoticeBadge::New,
                'type' => NoticeType::Notice,
                'icon_path' => 'images/assets/Quarterly Safety Audit.png',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'New Compliance Guidelines',
                'description' => 'Updated policy documents are now available on the internal portal.',
                'date_text' => '22 Oct 2026 - 02:30 PM',
                'badge' => NoticeBadge::New,
                'type' => NoticeType::Notice,
                'icon_path' => 'images/assets/New Compliance Guidelines.png',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Town Hall Meeting',
                'description' => 'Join us for the Q3 performance review and future roadmap discussion.',
                'date_text' => '21 Oct 2026 - 11:00 AM',
                'badge' => NoticeBadge::New,
                'type' => NoticeType::Event,
                'icon_path' => 'images/assets/Town Hall Meeting.png',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'IT System Maintenance',
                'description' => 'Scheduled downtime for system upgrades. Expect service interruptions.',
                'date_text' => '25 Oct 2026 - 08:00 PM',
                'badge' => NoticeBadge::Upcoming,
                'type' => NoticeType::Notice,
                'icon_path' => 'images/assets/IT System Maintenance.png',
                'order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($notices as $notice) {
            Notice::updateOrCreate(
                ['title' => $notice['title']],
                $notice
            );
        }

        // 5. Seed Initial 5 Capturing Our Journey Bento Cards
        $journeyCards = [
            [
                'title' => 'Energy Infrastructure',
                'description' => 'Building safe energy networks for tomorrow.',
                'image_path' => 'images/assets/journey_1.png',
                'image_alt' => 'Energy Infrastructure in Arunachal Pradesh',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'People Behind Progress',
                'description' => 'Our teams making a difference every day.',
                'image_path' => 'images/assets/journey_2.png',
                'image_alt' => 'People Behind Progress - AGPL Field Engineers',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Towards a Greener Future',
                'description' => 'Moving towards sustainable energy solutions.',
                'image_path' => 'images/assets/journey_3.png',
                'image_alt' => 'Towards a Greener Future - Clean Energy for Arunachal',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Events & Engagements',
                'description' => 'Connecting people and ideas.',
                'image_path' => 'images/assets/journey_4.png',
                'image_alt' => 'Community Events and Public Engagements',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Collaboration & Planning',
                'description' => 'Working together towards shared goals.',
                'image_path' => 'images/assets/journey_5.png',
                'image_alt' => 'Engineering Collaboration and Regional Planning',
                'order' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($journeyCards as $card) {
            JourneyCard::updateOrCreate(
                ['title' => $card['title']],
                $card
            );
        }

        // 6. Seed Initial 8 Key Milestones for Journey Timeline
        $milestones = [
            [
                'period' => 'Dec 2023',
                'title' => 'BPCL Board approves bid strategy for CGD Round 12 & 12A',
                'icon' => 'document',
                'is_highlighted' => false,
                'order' => 1,
                'is_active' => true,
            ],
            [
                'period' => 'Apr 2024',
                'title' => 'PNGRB grants CGD authorisation for GA-12.01 to BPCL–OIL Consortium',
                'icon' => 'gavel',
                'is_highlighted' => false,
                'order' => 2,
                'is_active' => true,
            ],
            [
                'period' => 'Oct–Nov 2024',
                'title' => 'BPCL & OIL Boards approve JVA; DIPAM/MoPNG guidelines followed',
                'icon' => 'handshake',
                'is_highlighted' => false,
                'order' => 3,
                'is_active' => true,
            ],
            [
                'period' => 'Jun 2025',
                'title' => 'DIPAM concurrence & MoPNG approval received for JV formation',
                'icon' => 'verified',
                'is_highlighted' => false,
                'order' => 4,
                'is_active' => true,
            ],
            [
                'period' => '2025–26',
                'title' => 'AGPL incorporated; Board, CEO, CFO and core team operationalised',
                'icon' => 'users',
                'is_highlighted' => false,
                'order' => 5,
                'is_active' => true,
            ],
            [
                'period' => 'Jun 2026',
                'title' => "Stakeholder outreach launched — DC-ICR, Director (Earth Sciences), Hon'ble Home Minister, Arunachal Pradesh",
                'icon' => 'megaphone',
                'is_highlighted' => false,
                'order' => 6,
                'is_active' => true,
            ],
            [
                'period' => 'Aug 2026',
                'title' => "Namsai district engagement — Hon'ble MLA & DC Namsai; Namsai proposed as role-model district",
                'icon' => 'map-pin',
                'is_highlighted' => false,
                'order' => 7,
                'is_active' => true,
            ],
            [
                'period' => 'Aug 2026',
                'title' => 'Management Review — governance, procurement and financing workstreams active',
                'icon' => 'settings',
                'is_highlighted' => true,
                'order' => 8,
                'is_active' => true,
            ],
        ];

        foreach ($milestones as $milestone) {
            Milestone::updateOrCreate(
                ['title' => $milestone['title']],
                $milestone
            );
        }
    }
}
