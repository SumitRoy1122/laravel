<?php

use Illuminate\Database\Seeder;
use app\Model\user;
class user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userModel = new User();
        $userModel->name = 'admin';
        $userModel->email = 'admin@admin.com';
        $userModel->password = Hash::make('password');
        $userModel->save();
    }
}
