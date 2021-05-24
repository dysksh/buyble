<?php

use Illuminate\Database\Seeder;

class ClassificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classifications')->insert(['name' => '文学部系']);
        DB::table('classifications')->insert(['name' => '教育学部系']);
        DB::table('classifications')->insert(['name' => '法学部系']);
        DB::table('classifications')->insert(['name' => '社会学部系']);
        DB::table('classifications')->insert(['name' => '経済学部系']);
        DB::table('classifications')->insert(['name' => '理学部系']);
        DB::table('classifications')->insert(['name' => '医学部系']);
        DB::table('classifications')->insert(['name' => '歯学部系']);
        DB::table('classifications')->insert(['name' => '薬学部系']);
        DB::table('classifications')->insert(['name' => '工学部系']);
        DB::table('classifications')->insert(['name' => '農学部系']);
    }
}
