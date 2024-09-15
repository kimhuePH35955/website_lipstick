<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name'=>'Quần',
           
        ]);
        Category::create([
            'name'=>'Áo',
            
        ]);
        Category::create([
            'name'=>'Balo',
            
        ]);
        Category::create([
            'name'=>'Giày',
            
        ]);
    }
}
