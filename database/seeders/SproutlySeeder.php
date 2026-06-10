<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\AhliBotani;
use Illuminate\Support\Facades\Hash;

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

        $expertUser = User::create([
            'nama_user' => 'Budi Ahli',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'ahli',
        ]);

        AhliBotani::create([
            'user_id' => $expertUser->id,
            'nama_ahli' => 'Budi Ahli',
            'no_telp_ahli' => '08123456789',
            'tanggal_lahir_ahli' => '1995-01-10',
            'jenis_kelamin_ahli' => 'L',
            'domisili' => 'Bandung',
            'nama_almamater' => 'Universitas Indonesia',
        ]);
    }
}