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

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => bcrypt('password'),
                'role' => 'merchant',
            ]
        );

        $products = [
            [
                'name' => 'Physical Payoneer Master Card',
                'description' => "দ্রুত অ্যাক্টিভেশন\r\nঅনলাইন শপিং ও সাবস্ক্রিপশন\r\nনিরাপদ card details",
                'price' => 1952.00,
                'currency' => 'BDT',
                'delivery_time' => '৩০–৪৫ মিনিট',
                'features' => "Payoneer MasterCard - বিশ্বব্যাপী আপনার অর্থের সহজ সমাধান\r\n\r\nPayoneer MasterCard হলো একটি আন্তর্জাতিক প্রিপেইড মাস্টারকার্ড যা দিয়ে আপনি বিশ্বের যেকোনো প্রান্ত থেকে আপনার Payoneer ব্যালেন্স ব্যবহার করতে পারবেন ফ্রিল্যান্সার উদ্যোক্তা এবং অনলাইন ব্যবসার জন্য এটি সবচেয়ে জনপ্রিয় ও নিরাপদ সমাধান।\r\n\r\nPayoneer MasterCard এর প্রধান সুবিধাসমূহ:\r\n\r\n১. বিশ্বব্যাপী ব্যবহারযোগ্য\r\nবিশ্বের ২০০+ দেশে যেখানে MasterCard সাপোর্ট করে সেখানেই ATM থেকে টাকা উত্তোলন এবং অনলাইন ও অফলাইন শপিং করতে পারবেন\r\n\r\n২. দ্রুত ও নিরাপদ লেনদেন\r\nআপনার মার্কেটপ্লেস বা ক্লায়েন্টের পাঠানো টাকা কার্ডে আসা মাত্রই ব্যবহার করতে পারবেন সম্পূর্ণ নিরাপদভাবে\r\n\r\n৩. ২৪/৭ অনলাইন এক্সেস\r\nPayoneer অ্যাপ বা ওয়েবসাইট থেকে যে কোনো সময় ব্যালেন্স চেক লেনদেন হিস্ট্রি ও কার্ড ম্যানেজ করতে পারবেন\r\n\r\n৪. সহজ ব্যাংক উইথড্র\r\nকার্ডের পাশাপাশি সরাসরি আপনার লোকাল ব্যাংক অ্যাকাউন্টেও টাকা ট্রান্সফার করতে পারবেন।\r\n\r\n৫. অনলাইন শপিং ও বিল পেমেন্ট\r\nFacebook Ads, Google Amazon Domain-Hosting সহ সকল ইন্টারন্যাশনাল পেমেন্টে ব্যবহারযোগ্য\r\n\r\n৬. বিশ্বস্ত ও নির্ভরযোগ্য\r\nPayoneer একটি বিশ্বব্যাপী স্বীকৃত ও লাইসেন্সপ্রাপ্ত প্রতিষ্ঠান তাই আপনার অর্থ ১০০% নিরাপদ",
                'image' => '1789022443_6aa250ebe1510.jpg',
                'status' => 'active',
                'sort_order' => 150,
            ],
            [
                'name' => 'PayPal Payment Card',
                'description' => 'PayPal payment ও অনলাইন কেনাকাটার জন্য সহজ ভার্চুয়াল কার্ড প্যাকেজ',
                'price' => 1400.00,
                'currency' => 'BDT',
                'delivery_time' => '১০–২০ মিনিট',
                'features' => "PayPal Extras MasterCard - সাথে $10 ডলার এড \r\n\r\nআন্তর্জাতিক পেমেন্ট এখন আরও সহজ আপনার বিজনেস ফ্রিল্যান্সিং ও অনলাইন কেনাকাটার জন্য সবচেয়ে নিরাপদ সমাধান\r\n\r\n✓ PayPal Payment Support\r\n✓ সকল E-commerce সাইটে Checkout\r\n✓ ২৪/৭ কাস্টমার সাপোর্ট\r\n\r\nস্টক সীমিত অফারটি নিতে নিচের অর্ডার নাও বাটনে ক্লিক করুন 👇",
                'image' => '1788778370_6a9e9782b9d2e.jpg',
                'status' => 'active',
                'sort_order' => 153,
            ],
            [
                'name' => 'RedotPay Virtual Card',
                'description' => 'ডিজিটাল asset ও অনলাইন সার্ভিসের পেমেন্টের জন্য দ্রুত virtual card।',
                'price' => 1500.00,
                'currency' => 'BDT',
                'delivery_time' => '৫–১০ মিনিট',
                'features' => "দ্রুত delivery\r\nOnline subscription\r\nসাপোর্ট assistance \r\n\r\nকার্ডে ১০ ডলার এড থাকবে",
                'image' => '1788777271_6a9e9337322e9.jpg',
                'status' => 'active',
                'sort_order' => 136,
            ],
            [
                'name' => 'Payoneer Virtual Card',
                'description' => 'দ্রুত অ্যাক্টিভেশন\r\nঅনলাইন শপিং ও সাবস্ক্রিপশন\r\nনিরাপদ card details',
                'price' => 1220.00,
                'currency' => 'BDT',
                'delivery_time' => '৫–১৫ মিনিট',
                'features' => "> 💳 Payoneer Virtual Card - What You Can Do With This Card\r\n> Use your Payoneer card to pay for:\r\n> 🛒 Marketplaces, Amazon, Alibaba\r\n> ⭐ Facebook Stars, Page Boost\r\n> 🚀 YouTube Promotion, TikTok\r\n> 💼 Upwork, Fiverr, Google Domains\r\n>\r\n> 🎁 NEW USER BONUS $10\r\n> ⚠️ Stock Limited - স্টক খুবই সীমিত\r\n> 👥 Especially useful for freelancers and expatriates\r\n>\r\n> 👉 আর দেরি না করে এখনি এই কার্ডটি অর্ডার করুন - লিখা বাটনে ক্লিক করুন 📩",
                'image' => '1789613384_6aab55480afe2.jpg',
                'status' => 'active',
                'sort_order' => 2,
            ],
            [
                'name' => 'RedotPay Visa Virtual Card',
                'description' => 'ডিজিটাল asset ও অনলাইন সার্ভিসের পেমেন্টের জন্য দ্রুত অর্ডার করুন virtual card।',
                'price' => 1450.00,
                'currency' => 'BDT',
                'delivery_time' => '৫–১৫ মিনিট',
                'features' => "RedotPay VISA Gradient - 1,450 BDT [VIRAL]\r\n💳 RedotPay VISA - Pink Purple Gradient [TRENDING NOW]\r\nএখন সবচেয়ে বেশি ট্রেন্ডিং ও ভাইরাল কার্ড! Instagram, Facebook এ সবাই এই কার্ড খুঁজছে।\r\n✔️ Beautiful Pink-Orange-Blue Gradient - দেখলেই প্রেমে পড়বেন\r\n✔️ Contactless + Chip - ট্যাপ করে পেমেন্ট\r\n✔️ Crypto to Card Instant Top-up\r\n✔️ Viral Design - হাতে নিলে প্রিমিয়াম লাগে\r\n🔥 Trending Price 1,450 BDT + $10 Bonus",
                'image' => '1788777531_6a9e943b2eb2e.jpg',
                'status' => 'active',
                'sort_order' => 0,
            ],
            [
                'name' => 'Visa MasterCard',
                'description' => 'ডিজিটাল asset ও অনলাইন সার্ভিসের পেমেন্টের জন্য দ্রুত অর্ডার করুন Visa Virtual MasterCard',
                'price' => 1500.00,
                'currency' => 'BDT',
                'delivery_time' => '১০–২০ মিনিট',
                'features' => "> VISA Card -\r\n> প্রিমিয়াম ব্ল্যাক ডিজাইন, সব জায়গায় গ্রহণযোগ্য!\r\n>\r\n> Price: 1,500 BDT Only\r\n> Bonus: $10 Instant Bonus - প্রথম লোডেই $10 ফ্রি!\r\n>\r\n> Features: Contactless Payment, Worldwide Accepted\r\n> Stock Limited! Order Now বাটনে ক্লিক করুন",
                'image' => '1788778202_6a9e96dacc61b.jpg',
                'status' => 'active',
                'sort_order' => 0,
            ],
            [
                'name' => 'Binance MasterCard',
                'description' => "BINANCE x Mastercard - 2,900 BDT\r\n\r\n> 💳 BINANCE Black Gold - ছেলেদের জন্য\r\n> Black Gold Premium Design, Binance থেকে সরাসরি পেমেন্ট।\r\n> Price: 2,900 BDT + $20 Bonus",
                'price' => 2900.00,
                'currency' => 'BDT',
                'delivery_time' => '১০–২০ মিনিট',
                'features' => "Ads & Marketing (সবচেয়ে বেশি চলে)\r\n✔️ Facebook Ads / Boost\r\n✔️ Google Ads / YouTube Ads\r\n✔️ TikTok Ads\r\n✔️ LinkedIn Ads\r\n\r\n🎬 ২. Subscription (প্রতি মাসে পেমেন্ট)\r\n✔️ Netflix, Amazon Prime\r\n✔️ YouTube Premium, Spotify\r\n✔️ ChatGPT Plus, Canva Pro, Adobe\r\n✔️ Apple iCloud, Google Drive\r\n\r\n🛒 ৩. Online Shopping\r\n✔️ Amazon, AliExpress, eBay, Etsy\r\n✔️ Daraz International\r\n✔️ যেকোনো ইন্টারন্যাশনাল ওয়েবসাইট\r\n\r\n🌐 ৪. Freelancing & Business\r\n✔️ Domain কেনা (Namecheap, GoDaddy)\r\n✔️ Hosting কেনা (Hostinger, Bluehost)\r\n✔️ Theme, Plugin কেনা\r\n✔️ PayPal, Skrill এ ডলার এড (মাধ্যমে)\r\n\r\n💸 ৫. ATM & Travel\r\n✔️ দেশের বাইরে গেলে ATM থেকে টাকা তোলা\r\n✔️ POS মেশিনে পেমেন্ট (দেশের বাইরে)\r\n✔️ Hotel, Flight Booking\r\n\r\n💰 ৬. Crypto Top-up\r\n✔️ Binance, Bybit, RedotPay থেকে সরাসরি লোড\r\n✔️ Crypto to Fiat Instant\r\n\r\n---\r\n\r\nওয়েবসাইটের জন্য শর্ট ক্যাপশন:\r\n\r\n> ✅ এই কার্ড দিয়ে কি করবেন?\r\n> Facebook Boost, Google Ads, Netflix, YouTube Premium, Spotify, ChatGPT Plus, Canva, Domain-Hosting, Amazon Shopping, Flight Booking - সব ইন্টারন্যাশনাল পেমেন্ট 100% হবে। সাথে ATM থেকে টাকা তোলা যাবে।",
                'image' => '1788778977_6a9e99e106245.jpg',
                'status' => 'active',
                'sort_order' => 226,
            ],
            [
                'name' => 'Apple Gift Card',
                'description' => "☞> Apple Gift Card Price:\r\n- $15 = 1,900 BDT\r\n- $25 = 3,100 BDT\r\n- $50 = 6,000 BDT\r\n- $100 = 11,500 BDT\r\n\r\n> 🎁 এই কার্ডটি অর্ডার করলে সাথে $10 Bonus + Free Virtual Card",
                'price' => 1900.00,
                'currency' => 'BDT',
                'delivery_time' => '৫–১৫ মিনিট',
                'features' => "> iTunes Gift Cards $15 - $100 Available - Card Shop Worldwide\r\n> 💳 USA Original 100% Genuine Code\r\n> Apps, Games, Music, Movies, TV Shows, Books and More\r\n> \r\n> ✔️ Apple Music, iCloud+, Apple Arcade, Apple TV+\r\n> ✔️ Game Top-up - Free Fire, PUBG, Roblox\r\n> ✔️ Instant Delivery 5 মিনিটে\r\n> ✔️ No Expiry Date\r\n> 💰 $15 - $100 Available + $10 Bonus\r\n> 👉 Order Now",
                'image' => '1788779824_6a9e9d30a77b7.jpg',
                'status' => 'active',
                'sort_order' => 0,
            ],
            [
                'name' => 'Wise MasterCard',
                'description' => 'ডিজিটাল Asset ও অনলাইন সার্ভিসের পেমেন্টের জন্য দ্রুত অর্ডার করুন Wise Virtual MasterCard',
                'price' => 2500.00,
                'currency' => 'BDT',
                'delivery_time' => '১০–২০ মিনিট',
                'features' => "> ডিজিটাল Asset ও অনলাইন সার্ভিসের পেমেন্টের জন্য দ্রুত অর্ডার করুন Wise MasterCard 💚\r\n>\r\n> 💳 Price: (Physical Card 2,500 BDT) Virtual Card 1,200 BDT Only\r\n> ⚡ 5 মিনিটে ডেলিভারি\r\n>\r\n> ✅ Facebook Ads, Google Ads, TikTok Ads\r\n> ✅ ChatGPT Plus, Canva Pro, Adobe, Notion\r\n> ✅ Domain-Hosting, VPS, Theme License\r\n> ✅ Netflix, YouTube Premium, Spotify\r\n> ✅ সকল ডিজিটাল Asset কেনা যাবে\r\n>\r\n> 🔒 Secure | Fast | Instant Active\r\n>\r\n> 👉 Order Now - Card Shop Worldwide\r\n\r\nএই কার্ডটি অর্ডার করলে সাথে $15 Bonus + Free Virtual Card",
                'image' => '1788780707_6a9ea0a3aa72e.jpg',
                'status' => 'active',
                'sort_order' => 0,
            ],
            [
                'name' => 'all card dollar service available 24/7 🌐',
                'description' => 'এখনই দ্রুত অর্ডার করুন আমাদের কাছ থেকে এভেলেবেল যেকোনো সময় সার্ভিস পাবেন ইনশাল্লাহ',
                'price' => 122.75,
                'currency' => 'BDT',
                'delivery_time' => '৫–১০ মিনিট',
                'features' => "🌍 যেকোনো ডলার কার্ড এভেলেবেল - 24/7 Service 💳\r\n\r\n🇧🇩 বাংলাদেশ বাজারের সেরা রেটে সকল কার্ড রেডি স্টকে!\r\n\r\n💵 আজকের কার্ড ডলার রেট (আপডেট):\r\n\r\n1️⃣ Wise Card Dollar Price - 122.50 BDT\r\n2️⃣ RedotPay Card Dollar Price - 123.00 BDT\r\n3️⃣ Payoneer Card Dollar Price - 123.50 BDT\r\n4️⃣ PayPal Card Dollar Price - 124.00 BDT\r\n5️⃣ Skrill / Neteller Dollar Price - 123.00 BDT\r\n6️⃣ Perfect Money Dollar Price - 122.00 BDT\r\n\r\n✨ আমাদের বৈশিষ্ট্য:\r\n✅ 24 ঘন্টা সার্ভিস - যেকোনো সময় অর্ডার\r\n✅ 5-10 মিনিটে ইনস্ট্যান্ট কার্ড ডেলিভারি\r\n✅ সর্বনিম্ন 10$ থেকে শুরু\r\n✅ 100% Secure & Trusted\r\n✅ বিকাশ, নগদ, রকেট, ব্যাংক পেমেন্ট\r\n\r\n🎁 প্রতিটি কার্ডের সাথে $10 Bonus + Free Virtual Card!\r\n\r\n⚠️ বাজার দর পরিবর্তনশীল, দ্রুত অর্ডার করুন!\r\n\r\n👉 Order Now - Card Shop Worldwide",
                'image' => '1788782222_6a9ea68ed46b3.jpg',
                'status' => 'active',
                'sort_order' => 13659,
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
