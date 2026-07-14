<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'پیتزا مخصوص',
                'description' => 'پیتزا با پنیر تازه، قارچ، زیتون و سوسیس',
                'price' => 150000,
                'category' => 'pizza',
                'is_featured' => true,
                'rating' => 5,
                'likes' => 120,
                'image' => 'pizza.jpg',
            ],
            [
                'name' => 'پیتزا مارگاریتا',
                'description' => 'پیتزا ساده با پنیر موزارلا و ریحان',
                'price' => 120000,
                'category' => 'pizza',
                'is_featured' => false,
                'rating' => 4,
                'likes' => 85,
                'image' => 'pizza2.jpg',
            ],
            [
                'name' => 'کباب کوبیده',
                'description' => 'کباب کوبیده با برنج زعفرانی و گوجه کبابی',
                'price' => 180000,
                'category' => 'kebab',
                'is_featured' => true,
                'rating' => 5,
                'likes' => 200,
                'image' => 'kebab.jpg',
            ],
            [
                'name' => 'کباب برگ',
                'description' => 'کباب برگ با برنج و سبزیجات تازه',
                'price' => 220000,
                'category' => 'kebab',
                'is_featured' => false,
                'rating' => 4,
                'likes' => 95,
                'image' => 'kebab2.jpg',
            ],
            [
                'name' => 'سالاد سزار',
                'description' => 'سالاد سزار با مرغ کبابی و سس مخصوص',
                'price' => 85000,
                'category' => 'salad',
                'is_featured' => false,
                'rating' => 4,
                'likes' => 65,
                'image' => 'salad.jpg',
            ],
            [
                'name' => 'سالاد فصل',
                'description' => 'سالاد با سبزیجات تازه فصل و سس بالزامیک',
                'price' => 65000,
                'category' => 'salad',
                'is_featured' => false,
                'rating' => 3,
                'likes' => 40,
                'image' => 'salad2.jpg',
            ],
            [
                'name' => 'پاستا آلفردو',
                'description' => 'پاستا با سس آلفردو و مرغ',
                'price' => 135000,
                'category' => 'pasta',
                'is_featured' => true,
                'rating' => 4,
                'likes' => 110,
                'image' => 'pasta.jpg',
            ],
            [
                'name' => 'پاستا پستو',
                'description' => 'پاستا با سس پستو و ریحان تازه',
                'price' => 125000,
                'category' => 'pasta',
                'is_featured' => false,
                'rating' => 4,
                'likes' => 78,
                'image' => 'pasta2.jpg',
            ],
            [
                'name' => 'برگر مخصوص',
                'description' => 'برگر با گوشت تازه، پنیر چدار و سبزیجات',
                'price' => 110000,
                'category' => 'burger',
                'is_featured' => true,
                'rating' => 5,
                'likes' => 150,
                'image' => 'burger.jpg',
            ],
            [
                'name' => 'برگر دابل',
                'description' => 'برگر دو طبقه با پنیر و سس مخصوص',
                'price' => 140000,
                'category' => 'burger',
                'is_featured' => false,
                'rating' => 4,
                'likes' => 90,
                'image' => 'burger2.jpg',
            ],
            [
                'name' => 'سوشی کالیفرنیا',
                'description' => 'سوشی با خرچنگ، آووکادو و خیار',
                'price' => 160000,
                'category' => 'sushi',
                'is_featured' => false,
                'rating' => 4,
                'likes' => 70,
                'image' => 'sushi.jpg',
            ],
            [
                'name' => 'سوشی میوه‌ای',
                'description' => 'سوشی با میوه‌های تازه و سس مخصوص',
                'price' => 145000,
                'category' => 'sushi',
                'is_featured' => false,
                'rating' => 3,
                'likes' => 45,
                'image' => 'sushi2.jpg',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}