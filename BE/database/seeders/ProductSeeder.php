<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Product_categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name'=>'Quần ống xuông',
            'quantity'=>100,
           'image'=>'a',
            'sold'=>10,
            'price'=>150000,
            'description'=>'Ngon bổ rẻ'
        ]);
        Product::create([
            'name'=>'Áo thun',
            'quantity'=>100,
           'image'=>'a',
            'sold'=>10,
            'price'=>150000,
            'description'=>'Ngon bổ rẻ'
        ]);
        Product::create([
            'name'=>'Balo unisex',
            'quantity'=>100,
           'image'=>'a',
            'sold'=>10,
            'price'=>150000,
            'description'=>'Ngon bổ rẻ'
        ]);
        Product::create([
            'name'=>'Giày Jordan',
            'quantity'=>100,
           'image'=>'a',
            'sold'=>10,
            'price'=>150000,
            'description'=>'Ngon bổ rẻ'
        ]);

        Product_categories::create([
            'product_id'=>'1',
            'category_id'=>'1',
        ]);
        Product_categories::create([
            'product_id'=>'2',
            'category_id'=>'2',
        ]);
        Product_categories::create([
            'product_id'=>'3',
            'category_id'=>'3',
        ]);
        Product_categories::create([
            'product_id'=>'4',
            'category_id'=>'4',
        ]);
    }
}
