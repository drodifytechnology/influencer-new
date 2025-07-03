<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coupons = array(
            array('id' => '1','title' => 'Ibu','image' => NULL,'code' => '3134','start_date' => '2024-07-07','end_date' => '2024-07-14','discount_type' => 'percentage','discount' => '5','bg_color' => '#4876FF','status' => '1','description' => 'test description','created_at' => '2024-03-21 13:37:40','updated_at' => '2024-03-21 13:37:40'),
            array('id' => '2','title' => 'Coupon','image' => NULL,'code' => '5454','start_date' => '2024-07-07','end_date' => '2024-07-14','discount_type' => 'fixed','discount' => '100','bg_color' => '#FC9700','status' => '1','description' => 'test description','created_at' => '2024-03-21 13:38:41','updated_at' => '2024-03-21 13:38:41')
          );

        Coupon::insert($coupons);
    }
}
