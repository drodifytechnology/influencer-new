<?php

namespace Database\Seeders;

use App\Models\Withdraw;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WithdrawSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $withdraws = array(
            array('user_method_id' => '1','user_id' => '4','amount' => '500','charge' => '150','status' => 'pending','notes' => 'test withdraw','reason' => NULL,'created_at' => '2024-05-16 11:27:33','updated_at' => '2024-05-16 11:27:33'),
            array('user_method_id' => '1','user_id' => '5','amount' => '500','charge' => '150','status' => 'pending','notes' => 'test withdraw','reason' => NULL,'created_at' => '2024-05-28 16:17:17','updated_at' => '2024-05-28 16:17:17')
          );


          Withdraw::insert($withdraws);
    }
}
