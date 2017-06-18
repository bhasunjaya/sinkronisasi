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

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        // $this->call(UsersTableSeeder::class);
        // \App\User::create(['name' => 'admin', 'username' => 'admin',
        //     'password' => Hash::make('password'),

        // ]);

        // $this->call(PemdasTableSeeder::class);
        // $this->call(BidangsTableSeeder::class);
        // $this->call(BappenasTableSeeder::class);
        // $this->call(KlTableSeeder::class);
        // $this->call(DinasTableSeeder::class);
        // $this->call(KegiatansTableSeeder::class);
        $this->call(UsulansTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
