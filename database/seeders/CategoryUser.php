<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category_user = array(
            array('user_id' => '8','category_id' => '3'),
            array('user_id' => '8','category_id' => '2'),
            array('user_id' => '12','category_id' => '3'),
            array('user_id' => '13','category_id' => '2'),
            array('user_id' => '14','category_id' => '3'),
            array('user_id' => '14','category_id' => '2'),
            array('user_id' => '14','category_id' => '1')
        );

        DB::table('category_user')->insert($category_user);
    }
}
