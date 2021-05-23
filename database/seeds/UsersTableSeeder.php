<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            $user = new \App\User([
                'name' => 'user' . $i,
                'email' => 'test1'.$i.'@test.com', 
                'password' => 'test1234', 
                'postal' => '1234567', 
                'address' => '東京都新宿区新宿3-1-13 京王新宿追分ビル4階', 
                'phone' => '00011112222',
            ]);
            $user->save();
        }
    }
}
