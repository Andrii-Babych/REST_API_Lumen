<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app('db')->table('users')->insert([
            [
            'id' => 1,
            'first_name' => Str::random(10),
            'last_name' => Str::random(10),
            'email' => 'test@gmail.com',
            'password' => app('hash')->make('1234567'),
            'phone' => '0501234567',
             ], [
            'id' => 2,
            'first_name' => Str::random(10),
            'last_name' => Str::random(10),
            'email' => 'test1@gmail.com',
            'password' => app('hash')->make('1234567'),
            'phone' => '0501234567',
             ], [
            'id' => 3,
            'first_name' => Str::random(10),
            'last_name' => Str::random(10),
            'email' => 'test2@gmail.com',
            'password' => app('hash')->make('1234567'),
            'phone' => '0501234567',
        ]]);
    }
}
