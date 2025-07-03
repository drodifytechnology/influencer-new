<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = array(
            array('id' => '5','name' => 'Client','role' => 'user','email' => 'client@client.com','phone' => '01737878780','country' => 'USA','image' => NULL,'is_setupped' => '1','status' => 'pending','address' => 'Texas','bio' => 'Test the client bio','balance' => '1000','reason' => NULL,'lang_expertise' => '[{"lavel":"Expert","name":"Bangla"},{"name":"English","lavel":"Intermidiet"}]','socials' => '{"facebook":"facebook.com","instagram":"instagram.com"}','password' => '$2y$10$HQMEnxdtPcluuDCeRNF0velekxOMwCTQJGPZxTqKjKNAXq76LUL1K','email_verified_at' => '2024-05-25 21:32:13','remember_token' => NULL,'created_at' => '2024-05-25 21:32:13','updated_at' => '2024-05-26 18:27:29'),
            array('id' => '6','name' => 'R Kobir','role' => 'user','email' => 'rkobir511@gmial.com','phone' => NULL,'country' => NULL,'image' => NULL,'is_setupped' => '0','status' => 'pending','address' => NULL,'bio' => NULL,'balance' => '0','reason' => NULL,'lang_expertise' => NULL,'socials' => NULL,'password' => '$2y$10$h6g7CaVUV1j8q9X5EV/sZO1xNUvl1xGTxe3vFduq8aOHU5Kph09hO','email_verified_at' => '2024-06-05 22:39:37','remember_token' => '773121','created_at' => '2024-06-05 22:37:37','updated_at' => '2024-06-05 22:37:37'),
            array('id' => '8','name' => 'R Kobir','role' => 'user','email' => 'rkobir511@gmail.com','phone' => '01631865339','country' => 'Bangladesh','image' => NULL,'is_setupped' => '1','status' => 'pending','address' => 'Address','bio' => 'this is my.....','balance' => '0','reason' => NULL,'lang_expertise' => '[{"lavel":"Fluent","name":"Bangla"}]','socials' => '{"facebook":null,"instagram":null,"twitter":null,"youtube":null,"linkedin":null,"tiktok":null}','password' => '$2y$10$HnLR6CffiVNEKC2Okx7rUeHO/QxmAQt4BL2QriUh3ywqwXAIg3d12','email_verified_at' => '2024-06-05 22:40:23','remember_token' => NULL,'created_at' => '2024-06-05 22:39:52','updated_at' => '2024-06-05 22:42:29'),
            array('id' => '12','name' => 'Hasan😎','role' => 'influencer','email' => 'alif6512@gmail.com','phone' => '12345678901','country' => 'Bangladesh','image' => 'uploads/24/06/1717904873-243.jpg','is_setupped' => '1','status' => 'pending','address' => 'dhaka,bd','bio' => 'This is my bio','balance' => '0','reason' => NULL,'lang_expertise' => '[{"lavel":"Basic","name":"bengali"}]','socials' => '{"facebook":null,"instagram":"https:\\/\\/www.instagram.com\\/hasan.aliif?igsh=MXR1cmEyYzM1MzAzYw==","twitter":null,"youtube":null,"linkedin":"https\\/\\/:instagram.com\\/hasan_aliif","tiktok":null}','password' => bcrypt(123456),'email_verified_at' => '2024-06-09 15:42:24','remember_token' => NULL,'created_at' => '2024-06-09 15:42:03','updated_at' => '2024-06-09 16:22:28'),
            array('id' => '13','name' => 'Lucifer','role' => 'user','email' => 'haxan.alif@gmail.com','phone' => '12345679900','country' => 'Bangladesh','image' => 'uploads/24/06/1717905619-675.jpg','is_setupped' => '1','status' => 'pending','address' => 'uttara,dhaka','bio' => 'This is my bio','balance' => '0','reason' => NULL,'lang_expertise' => '[{"lavel":"Basic","name":"bangla"}]','socials' => '{"facebook":null,"instagram":null,"twitter":null,"youtube":null,"linkedin":null,"tiktok":null}','password' => '$2y$10$6LJImpu1vwfqEckogHsf0OxYEWqqZiPvKCu52Ixx.36mDdF9f.B0i','email_verified_at' => '2024-06-09 15:59:22','remember_token' => NULL,'created_at' => '2024-06-09 15:59:02','updated_at' => '2024-06-09 16:00:19'),
            array('id' => '14','name' => 'Waka','role' => 'influencer','email' => 'wekew25356@morxin.com','phone' => '01631876366','country' => 'Bangladesh','image' => 'uploads/24/06/1717907633-899.jpg','is_setupped' => '1','status' => 'pending','address' => 'Addresss','bio' => 'bio','balance' => '0','reason' => NULL,'lang_expertise' => '[{"lavel":"Conversational","name":"Bangla"}]','socials' => '{"facebook":null,"instagram":null,"twitter":null,"youtube":null,"linkedin":null,"tiktok":null}','password' => '$2y$10$cz1T5V5uZsf5sgUXfq.QYu0Gf5L6S.N5D7wxEG6I.YzzZLBQnd.cq','email_verified_at' => '2024-06-09 16:32:46','remember_token' => NULL,'created_at' => '2024-06-09 16:32:21','updated_at' => '2024-06-09 16:33:53')
        );

        User::insert($users);
    }
}
