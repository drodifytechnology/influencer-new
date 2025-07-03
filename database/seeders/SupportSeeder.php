<?php

namespace Database\Seeders;

use App\Models\Support;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supports = array(
            array('id' => '10','subject' => 'I need a help.','user_id' => '4','support_id' => NULL,'has_new' => NULL,'priority' => 'high','ticket_no' => '00001','attachment' => NULL,'message' => 'hi admin','status' => 'closed','created_at' => '2024-05-15 17:31:58','updated_at' => '2024-05-16 11:03:05'),
            array('id' => '11','subject' => NULL,'user_id' => '12','support_id' => '10','has_new' => '1','priority' => NULL,'ticket_no' => NULL,'attachment' => NULL,'message' => 'hello influencer','status' => NULL,'created_at' => '2024-05-15 17:32:52','updated_at' => '2024-05-15 17:32:52'),
            array('id' => '12','subject' => NULL,'user_id' => '12','support_id' => '10','has_new' => NULL,'priority' => NULL,'ticket_no' => NULL,'attachment' => NULL,'message' => 'I have done my work','status' => NULL,'created_at' => '2024-05-15 17:55:44','updated_at' => '2024-05-15 17:55:44'),
            array('id' => '13','subject' => NULL,'user_id' => '13','support_id' => '10','has_new' => NULL,'priority' => NULL,'ticket_no' => NULL,'attachment' => NULL,'message' => 'whats going next?','status' => NULL,'created_at' => '2024-05-16 11:09:36','updated_at' => '2024-05-16 11:09:36'),
            array('id' => '14','subject' => NULL,'user_id' => '13','support_id' => '10','has_new' => NULL,'priority' => NULL,'ticket_no' => NULL,'attachment' => NULL,'message' => 'hey, are you there?','status' => NULL,'created_at' => '2024-05-16 11:13:19','updated_at' => '2024-05-16 11:13:19')
          );

          Support::insert($supports);
    }
}
