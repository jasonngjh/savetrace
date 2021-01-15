<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\PracticePlace;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $practice = practiceplace::create([
            'name' => 'Raffles Hospital',
            'address' => '585 North Bridge Road, Raffles Hospital, Singapore 188770',
            'tel' => '63111111',
            'created_at' => now(),
        ]);

        $practice2 = PracticePlace::create([
            'name' => 'International Eye Cataract Retina Centre',
            'address' => '3 Mount Elizabeth, Mount Elizabeth Medical Centre , #07-01 Singapore 228510',
            'tel' => '68872020',
            'created_at' => now(),
        ]);

        $internalDocWithId = Doctor::create([
            'name' => 'Tan Eik Hock Andrew',
            'registration_number' => 'M10086B',
            'internal' => true,
            'specialty' => 'Nuclear Medicine',
            'practice_place' => $practice->id,
            'created_at' => now(),
            'user_id' => 2,
        ]);

        $internalDocWithOutId = Doctor::create([
            'name' => 'Cherie Seah XinYi',
            'registration_number' => 'M65632A',
            'internal' => true,
            'specialty' => 'ENT',
            'practice_place' => $practice->id,
            'created_at' => now(),
        ]);

        $externalDocWithId = Doctor::create([
            'name' => 'Ajeet Madhav Wagle',
            'registration_number' => 'M10797B',
            'internal' => false,
            'specialty' => 'Ophthalmology',
            'practice_place' => $practice2->id,
            'created_at' => now(),
            'user_id' => 3,
        ]);

        $externalDocWithOutId = Doctor::create([
            'name' => 'Chan Yung-Wei Stephen',
            'registration_number' => 'M09447A',
            'internal' => false,
            'specialty' => 'Anaesthesiology',
            'practice_place' => $practice2->id,
            'created_at' => now(),
        ]);
    }
}
