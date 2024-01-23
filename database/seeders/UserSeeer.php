<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class UserSeeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'Loading Dock',
                'username' => 'loadingdock',
                'password' => Hash::make('12345678'),
                'type' => 'l/d'
            ],
            [
                'name' => 'Production Planning Control',
                'username' => 'ppc',
                'password' => Hash::make('12345678'),
                'type' => 'ppc'
            ],
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('12345678'),
                'type' => 'admin'
            ]
        ];

        DB::table('users')->insert($user);
    }
}
