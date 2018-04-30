<?php

use Illuminate\Database\Seeder;

class PeranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $peran1 = App\Peran::create([
            'name' => 'Officer',
        ]);
        $peran2 = App\Peran::create([
            'name' => 'Verifier',
        ]);
        $peran3 = App\Peran::create([
            'name' => 'Violator',
        ]);
        $user1 = App\User::find(1);
        $user1->perans()->save($peran1);
        $user2 = App\User::find(2);
        $user2->perans()->save($peran1);
        $user3 = App\User::find(3);
        $user3->perans()->save($peran2);
    }
}
