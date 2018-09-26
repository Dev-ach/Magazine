<?php

use Illuminate\Database\Seeder;

class TagSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'tag' => 'achraf',],
            ['id' => 2, 'tag' => 'messi',],
            ['id' => 3, 'tag' => 'science',],

        ];

        foreach ($items as $item) {
            \App\Tag::create($item);
        }
    }
}
