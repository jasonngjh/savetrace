<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Referral;

class ReferralApptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $referral_data = array();
        $appt_data = array();

        if (($handle = fopen("database/testdata/appointments.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $appt_data[] = $data;
            }
            fclose($handle);
        }

        if (($handle = fopen("database/testdata/referrals.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $referral_data[] = $data;
            }
            fclose($handle);
        }

        $appt_count = 0;
        foreach ($appt_data as $appt) {
            if ($appt_count == 0) {
                $appt_count++;
                continue;
            }

            Appointment::create([
                'patient_id' => (Patient::where('name', '=', $appt[3])->get())->first()->id,
                'doctor_id' => (Doctor::where('name', '=', $appt[4])->get())->first()->id,
                'referral_id' =>  null,
                'date_of_appointment' => date_format(date_create_from_format('d/n/y H:i', $appt[6]), 'Y-m-d H:i'),
                'doctor_confirmation' => $appt[7],
                'cancelled' => $appt[8],
            ]);
        }

        $referral_count = 0;
        foreach ($referral_data as $ref) {
            if ($referral_count == 0) {
                $referral_count++;
                continue;
            }

            Referral::create([
                'created_at' => now(),
                'patient_id' => (Patient::where('name', '=', $ref[3])->get())->first()->id,
                'from_doctor_id' => (Doctor::where('name', '=', $ref[4])->get())->first()->id,
                'to_doctor_id' => (Doctor::where('name', '=', $ref[5])->get())->first()->id,
                'visited_on' =>  null,
                'viewed' =>  $ref[7],
                'file_path' => '/public/referrals/161364056212',
            ]);
        }
    }
}
