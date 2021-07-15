<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class seedAccAdmin extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('admin')->insert([
            'username' => 'admin@gmail.com',
            'password' => Hash::make('123456')
        ]);
    }
}
