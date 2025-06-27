<?php

namespace Database\Seeders;

use App\Models\WithdrawMethod;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WithdrawMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $withdraw_methods = array(
            array('name' => 'Prime Bank','currency_id' => '1','min_amount' => '1000','max_amount' => '50000','charge' => '150','charge_type' => 'percentage','instructions' => 'Test method','meta' => '{"label":["Bank Name","Routing Number","Branch"],"input":["bank_name","routing_no","branch"]}','status' => '1','created_at' => '2024-05-09 12:48:02','updated_at' => '2024-05-09 15:48:21')
          );

        WithdrawMethod::insert($withdraw_methods);

    }
}
