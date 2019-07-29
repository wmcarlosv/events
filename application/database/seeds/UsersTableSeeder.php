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
        DB::table('users')->insert([
        	[
        		'name' => 'Administrador',
        		'email' => 'cvargas@frontuari.net',
        		'role' => 'administrator',
        		'password' => bcrypt('Car2244los*') 
        	],
            [
                'name' => 'Operator',
                'email' => 'echirinos@frontuari.net',
                'role' => 'operator',
                'password' => bcrypt('Lo1122ro*') 
            ]
        ]);
    }
}
