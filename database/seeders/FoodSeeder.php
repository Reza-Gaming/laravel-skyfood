<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Food;
use App\Models\Category;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            'Makanan Utama' => Category::where('nama', 'Makanan Utama')->first()->id ?? 1,
            'Minuman' => Category::where('nama', 'Minuman')->first()->id ?? 2,
            'Dessert' => Category::where('nama', 'Dessert')->first()->id ?? 3,
            'Snack' => Category::where('nama', 'Snack')->first()->id ?? 4,
        ];
        Food::insert([
            [
                'nama' => 'Nasi Goreng Spesial',
                'deskripsi' => 'Nasi goreng dengan telur, ayam, udang, dan sayuran segar.',
                'harga' => 25000,
                'gambar' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=400&h=300&fit=crop',
                'category_id' => $kategori['Makanan Utama']
            ],
            [
                'nama' => 'Ayam Geprek Pedas',
                'deskripsi' => 'Ayam geprek dengan sambal bawang pedas dan lalapan segar.',
                'harga' => 22000,
                'gambar' => 'https://images.unsplash.com/photo-1604503468506-a8da13d82791?w=400&h=300&fit=crop',
                'category_id' => $kategori['Makanan Utama']
            ],
            [
                'nama' => 'Mie Ayam Bakso',
                'deskripsi' => 'Mie ayam dengan bakso sapi, pangsit, dan topping melimpah.',
                'harga' => 18000,
                'gambar' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=400&h=300&fit=crop',
                'category_id' => $kategori['Makanan Utama']
            ],
            [
                'nama' => 'Sate Ayam Madura',
                'deskripsi' => 'Sate ayam dengan bumbu kacang khas Madura dan lontong.',
                'harga' => 28000,
                'gambar' => 'https://images.unsplash.com/photo-1551504734-5ee1c4a1479b?w=400&h=300&fit=crop',
                'category_id' => $kategori['Makanan Utama']
            ],
            [
                'nama' => 'Gado-gado',
                'deskripsi' => 'Sayuran segar dengan bumbu kacang dan telur rebus.',
                'harga' => 20000,
                'gambar' => 'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=400&h=300&fit=crop',
                'category_id' => $kategori['Makanan Utama']
            ],
            [
                'nama' => 'Es Teh Manis',
                'deskripsi' => 'Es teh manis segar dengan gula aren.',
                'harga' => 5000,
                'gambar' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=400&h=300&fit=crop',
                'category_id' => $kategori['Minuman']
            ],
            [
                'nama' => 'Es Jeruk',
                'deskripsi' => 'Es jeruk peras segar dengan madu.',
                'harga' => 8000,
                'gambar' => 'https://images.unsplash.com/photo-1621506289937-a8e4df240d0b?w=400&h=300&fit=crop',
                'category_id' => $kategori['Minuman']
            ],
            [
                'nama' => 'Kopi Hitam',
                'deskripsi' => 'Kopi hitam premium dengan biji pilihan.',
                'harga' => 12000,
                'gambar' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=400&h=300&fit=crop',
                'category_id' => $kategori['Minuman']
            ],
            [
                'nama' => 'Rendang Sapi',
                'deskripsi' => 'Rendang sapi dengan bumbu rempah khas Padang yang meresap.',
                'harga' => 35000,
                'gambar' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=400&h=300&fit=crop',
                'category_id' => $kategori['Makanan Utama']
            ],
            [
                'nama' => 'Soto Ayam',
                'deskripsi' => 'Soto ayam dengan kuah kaldu yang gurih dan pelengkap lengkap.',
                'harga' => 25000,
                'gambar' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=400&h=300&fit=crop',
                'category_id' => $kategori['Makanan Utama']
            ],
            [
                'nama' => 'Bakso Sapi',
                'deskripsi' => 'Bakso sapi dengan kuah kaldu sapi yang nikmat.',
                'harga' => 20000,
                'gambar' => 'https://images.unsplash.com/photo-1569718212165-3a8278d5f624?w=400&h=300&fit=crop',
                'category_id' => $kategori['Makanan Utama']
            ],
            [
                'nama' => 'Es Cendol',
                'deskripsi' => 'Es cendol dengan santan dan gula merah yang manis.',
                'harga' => 8000,
                'gambar' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?w=400&h=300&fit=crop',
                'category_id' => $kategori['Dessert']
            ],
        ]);
    }
}
