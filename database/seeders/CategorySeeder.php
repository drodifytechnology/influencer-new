<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = array(
            array('name' => 'Actor','status' => '1','icon' => 'uploads/24/06/1717658697-527.png','created_at' => '2024-03-21 13:30:51','updated_at' => '2024-06-06 13:24:57'),
            array('name' => 'Best Social media advertising','status' => '1','icon' => 'uploads/24/06/1717658689-392.png','created_at' => '2024-03-21 15:03:20','updated_at' => '2024-06-06 13:24:49'),
            array('name' => 'Marketing','status' => '1','icon' => 'uploads/24/06/1717658613-181.png','created_at' => '2024-03-21 15:03:36','updated_at' => '2024-06-06 13:23:33'),
            array('name' => 'Leroy Dominguez','status' => '1','icon' => 'uploads/24/06/1717658029-593.png','created_at' => '2024-06-06 13:13:49','updated_at' => '2024-06-06 13:13:49')
          );


        Category::insert($categories);
    }
}
