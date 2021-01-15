<?php

namespace App\Http\Livewire;

use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSelect extends LivewireSelect
{
    public function options($searchTerm = null): Collection
    {
        $users = User::role(['internal', 'external'])
            ->select('id AS value', DB::raw('CONCAT(name, " - ", email) AS description'))
            ->get();
        return $users;
    }

    public function selectedOption($value)
    {
        $users = User::select('id', DB::raw('CONCAT(name, " - ", email) AS description'))
            ->where('id', '=', $value)
            ->get();

        return [
            'value' => $users->first()->id,
            'description' => $users->first()->description,
        ];
    }
}
