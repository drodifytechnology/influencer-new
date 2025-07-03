<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $blogs = array(
            array('id' => '1','title' => 'Best HR & Payroll Management Software in World (2024)','slug' => 'best-hr-payroll-management-software-in-world-2024','image' => 'uploads/24/03/1711008199-101.png','status' => '1','descriptions' => 'Blessing welcomed ladyship she met humo ured sir breeding her. Six curiosity day assurance bed necessary','created_at' => '2024-03-21 14:03:20','updated_at' => '2024-03-21 14:03:20')
        );

        Blog::insert($blogs);
    }
}
