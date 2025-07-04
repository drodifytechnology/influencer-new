<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = array(
            array('id' => '3','title' => 'Service 1','user_id' => '12','category_id' => '3','price' => '45','discount_type' => 'percentage','discount' => '2','duration' => '10 Days','status' => 'active','description' => 'This is a descripsion of service 1','reason' => NULL,'images' => '["uploads\\/24\\/06\\/1717905029_6665268598b8f.jpg","uploads\\/24\\/06\\/1717905029_666526859a29f.png","uploads\\/24\\/06\\/1717905029_666526859d325.jpg"]','features' => '["This is the feature no 1","Feature number 2"]','created_at' => '2024-06-09 15:50:29','updated_at' => '2024-06-09 15:50:29'),
            array('id' => '4','title' => 'Digital Marketting campeign','user_id' => '12','category_id' => '3','price' => '99','discount_type' => 'percentage','discount' => '2','duration' => '7 Days','status' => 'active','description' => 'this a facebook marketting campeign.','reason' => NULL,'images' => '["uploads\\/24\\/06\\/1717905178_6665271a073bc.jpg"]','features' => '["Feature 1","feature two","feature three"]','created_at' => '2024-06-09 15:52:58','updated_at' => '2024-06-09 15:52:58'),
            array('id' => '5','title' => 'Instagram Marketting','user_id' => '12','category_id' => '3','price' => '95','discount_type' => 'percentage','discount' => '5','duration' => '20 Days','status' => 'active','description' => 'this is instagram marketting campeign.','reason' => NULL,'images' => NULL,'features' => '["this is feature one","this  is feature two"]','created_at' => '2024-06-09 15:53:57','updated_at' => '2024-06-09 15:53:57'),
            array('id' => '6','title' => 'twitter marketting','user_id' => '12','category_id' => '2','price' => '96','discount_type' => 'percentage','discount' => '2','duration' => '20 Days','status' => 'active','description' => 'this is twitter marketting.','reason' => NULL,'images' => NULL,'features' => '["1","2"]','created_at' => '2024-06-09 15:54:43','updated_at' => '2024-06-09 15:54:43'),
            array('id' => '7','title' => 'social media marketting','user_id' => '12','category_id' => '2','price' => '99','discount_type' => 'percentage','discount' => '2','duration' => '7 Days','status' => 'active','description' => 'all social media marketting for your business.','reason' => NULL,'images' => '["uploads\\/24\\/06\\/1717905385_666527e9e8e94.jpg"]','features' => '["7 days campeign","with cheap cost","trusfull consultant."]','created_at' => '2024-06-09 15:56:25','updated_at' => '2024-06-09 15:56:25')
        );  

        Service::insert($services);
    }
}
