<?php

use App\Models\DoctorSpecility;
use Illuminate\Database\Seeder;

class DoctorSpecilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DoctorSpecility::delete();
        $data = [
            ["doctor_specialty" => 'Surgen'],
            ["doctor_specialty" => 'Radiology'],
            ["doctor_specialty" => 'padiatrics'],
            ["doctor_specialty" => 'neurology'],
            ["doctor_specialty" => 'cardiology'],
        ];

        DoctorSpecility::insert($data);

    }
}
