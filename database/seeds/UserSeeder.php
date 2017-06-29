<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_pemda')->truncate();
        DB::table('roles')->truncate();
        DB::table('users')->truncate();

        \App\User::create([
            'name' => 'DJPK',
            'username' => 'djpk',
            'password' => Hash::make('password'),
            'group' => 'djpk',
        ]);

        $dinas = \App\Dinas::all();
        $pemda = \App\Pemda::all();
        $kls = \App\Kl::all();

        $counter = 1;
        foreach ($dinas as $d) {
            foreach ($pemda as $p) {
                $u = [];
                $u['name'] = $d->nama . ' ' . $p->nama;
                $u['username'] = 'dinas' . $counter;
                $u['password'] = Hash::make('password');
                $u['group'] = 'pemda';

                $uid = \App\User::create($u);

                DB::table('roles')->insert([
                    'user_id' => $uid->id,
                    'object_id' => $d->id,
                ]);

                DB::table('user_pemda')->insert([
                    'user_id' => $uid->id,
                    'pemda_id' => $p->id,
                ]);

                $counter++;
            }
        }

        $counter = 1;
        foreach ($kls as $kl) {
            $u = [];
            $u['name'] = $kl->nama;
            $u['username'] = 'kl' . $counter;
            $u['password'] = Hash::make('password');
            $u['group'] = 'kl';

            $uid = \App\User::create($u);

            DB::table('roles')->insert([
                'user_id' => $uid->id,
                'object_id' => $kl->id,
            ]);

            $counter++;
        }

    }
}
