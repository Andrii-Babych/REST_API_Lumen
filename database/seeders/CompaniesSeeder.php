<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app('db')->table('companies')->insert([
            [
                'id' => 1,
                'title' => 'company_1',
                'phone' => '0501234567',
                'description' => Str::random(10),
            ], [
            'id' => 2,
            'title' => 'company_2',
            'phone' => '0501234567',
            'description' => Str::random(10),
        ], [
            'id' => 3,
            'title' => 'company_3',
            'phone' => '0501234567',
            'description' => Str::random(10),
        ]]);

        app('db')->table('users_companies')->insert([
            [
            'user_id' => 1,
            'company_id' => 1,
            ], [
            'user_id' => 1,
            'company_id' => 2,
            ], [
            'user_id' => 2,
            'company_id' => 2,
            ], [
            'user_id' => 2,
            'company_id' => 3,
        ]]);
    }
}
