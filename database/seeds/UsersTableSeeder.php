<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'rut'    => '11111111-1',
            'password' => 'admin@',
            'email'  => "admin@admin.cl",
            'rol_id' => 1 // 1:admin, 2: jefatura, 3:analista, 4:programador
        ]);

        for ($i=1; $i <= 2; $i++) {

            User::create([
                'name' => 'Evaluador '.$i,
                'rut'    => '11111111-'.$i,
                'password' => '1111',
                'email'  => "mail@enovus{$i}.cl",
                'rol_id' => 2 // 1: jefatura, 2:analista, 3:programador
            ]);
        }

        for ($i=3; $i <= 6; $i++) {
            User::create([
                'name' => 'Evaluado '.$i,
                'rut'    => '11111111-'.$i,
                'password' => '1111',
                'email'  => "mail@enovus{$i}.cl",
                'rol_id' => 3
            ]);
        }

        for ($i=7; $i <= 10; $i++) {
            User::create([
                'name' => 'Evaluado '.$i,
                'rut'    => '11111111-1',
                'password' => '1111',
                'email'  => "mail@enovus{$i}.cl",
                'rol_id' => 4
            ]);
        }
    }
}
