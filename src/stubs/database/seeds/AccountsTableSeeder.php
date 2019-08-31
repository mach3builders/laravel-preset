<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            'name' => 'Mach3Builders',
            'contact' => 'Support',
            'email' => 'support@mach3builders.nl',
            'phone' => '010-8208890',
            'street' => 'Oslo 18',
            'zipcode' => '2993 LD',
            'city' => 'Barendrecht',
            'country_id' => 154, # Netherlands
            'token' => Str::random(40),
            'created_at' => Carbon::now(),
        ]);
    }
}
