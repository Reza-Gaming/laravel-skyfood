<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::insert([
            [
                'nama' => 'Makanan Utama',
                'deskripsi' => 'Menu utama seperti nasi, mie, lauk, dll',
                'icon' => 'fas fa-hamburger'
            ],
            [
                'nama' => 'Minuman',
                'deskripsi' => 'Aneka minuman segar dan hangat',
                'icon' => 'fas fa-coffee'
            ],
            [
                'nama' => 'Dessert',
                'deskripsi' => 'Makanan penutup manis',
                'icon' => 'fas fa-ice-cream'
            ],
            [
                'nama' => 'Snack',
                'deskripsi' => 'Cemilan dan makanan ringan',
                'icon' => 'fas fa-pizza-slice'
            ],
        ]);
    }
} 