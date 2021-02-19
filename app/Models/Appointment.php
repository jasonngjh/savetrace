<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'date_of_appointment',
        'doctor_confirmation',
        'cancelled',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [];

    public function Doctor()
    {
        return $this->hasOne(Doctor::class, 'id', 'doctor_id')->withTrashed();
    }

    public function Patient()
    {
        return $this->hasOne(Patient::class, 'id', 'patient_id')->withTrashed();
    }
}
