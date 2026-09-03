<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $products = [
            [
                'name' => 'Payoneer Virtual Card',
                'description' => 'অনলাইন পেমেন্ট ও আন্তর্জাতিক সার্ভিস ব্যবহারের জন্য ডেমো ভার্চুয়াল কার্ড।',
                'price' => 15,
                'currency' => 'BDT',
                'delivery_time' => '৫–১৫ মিনিট',
                'features' => "দ্রুত অ্যাক্টিভেশন\nঅনলাইন শপিং ও সাবস্ক্রিপশন\nনিরাপদ card details",
                'status' => 'active',
                'sort_order' => 1,
            ],
            [
                'name' => 'PayPal Payment Card',
                'description' => 'PayPal payment ও অনলাইন কেনাকাটার জন্য সহজ ডেমো কার্ড প্যাকেজ।',
                'price' => 18,
                'currency' => 'BDT',
                'delivery_time' => '১০–২০ মিনিট',
                'features' => "PayPal payment support\nE-commerce checkout\n২৪/৭ customer support",
                'status' => 'active',
                'sort_order' => 2,
            ],
            [
                'name' => 'Skrill Virtual Card',
                'description' => 'ডিজিটাল wallet ও international merchant payment-এর জন্য ভার্চুয়াল কার্ড।',
                'price' => 16,
                'currency' => 'BDT',
                'delivery_time' => '৫–১৫ মিনিট',
                'features' => "Wallet payment support\nসাবস্ক্রিপশন পেমেন্ট\nদ্রুত delivery",
                'status' => 'active',
                'sort_order' => 3,
            ],
            [
                'name' => 'Neteller Virtual Card',
                'description' => 'অনলাইন সার্ভিস, gaming ও digital merchant payment-এর জন্য card solution।',
                'price' => 17,
                'currency' => 'BDT',
                'delivery_time' => '১০–২০ মিনিট',
                'features' => "Digital wallet compatible\nGaming ও software payment\nঅর্ডার tracking",
                'status' => 'active',
                'sort_order' => 4,
            ],
            [
                'name' => 'Wise Virtual Card',
                'description' => 'আন্তর্জাতিক subscription ও online payment-এর জন্য premium virtual card।',
                'price' => 20,
                'currency' => 'BDT',
                'delivery_time' => '১৫–৩০ মিনিট',
                'features' => "International payment\nPremium support\nSecure checkout",
                'status' => 'active',
                'sort_order' => 5,
            ],
            [
                'name' => 'Paysera Virtual Card',
                'description' => 'ইউরোপিয়ান online service ও recurring payment-এর জন্য ডেমো কার্ড।',
                'price' => 19,
                'currency' => 'BDT',
                'delivery_time' => '১৫–৩০ মিনিট',
                'features' => "Recurring payment support\nOnline merchant use\nসহজ activation",
                'status' => 'active',
                'sort_order' => 6,
            ],
            [
                'name' => 'RedotPay Virtual Card',
                'description' => 'ডিজিটাল asset ও অনলাইন সার্ভিসের পেমেন্টের জন্য দ্রুত virtual card।',
                'price' => 14,
                'currency' => 'BDT',
                'delivery_time' => '৫–১০ মিনিট',
                'features' => "দ্রুত delivery\nOnline subscription\nসাপোর্ট assistance",
                'status' => 'active',
                'sort_order' => 7,
            ],
            [
                'name' => 'DollarXcard Premium',
                'description' => 'বেশি সুবিধা ও priority support সহ আমাদের premium virtual Mastercard package।',
                'price' => 25,
                'currency' => 'BDT',
                'delivery_time' => '৫–১৫ মিনিট',
                'features' => "Priority activation\nPremium customer support\nMultiple online payment use",
                'status' => 'active',
                'sort_order' => 8,
            ],
        ];

        foreach ($products as $product) {
            Product::updateOrCreate(
                ['name' => $product['name']],
                $product
            );
        }
    }
}
