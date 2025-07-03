<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = array(
            array('id' => '1','user_id' => '13','service_id' => '7','influencer_id' => '12','gateway_id' => NULL,'status' => 'awaiting','payment_status' => 'unpaid','amount' => '99','charge' => '50','discount_amount' => '10','total_amount' => '100','start_date' => '2024-06-09','end_date' => '2024-12-15','start_time' => '10:15:00','end_time' => '11:20:00','file' => NULL,'reason' => NULL,'description' => 'test order','created_at' => '2024-06-09 16:37:43','updated_at' => '2024-06-09 16:37:43'),
            array('id' => '2','user_id' => '13','service_id' => '6','influencer_id' => '12','gateway_id' => NULL,'status' => 'awaiting','payment_status' => 'unpaid','amount' => '99','charge' => '50','discount_amount' => '10','total_amount' => '100','start_date' => '2024-06-09','end_date' => '2024-12-15','start_time' => '10:15:00','end_time' => '11:20:00','file' => NULL,'reason' => NULL,'description' => 'test order','created_at' => '2024-06-09 16:42:00','updated_at' => '2024-06-09 16:42:00'),
            array('id' => '4','user_id' => '13','service_id' => '6','influencer_id' => '12','gateway_id' => NULL,'status' => 'awaiting','payment_status' => 'unpaid','amount' => '99','charge' => '50','discount_amount' => '10','total_amount' => '100','start_date' => '2024-06-09','end_date' => '2024-12-15','start_time' => '10:15:00','end_time' => '11:20:00','file' => NULL,'reason' => NULL,'description' => 'test order','created_at' => '2024-06-09 16:43:58','updated_at' => '2024-06-09 16:43:58'),
            array('id' => '6','user_id' => '13','service_id' => '6','influencer_id' => '12','gateway_id' => NULL,'status' => 'awaiting','payment_status' => 'unpaid','amount' => '99','charge' => '50','discount_amount' => '10','total_amount' => '100','start_date' => '2024-06-09','end_date' => '2024-12-15','start_time' => '10:15:00','end_time' => '11:20:00','file' => NULL,'reason' => NULL,'description' => 'test order','created_at' => '2024-07-08 16:47:19','updated_at' => '2024-07-08 16:47:19'),
            array('id' => '7','user_id' => '13','service_id' => '6','influencer_id' => '12','gateway_id' => NULL,'status' => 'awaiting','payment_status' => 'unpaid','amount' => '99','charge' => '50','discount_amount' => '10','total_amount' => '100','start_date' => '2024-06-09','end_date' => '2024-12-15','start_time' => '10:15:00','end_time' => '11:20:00','file' => NULL,'reason' => NULL,'description' => 'test order','created_at' => '2024-07-13 12:08:31','updated_at' => '2024-07-13 12:08:31')
        );

        Order::insert($orders);
    }
}
