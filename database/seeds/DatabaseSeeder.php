<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('admins')->insert([
            'name' => 'robber',
            'email' => '605159011@qq.com',
            'password' => bcrypt('robber'),
        ]);
    }
}
