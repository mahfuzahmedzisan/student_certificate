<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Student::create([
            "name" => "Asif Ahmed",
            "phone" => "01292832133",
            "address" => "Mirpur, Dhaka",
            "passport_id" => "34524234",
            "reference_by" => "Rahim",
            "reference_contact" => "01292832134",
            "payment" => "4000",
        ]);
        Student::create([
            "name" => "Nayem Islam",
            "phone" => "01292832135",
            "address" => "Mirpur, Dhaka",
            "passport_id" => "34524235",
            "reference_by" => "Shakib",
            "reference_contact" => "01292832136",
            "payment" => "5000",
        ]);
    }
}
