<?php

namespace App\Http\Livewire;

use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;
use App\Models\Doctor;

class DoctorSelect extends LivewireSelect
{
    public function options($searchTerm = null): Collection
    {
        $doctors = Doctor::select('id as value', 'name as description')
            ->where('user_id', '=', null)
            ->get();
        return $doctors;
    }

    public function selectedOption($value)
    {
        $doctors = Doctor::select('id', 'name')
            ->where('id', '=', $value)
            ->get();

        return [
            'value' => $doctors->first()->id,
            'description' => $doctors->first()->name,
        ];
    }
}
