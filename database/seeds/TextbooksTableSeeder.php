<?php

use Illuminate\Database\Seeder;

class TextbooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 100; $i++) {
            $textbook = new \App\Textbook([
                'isbn_no' => '0000000000',
                'title' => 'title'.$i,
                'author' => 'author'.$i,
                'classification_id' => rand(1, 11),
                'condition_id' => rand(1, 3),
                'price' => rand(10, 50) * 100,
                'seller_id' => 1,
            ]);
            $textbook->save();
        }
    }
}
