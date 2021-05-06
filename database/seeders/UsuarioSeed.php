<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsuarioSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Luis',
            'email' => 'correo@correo.com',
            'email_verified_at' => now(),
            'password' => hash::make('123456789'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Oneil',
            'email' => 'correo2@correo.com',
            'email_verified_at' => now(),
            'password' => hash::make('123456789'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
