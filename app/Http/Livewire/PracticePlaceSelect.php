<?php

namespace App\Http\Livewire;

use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;
use App\Models\PracticePlace;

class PracticePlaceSelect extends LivewireSelect
{
    public function options($searchTerm = null): Collection
    {
        $place_practices = PracticePlace::select('id as value', 'name as description')
            ->get();

        return $place_practices;
    }

    public function selectedOption($value)
    {
        $place_practices = PracticePlace::select('id', 'name')
            ->where('id', '=', $value)
            ->get();

        return [
            'value' => $place_practices->first()->id,
            'description' => $place_practices->first()->name,
        ];
    }
}
