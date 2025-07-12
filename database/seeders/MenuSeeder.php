<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample food items
        $makanan = [
            [
                'nama' => 'Nasi Goreng',
                'harga' => 15000,
                'deskripsi' => 'Nasi goreng dengan telur, ayam, dan sayuran segar',
                'kategori' => 'makanan',
                'gambar' => 'nasi-goreng.jpg',
                'status' => true
            ],
            [
                'nama' => 'Mie Goreng',
                'harga' => 12000,
                'deskripsi' => 'Mie goreng dengan bumbu special dan telur',
                'kategori' => 'makanan',
                'gambar' => 'mie-goreng.jpg',
                'status' => true
            ],
            [
                'nama' => 'Ayam Goreng',
                'harga' => 18000,
                'deskripsi' => 'Ayam goreng crispy dengan sambal terasi',
                'kategori' => 'makanan',
                'gambar' => 'ayam-goreng.jpg',
                'status' => true
            ],
            [
                'nama' => 'Soto Ayam',
                'harga' => 20000,
                'deskripsi' => 'Soto ayam dengan kuah kaldu yang gurih',
                'kategori' => 'makanan',
                'gambar' => 'soto-ayam.jpg',
                'status' => true
            ],
            [
                'nama' => 'Gado-gado',
                'harga' => 14000,
                'deskripsi' => 'Sayuran segar dengan bumbu kacang yang lezat',
                'kategori' => 'makanan',
                'gambar' => 'gado-gado.jpg',
                'status' => true
            ]
        ];

        // Sample drink items
        $minuman = [
            [
                'nama' => 'Es Teh Manis',
                'harga' => 3000,
                'deskripsi' => 'Teh manis dingin yang menyegarkan',
                'kategori' => 'minuman',
                'gambar' => 'es-teh.jpg',
                'status' => true
            ],
            [
                'nama' => 'Es Jeruk',
                'harga' => 5000,
                'deskripsi' => 'Jeruk segar dengan es batu',
                'kategori' => 'minuman',
                'gambar' => 'es-jeruk.jpg',
                'status' => true
            ],
            [
                'nama' => 'Kopi Hitam',
                'harga' => 8000,
                'deskripsi' => 'Kopi hitam pahit yang nikmat',
                'kategori' => 'minuman',
                'gambar' => 'kopi-hitam.jpg',
                'status' => true
            ],
            [
                'nama' => 'Es Kopi Susu',
                'harga' => 12000,
                'deskripsi' => 'Kopi dengan susu dan gula aren',
                'kategori' => 'minuman',
                'gambar' => 'es-kopi-susu.jpg',
                'status' => true
            ],
            [
                'nama' => 'Jus Alpukat',
                'harga' => 15000,
                'deskripsi' => 'Jus alpukat segar dengan susu',
                'kategori' => 'minuman',
                'gambar' => 'jus-alpukat.jpg',
                'status' => true
            ]
        ];

        // Insert all menu items
        foreach (array_merge($makanan, $minuman) as $menu) {
            Menu::create($menu);
        }
    }
} 