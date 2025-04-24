<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pelanggan;
use App\Models\Dokumen;
use Illuminate\Support\Str;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $pelanggan = Pelanggan::create([
                'nama' => 'Pelanggan ' . $i,
                'no_pelanggan' => 'PLG' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'alamat' => 'Alamat Pelanggan ' . $i,
                'telepon' => '0812' . rand(10000000, 99999999),
            ]);

            $jumlahDokumen = rand(3, 7);
            for ($j = 1; $j <= $jumlahDokumen; $j++) {
                Dokumen::create([
                    'pelanggan_id' => $pelanggan->id,
                    'dokumen' => 'Dokumen ' . Str::random(5),
                    'status' => $j%2==1 ? 'confirmed' : 'shipped',
                    'nr' => 'NR' . rand(1000, 9999),
                    'tanggal' => now()->subDays(rand(10, 100)),
                    'realisasi' => now()->subDays(rand(1, 9)),
                    'tanggal_awal' => now()->subDays(rand(50, 150)),
                ]);
            }
        }
    }
}
