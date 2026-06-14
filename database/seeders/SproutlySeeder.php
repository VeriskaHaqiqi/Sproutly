<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\AhliBotani;
use Illuminate\Support\Facades\Hash;

use App\Models\TarifAhli;

class SproutlySeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'nama_user' => 'Rani User',
            'email' => 'rani@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        $expertsData = [
            [
                'name' => 'Budi Ahli',
                'email' => 'budi@gmail.com',
                'specialization' => 'Orchid Specialist',
                'experience' => 8,
                'price' => 45000,
                'bio' => 'Budi is a senior plant disease specialist focusing on orchids and decorative house plants. He has over 8 years of experience helping home gardeners keep their orchids healthy.',
                'domisili' => 'Bandung',
                'almamater' => 'Universitas Indonesia',
                'gender' => 'L'
            ],
            [
                'name' => 'Reza Firmansyah',
                'email' => 'reza@gmail.com',
                'specialization' => 'Crop Science',
                'experience' => 15,
                'price' => 45000,
                'bio' => 'Reza is a senior agronomist with over 15 years of experience in crop science and sustainable agriculture. His focus includes harvest optimization, crop rotation, and soil fertility management for both commercial farms and smallholders.',
                'domisili' => 'Bogor, Jawa Barat',
                'almamater' => 'Institut Pertanian Bogor (IPB)',
                'gender' => 'L'
            ],
            [
                'name' => 'Sarah Chen',
                'email' => 'sarah@gmail.com',
                'specialization' => 'Soil Management',
                'experience' => 12,
                'price' => 52000,
                'bio' => 'Sarah Chen specializes in soil health assessment and nutrient management. She has helped over 200 farmers improve land productivity through in-depth soil analysis and science-based fertilizer recommendations.',
                'domisili' => 'Yogyakarta, DIY',
                'almamater' => 'Universitas Gadjah Mada (UGM)',
                'gender' => 'P'
            ],
            [
                'name' => 'Bagas Priyatno',
                'email' => 'bagas@gmail.com',
                'specialization' => 'Pest Control',
                'experience' => 10,
                'price' => 38000,
                'bio' => 'Bagas is an integrated pest management (IPM) specialist with an eco-friendly approach. He develops evidence-based biological and chemical solutions to protect crops from pests without disrupting the surrounding ecosystem.',
                'domisili' => 'Malang, Jawa Timur',
                'almamater' => 'Universitas Brawijaya (UB)',
                'gender' => 'L'
            ],
            [
                'name' => 'Dewi Kusuma',
                'email' => 'dewi@gmail.com',
                'specialization' => 'Organic Farming',
                'experience' => 14,
                'price' => 48000,
                'bio' => 'Dewi is a certified organic farming consultant who has helped hundreds of farmers transition to organic systems. Her expertise covers organic certification, composting, and holistic farm ecosystem management.',
                'domisili' => 'Bandung, Jawa Barat',
                'almamater' => 'Institut Pertanian Bogor (IPB)',
                'gender' => 'P'
            ],
            [
                'name' => 'Hendra Wibowo',
                'email' => 'hendra@gmail.com',
                'specialization' => 'Irrigation Systems',
                'experience' => 8,
                'price' => 55000,
                'bio' => 'Hendra is an agricultural irrigation systems engineer experienced in designing drip irrigation, sprinkler, and canal systems for various farm scales. His focus is on water use efficiency and soil moisture sensor technology.',
                'domisili' => 'Surabaya, Jawa Timur',
                'almamater' => 'Institut Teknologi Bandung (ITB)',
                'gender' => 'L'
            ],
        ];

        $createdExperts = [];
        foreach ($expertsData as $data) {
            $expertUser = User::create([
                'nama_user' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make('password123'),
                'role' => 'ahli',
            ]);

            $expert = AhliBotani::create([
                'user_id' => $expertUser->id,
                'nama_ahli' => $data['name'],
                'no_telp_ahli' => '08123456789',
                'tanggal_lahir_ahli' => '1995-01-10',
                'jenis_kelamin_ahli' => $data['gender'],
                'domisili' => $data['domisili'],
                'nama_almamater' => $data['almamater'],
                'spesialisasi' => $data['specialization'],
                'bio' => $data['bio'],
                'pengalaman_tahun' => $data['experience'],
            ]);

            TarifAhli::create([
                'ahli_botani_id' => $expert->id,
                'tarif' => $data['price'],
                'tgl_mulai_berlaku' => now(),
                'status_aktif' => 'aktif',
            ]);

            $createdExperts[$data['name']] = $expert->id;
        }

        // Seed mock articles
        $articles = [
            [
                'author' => 'Hendra Wibowo',
                'judul' => 'Modern Irrigation Techniques for Water Conservation',
                'kategori' => 'irrigation',
                'thumbnail' => 'https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=800&q=80',
                'konten' => 'Water scarcity is one of the most pressing challenges in modern agriculture. As global demand for food increases, farmers must find smarter ways to use water — and modern irrigation technology is leading the charge.

Drip irrigation delivers water directly to the root zone of plants, dramatically reducing evaporation and runoff. Unlike traditional flood irrigation, drip systems can cut water usage by up to 50% while maintaining or even improving crop yields.

Smart irrigation controllers use weather data, soil sensors, and crop evapotranspiration models to automatically adjust watering schedules. These systems ensure crops receive exactly the right amount of water at the right time.

Subsurface drip irrigation (SDI) takes efficiency even further by burying drip lines below the soil surface. This eliminates surface evaporation entirely and keeps foliage dry, reducing fungal disease risk.

Soil moisture sensors placed at various root depths give farmers real-time data on water availability. When combined with automated irrigation controllers, these sensors can trigger watering cycles only when genuinely needed.'
            ],
            [
                'author' => 'Sarah Chen',
                'judul' => 'Building Healthy Soil Through Composting',
                'kategori' => 'soil health',
                'thumbnail' => 'https://images.unsplash.com/photo-1461354464878-ad92f492a5a0?w=800&q=80',
                'konten' => 'Healthy soil is the foundation of productive agriculture. Yet decades of intensive farming have degraded soil quality worldwide. Composting offers a natural, cost-effective way to restore and maintain soil health for generations to come.

Compost is decomposed organic matter — kitchen scraps, crop residues, manure, and yard waste — transformed by microorganisms into a rich, dark material that improves soil structure, water retention, and nutrient availability.

Adding compost to sandy soils helps them retain moisture and nutrients. In clay soils, compost improves drainage and aeration. Either way, the result is a more hospitable environment for plant roots and soil organisms.

The ideal compost pile balances "browns" (carbon-rich materials like straw, cardboard, and dry leaves) with "greens" (nitrogen-rich materials like food scraps, grass clippings, and fresh manure) in roughly a 3:1 ratio by volume.

Vermicomposting uses worms — typically red wigglers — to process organic waste into castings, a form of compost that is even richer in plant-available nutrients than conventional compost. Worm castings also contain beneficial microbes that suppress plant diseases.'
            ],
            [
                'author' => 'Bagas Priyatno',
                'judul' => 'Organic Pest Management Strategies',
                'kategori' => 'pest control',
                'thumbnail' => 'https://images.unsplash.com/photo-1471193945509-9ad0617afabf?w=800&q=80',
                'konten' => 'Chemical pesticides have long been the default response to farm pests. But growing concerns about environmental impact, human health, and pesticide resistance are driving a shift toward organic pest management strategies that work with nature rather than against it.

Integrated Pest Management (IPM) is a holistic approach that combines biological, cultural, physical, and chemical tools to minimize pest damage in an economically and environmentally sound way. Organic IPM eliminates synthetic chemicals entirely.

The first step in organic pest management is accurate identification. Many insects that look like pests are actually beneficial predators. Misidentification leads to unnecessary interventions that can disrupt natural pest control.

Ladybugs, lacewings, parasitic wasps, and ground beetles are powerful natural predators of common crop pests. Creating habitat for these beneficial insects — through hedgerows, flower strips, and reduced tillage — encourages them to take up residence in farm fields.'
            ],
            [
                'author' => 'Reza Firmansyah',
                'judul' => 'Using Drones for Precision Agriculture',
                'kategori' => 'technology',
                'thumbnail' => 'https://images.unsplash.com/photo-1473448912268-2022ce9509d8?w=800&q=80',
                'konten' => 'Agricultural drones have moved from novelty to necessity in just a few years. From crop scouting to precision spraying, unmanned aerial vehicles are giving farmers a bird\'s-eye view of their fields — and transforming how decisions get made.

Modern agricultural drones carry multispectral cameras that capture data beyond the visible spectrum. NDVI (Normalized Difference Vegetation Index) maps generated from this data reveal crop stress, nutrient deficiencies, and irrigation problems invisible to the naked eye.

A single drone flight can survey hundreds of hectares in minutes, providing data that would take field workers days to collect on foot. Early detection of problems means earlier intervention — and significantly less crop loss.'
            ],
            [
                'author' => 'Reza Firmansyah',
                'judul' => 'Crop Rotation for Long-Term Sustainability',
                'kategori' => 'sustainability',
                'thumbnail' => 'https://images.unsplash.com/photo-1500937386664-56d1dfef3854?w=800&q=80',
                'konten' => 'Planting the same crop in the same field year after year is a recipe for trouble — declining yields, pest buildup, and soil exhaustion. Crop rotation is agriculture\'s oldest tool for maintaining productivity, and modern research continues to validate its power.

Crop rotation involves planting different crops sequentially in the same field across seasons or years. By alternating plant families, farmers interrupt pest and disease cycles, improve soil structure, and balance nutrient demands.'
            ]
        ];

        foreach ($articles as $art) {
            \App\Models\Artikel::create([
                'ahli_botani_id' => $createdExperts[$art['author']] ?? reset($createdExperts),
                'judul' => $art['judul'],
                'kategori' => $art['kategori'],
                'thumbnail' => $art['thumbnail'],
                'konten' => $art['konten'],
                'tanggal_unggah' => now()
            ]);
        }
    }
}