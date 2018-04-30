<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = App\User::create([
            'name' => 'Petugas 1',
            'email' => 'petugas1@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        $user1->assignRole('officer');
        $user1->givePermissionTo(['add violations', 'edit violations', 'delete violations', 'view violations']);
        $user2 = App\User::create([
            'name' => 'Petugas 2',
            'email' => 'petugas2@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        $user2->assignRole('officer');
        $user2->givePermissionTo(['add violations', 'edit violations', 'delete violations', 'view violations']);
        $user3 = App\User::create([
            'name' => 'Verifikator1',
            'email' => 'verifikator1@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        $user3->assignRole('verifier');
        $user3->givePermissionTo('verify violations');
        $user4 = App\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);
        $user4->assignRole('super-admin');
        $user4->givePermissionTo(['add violations', 'edit violations', 'delete violations', 'view violations', 'verify violations']);
        /*
        DB::table('users')->insert([
            'name' => 'Pelanggar 1',
            'email' => 'pelanggar1@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        DB::table('users')->insert([
            'name' => 'Pelanggar 2',
            'email' => 'pelanggar2@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        */
        factory(App\User::class, 50)->create()->each(function ($user) {
            $user->violations()->saveMany(factory(App\Violation::class)->times(10)->make());
            $user->assignRole('violator');
            $user->givePermissionTo('view violations');
        });
    }
}
