<?php

namespace Database\Seeders;

//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => bcrypt('password'),
                'role' => 'patient',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => bcrypt('password'),
                'role' => 'patient',
            ],
        ]);

        DB::table('patients')->insert([
            [
                'user_id' => 1,
                'date_of_birth' => '1990-01-01',
                'gender' => 'male',
                'contact_number' => '1234567890',
                'address' => '123 Main St',
            ],
            [
                'user_id' => 2,
                'date_of_birth' => '1985-05-05',
                'gender' => 'female',
                'contact_number' => '0987654321',
                'address' => '456 Elm St',
            ],
        ]);
    }
}
