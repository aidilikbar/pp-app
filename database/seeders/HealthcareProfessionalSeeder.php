<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HealthcareProfessionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Dr. Jan de Vries',
                'email' => 'jandevries@example.com',
                'password' => Hash::make('password'),
                'role' => 'general_practitioner',
            ],
            [
                'name' => 'Dr. Anne Bakker',
                'email' => 'annebakker@example.com',
                'password' => Hash::make('password'),
                'role' => 'general_practitioner',
            ],
            [
                'name' => 'Dr. Pieter Jansen',
                'email' => 'pieterjansen@example.com',
                'password' => Hash::make('password'),
                'role' => 'general_practitioner',
            ],
            [
                'name' => 'Dr. Sophie van Dijk',
                'email' => 'sophievandijk@example.com',
                'password' => Hash::make('password'),
                'role' => 'general_practitioner',
            ],
            [
                'name' => 'Dr. Lucas Visser',
                'email' => 'lucasvisser@example.com',
                'password' => Hash::make('password'),
                'role' => 'general_practitioner',
            ],
        ]);
    }
}
