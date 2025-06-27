<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = array(
            array('invoice_no' => NULL,'expense_id' => NULL, 'user_id' => '4','amount' => '500','type' => 'debit','notes' => 'test withdraw','deleted_at' => NULL,'created_at' => '2024-05-16 11:27:33','updated_at' => '2024-05-16 11:27:33'),
            array('invoice_no' => NULL, 'expense_id' => NULL,'user_id' => '5','amount' => '500','type' => 'debit','notes' => 'test withdraw','deleted_at' => NULL,'created_at' => '2024-05-28 16:17:17','updated_at' => '2024-05-28 16:17:17')
          );

          Transaction::insert($transactions);
    }
}
