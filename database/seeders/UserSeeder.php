<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Healthcare Professional',
                'email' => 'hcp@example.com',
                'password' => Hash::make('password'),
                'role' => 'healthcare_professional',
            ],
            [
                'name' => 'Patient User',
                'email' => 'patient@example.com',
                'password' => Hash::make('password'),
                'role' => 'patient',
            ],
        ]);
    }
}
