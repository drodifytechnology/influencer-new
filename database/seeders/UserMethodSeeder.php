<?php

namespace Database\Seeders;

use App\Models\UserMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_methods = array(
            array('id' => '1','method_id' => '1','user_id' => '4','account_no' => '77777776666','infos' => '{"bank_name":"prime bank","routing_no":"555500000","branch":"Mirpur 10"}','notes' => 'test setup','created_at' => '2024-05-16 11:20:56','updated_at' => '2024-05-16 11:20:56')
          );

          UserMethod::insert($user_methods);
    }
}
