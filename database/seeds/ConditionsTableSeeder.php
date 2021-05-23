<?php

use Illuminate\Database\Seeder;

class ConditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conditions')->insert(['name' => '新品']);
        DB::table('conditions')->insert(['name' => '未使用']);
        DB::table('conditions')->insert(['name' => '中古']);
    }
}
