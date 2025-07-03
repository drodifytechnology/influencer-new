<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = array(
            array('id' => '1','invoice_no' => NULL,'category_id' => '1','user_id' => '1','date' => '1997-06-27 00:00:00','amount' => '100','type' => NULL,'payment_method' => NULL,'reference_no' => NULL,'file' => NULL,'notes' => NULL,'description' => 'Getting Salary','meta' => NULL,'deleted_at' => NULL,'created_at' => '2024-03-21 14:16:27','updated_at' => '2024-03-21 14:16:27'),
            array('id' => '2','invoice_no' => NULL,'category_id' => '2','user_id' => '3','date' => '2006-02-28 00:00:00','amount' => '4000','type' => NULL,'payment_method' => NULL,'reference_no' => NULL,'file' => NULL,'notes' => NULL,'description' => 'Really Good','meta' => NULL,'deleted_at' => NULL,'created_at' => '2024-03-21 15:07:12','updated_at' => '2024-03-21 15:07:12')
          );

        Transaction::insert($transactions);
    }
}
