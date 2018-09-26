<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Admin', 'email' => 'admin@admin.com', 'password' => '$2y$10$H2uUA2deQTev79CkfYun.uwOigCi7Y6QRSU4.pN1o8DPYqe9QmNne', 'role_id' => 1, 'remember_token' => '',],
            ['id' => 2, 'name' => 'achraf gorani', 'email' => 'cyoube.ach@afriquedefis.com', 'password' => '$2y$10$HmplQZCn0.7hpG2nvVZxB.Vu55dtqfGbMamVvnJn6nZqJEpiOE7xS', 'role_id' => 3, 'remember_token' => null,],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
