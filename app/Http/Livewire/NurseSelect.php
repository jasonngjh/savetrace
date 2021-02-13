<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;
use App\Models\Nurse;
use Illuminate\Support\Facades\DB;

class NurseSelect extends LivewireSelect
{
    public function options($searchTerm = null): Collection
    {
        // $nurses = Nurse::select('id as value', 'name as description')
        //     ->get();
        $nurses = DB::table('nurses')
            ->join('users', 'user_id', '=', 'users.id')
            ->select('users.id as value', 'users.name as description')
            ->get();


        $nurses_array = collect(json_decode(json_encode($nurses), true));
        return $nurses_array;
    }

    public function selectedOption($value)
    {
        $nurses = DB::table('nurses')
            ->join('users', 'user_id', '=', 'users.id')
            ->select('users.id', 'users.name')
            ->where('user_id', '=', $value)
            ->get();

        return [
            'value' => $nurses->first()->id,
            'description' => $nurses->first()->name,
        ];
    }
}
