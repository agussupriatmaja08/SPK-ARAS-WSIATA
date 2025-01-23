<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WisataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wisatas')->insert([
            [
                'name' => 'Pantai Kuta',
                'description' => 'Salah satu pantai terkenal di Bali dengan pasir putih.',
                'waktu_operasional' => '24 Jam',
                'lokasi' => 'Bali',
                'aksesibilitas' => 4.5,
                'kondisi_alam' => 4.7,
                'budaya' => 4.8,
                'infrastruktur' => 4.3,
                'jarak_terdekat' => 5.0,
                'keamanan' => 4.6,
                'biaya' => 0,
            ],
            [
                'name' => 'Candi Borobudur',
                'description' => 'Candi Buddha terbesar di dunia yang terletak di Magelang, Jawa Tengah.',
                'waktu_operasional' => '6:00 - 17:00',
                'lokasi' => 'Jawa Tengah',
                'aksesibilitas' => 4.0,
                'kondisi_alam' => 4.5,
                'budaya' => 5.0,
                'infrastruktur' => 4.0,
                'jarak_terdekat' => 10.0,
                'keamanan' => 4.7,
                'biaya' => 50000,
            ],
            [
                'name' => 'Gunung Bromo',
                'description' => 'Gunung berapi yang terkenal dengan pemandangan matahari terbitnya.',
                'waktu_operasional' => '24 Jam',
                'lokasi' => 'Jawa Timur',
                'aksesibilitas' => 3.5,
                'kondisi_alam' => 4.8,
                'budaya' => 4.2,
                'infrastruktur' => 3.8,
                'jarak_terdekat' => 20.0,
                'keamanan' => 4.5,
                'biaya' => 25000,
            ],
            [
                'name' => 'Taman Nasional Komodo',
                'description' => 'Rumah bagi komodo, kadal terbesar di dunia.',
                'waktu_operasional' => '8:00 - 17:00',
                'lokasi' => 'Nusa Tenggara Timur',
                'aksesibilitas' => 4.2,
                'kondisi_alam' => 5.0,
                'budaya' => 4.5,
                'infrastruktur' => 3.5,
                'jarak_terdekat' => 30.0,
                'keamanan' => 4.8,
                'biaya' => 150000,
            ],
            [
                'name' => 'Danau Toba',
                'description' => 'Danau vulkanik terbesar di dunia yang terletak di Sumatera.',
                'waktu_operasional' => '24 Jam',
                'lokasi' => 'Sumatera Utara',
                'aksesibilitas' => 4.0,
                'kondisi_alam' => 4.9,
                'budaya' => 4.3,
                'infrastruktur' => 4.0,
                'jarak_terdekat' => 15.0,
                'keamanan' => 4.6,
                'biaya' => 20000,
            ],
            [
                'name' => 'Pulau Komodo',
                'description' => 'Destinasi terkenal dengan keindahan alam dan hewan purba.',
                'waktu_operasional' => '8:00 - 17:00',
                'lokasi' => 'Nusa Tenggara Timur',
                'aksesibilitas' => 3.8,
                'kondisi_alam' => 4.7,
                'budaya' => 4.0,
                'infrastruktur' => 3.9,
                'jarak_terdekat' => 25.0,
                'keamanan' => 4.7,
                'biaya' => 100000,
            ],
            [
                'name' => 'Air Terjun Tumpak Sewa',
                'description' => 'Air terjun yang menakjubkan dengan pemandangan yang indah.',
                'waktu_operasional' => '24 Jam',
                'lokasi' => 'Jawa Timur',
                'aksesibilitas' => 3.5,
                'kondisi_alam' => 4.8,
                'budaya' => 4.1,
                'infrastruktur' => 3.5,
                'jarak_terdekat' => 12.0,
                'keamanan' => 4.4,
                'biaya' => 0,
            ],
        ]);
    }
}