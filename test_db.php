<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->handle(Illuminate\Http\Request::capture());

echo "=== AHLI BOTANI ===\n";
foreach (App\Models\AhliBotani::all() as $a) {
    echo "ID: {$a->id}, Nama: {$a->nama_ahli}, User ID: {$a->user_id}\n";
}

echo "\n=== JADWAL AHLI ===\n";
foreach (App\Models\JadwalAhli::all() as $j) {
    echo "ID: {$j->id}, Ahli ID: {$j->ahli_botani_id}, Hari: {$j->hari}, Jam: {$j->jam_mulai} - {$j->jam_selesai}, Status: {$j->status_ketersediaan}\n";
}
