<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'account_id' => 1,
            'name' => 'Developer',
            'email' => 'developer@mach3builders.nl',
            'password' => bcrypt('password'),
            'created_at' => Carbon::now(),
        ]);
    }
}
