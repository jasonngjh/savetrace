<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory;
    use HasProfilePhoto;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'registration_number',
        'internal',
        'specialty',
        'email',
        'contact',
        'fax',
        'information',
        'practice_place',
        'user_id',
        'profile_photo_path',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function PracticePlace()
    {
        return $this->belongsTo(PracticePlace::class, 'practice_place');
    }
}
