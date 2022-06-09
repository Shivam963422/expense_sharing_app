<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      
       DB::table('users')->insert([
       	 [
            'name' => 'user1',
            'email' => 'user1@gmail.com',
            'password'=>'$2y$10$Zi24.xicPUZfzCjJkCvL8u5YQjY83LVPNe/q6q/L429g/i0ojmTHO',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'mobile_number'=> '7257880045'
         ],
         [
            'name' => 'user2',
            'email' => 'user2@gmail.com',
            'password'=>'$2y$10$Zi24.xicPUZfzCjJkCvL8u5YQjY83LVPNe/q6q/L429g/i0ojmTHO',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'mobile_number'=> '7257880046'
         ],
         [
            'name' => 'user3',
            'email' => 'user3@gmail.com',
            'password'=>'$2y$10$Zi24.xicPUZfzCjJkCvL8u5YQjY83LVPNe/q6q/L429g/i0ojmTHO',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'mobile_number'=> '7257880047'

         ],
         [ 
            'name' => 'user4',
            'email' => 'user4@gmail.com',
            'password'=>'$2y$10$Zi24.xicPUZfzCjJkCvL8u5YQjY83LVPNe/q6q/L429g/i0ojmTHO',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'mobile_number'=> '7257880048'
         ],
         [
            'name' => 'user5',
            'email' => 'user5@gmail.com',
            'password'=>'$2y$10$Zi24.xicPUZfzCjJkCvL8u5YQjY83LVPNe/q6q/L429g/i0ojmTHO',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'mobile_number'=> '7257880049'
         ]
       ]);
    }
}
//end of file
// end of class
