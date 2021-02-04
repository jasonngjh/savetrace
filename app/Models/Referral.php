<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_id',
        'from_doctor_id',
        'to_doctor_id',
        'visited_on',
        'viewed',
        'file_path',
    ];

    public function From_doctor()
    {
        return $this->hasOne(Doctor::class, 'id', 'from_doctor_id')->withTrashed();
    }

    public function To_Doctor()
    {
        return $this->hasOne(Doctor::class, 'id', 'to_doctor_id')->withTrashed();
    }
}
