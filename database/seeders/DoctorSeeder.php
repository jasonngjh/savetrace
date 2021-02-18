<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\PracticePlace;
use App\Models\Nurse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $practice_place_data = array();
        $doctors_data = array();
        $nurses_data = array();
        $users_data = array();
        $patients_data = array();

        if (($handle = fopen("database/testdata/practiceplaces.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $practice_place_data[] = $data;
            }
            fclose($handle);
        }

        if (($handle = fopen("/database/testdata/nurses.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $nurses_data[] = $data;
            }
            fclose($handle);
        }

        if (($handle = fopen("/database/testdata/doctors.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $doctors_data[] = $data;
            }
            fclose($handle);
        }

        if (($handle = fopen("database/testdata/users.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $users_data[] = $data;
            }
            fclose($handle);
        }

        if (($handle = fopen("database/testdata/patients.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $patients_data[] = $data;
            }
            fclose($handle);
        }

        $pp_count = 0;
        foreach ($practice_place_data as $pratice_place) {
            if ($pp_count == 0) {
                $pp_count++;
                continue;
            }
            PracticePlace::create([
                'name' => $pratice_place[3],
                'address' => $pratice_place[4],
                'tel' => $pratice_place[5],
                'area' => $pratice_place[6],
                'opening_time' => $pratice_place[7],
            ]);
        }

        $user_header = 0;
        foreach ($users_data as $user) {
            if ($user_header == 0) {
                $user_header++;
                continue;
            }

            $thisuser = User::create([
                'name' => $user[1],
                'email' => $user[2],
                'password' => Hash::make('password'),
                'contact_number' => $user[8],
            ]);

            if ($user[13] == 'internal' or $user[13] == 'external') {
                foreach ($doctors_data as $doctor) {
                    if ($user[1] == $doctor[3]) {
                        $thisdoctor = Doctor::create([
                            'name' => $doctor[3],
                            'registration_number' => $doctor[4],
                            'internal' => $user[13] == 'internal' ? True : False,
                            'email' => $doctor[5],
                            'contact' => $doctor[6],
                            'fax' => $doctor[7],
                            'specialty' => $doctor[9],
                            'information' => $doctor[11],
                            'practice_place' => (PracticePlace::select('id')->where('name', '=', $doctor[12])->get())->first()->id,
                            'user_id' => $thisuser->id,
                        ]);

                        $thisuser->role_id = $thisdoctor->id;
                        $thisuser->save();
                    }
                }
            } elseif ($user[13] == 'nurse') {
                foreach ($nurses_data as $nurse) {
                    if ($nurse[4] == $user[0]) {
                        $thisnurse = Nurse::create([
                            'practice_place' => (PracticePlace::select('id')->where('name', '=', $nurse[3])->get())->first()->id,
                            'user_id' => $thisuser->id,
                        ]);

                        $thisuser->role_id = $thisnurse->id;
                        $thisuser->save();
                    }
                }
            } else {
                foreach ($patients_data as $patient) {
                    if ($patient[4] == $user[1]) {
                        $thispatient = Patient::create([
                            'user_id' => $thisuser->id,
                            'name' => $patient[4],
                            'date_of_birth' => date_format(date_create_from_format('d/m/Y', $patient[5]), 'Y-m-d'),
                            'contact_number' => $patient[6],
                            'name_of_emergency_contact' => $patient[7],
                            'contact_number_of_emergency_contact' => $patient[8],
                            'address' => $patient[9],
                            'allergies' => $patient[11],
                        ]);

                        $thisuser->role_id = $thispatient->id;
                        $thisuser->save();
                    }
                }
            }
        }
    }
}
