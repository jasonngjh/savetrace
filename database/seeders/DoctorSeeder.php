<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\PracticePlace;
use App\Models\Nurse;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $practice = PracticePlace::create([
            'name' => 'Raffles Hospital',
            'address' => '585 North Bridge Road, Raffles Hospital, Singapore 188770',
            'tel' => '63111111',
            'created_at' => now(),
            'area' => 'C',
            'opening_time' => 'Mon - Fri: 8:30 a.m. - 12:30 p.m.
            1:30 p.m. - 5 p.m.
            Sat: 8:30 a.m. - 12:30 p.m.',
        ]);

        $practice2 = PracticePlace::create([
            'name' => 'Ng Teng Fong General Hospital',
            'address' => '1 Jurong East Street 21 Singapore 609606',
            'tel' => '68872020',
            'created_at' => now(),
            'area' => 'W',
            'opening_time' => 'Mon - Fri: 8:30 a.m. - 12:30 p.m.
            1:30 p.m. - 5 p.m.
            Sat: 8:30 a.m. - 12:30 p.m.',
        ]);

        $internalDocWithId = Doctor::create([
            'name' => 'Tan Eik Hock Andrew',
            'registration_number' => 'M10086B',
            'email' => 'andrew@raffleshospital.com',
            'contact' => '63111102',
            'internal' => true,
            'specialty' => 'Nuclear Medicine',
            'practice_place' => $practice->id,
            'created_at' => now(),
            'user_id' => 2,
        ]);

        $externalDocWithId = Doctor::create([
            'name' => 'Ajeet Madhav Wagle',
            'registration_number' => 'M10797B',
            'internal' => false,
            'email' => 'ajeetwagle@gmail.com',
            'contact' => '6443 2020',
            'specialty' => 'Ophthalmology',
            'practice_place' => $practice2->id,
            'created_at' => now(),
            'user_id' => 3,
            'information' => 'Dr. Ajeet Madhav Wagle is a Medical Director and Senior Consultant at International Eye Cataract Retina Centre at Farrer Park Medical Centre. He specializes in the medical and surgical management of retinal diseases such as retinal detachment, macular degeneration, diabetic retinopathy, retinal vascular occlusions as well as advanced modern cataract surgery and comprehensive eye care.',
        ]);

        $employee = Nurse::create([
            'user_id' => 4,
            'practice_place' => $practice->id,
        ]);
    }
}
