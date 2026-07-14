<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\Contact;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // کاربر ادمین
        User::create([
            'name' => 'مدیر سیستم',
            'email' => 'admin@foodease.com',
            'password' => bcrypt('12345678'),
            'is_admin' => true,
        ]);

        // کاربر معمولی
        User::create([
            'name' => 'کاربر تست',
            'email' => 'user@foodease.com',
            'password' => bcrypt('12345678'),
            'is_admin' => false,
        ]);

        // محصولات
        $this->call(ProductSeeder::class);
    }
}