<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expense_categories = array(
            array('id' => '1','name' => 'Salary','description' => 'Acnoo employee Salary','status' => '1','created_at' => '2024-03-21 13:51:33','updated_at' => '2024-03-21 13:51:33'),
            array('id' => '2','name' => 'Traveling','description' => 'Travel To Gazipur Resort','status' => '1','created_at' => '2024-03-21 15:05:51','updated_at' => '2024-03-21 15:05:51')
          );

        ExpenseCategory::insert($expense_categories);
    }
}
