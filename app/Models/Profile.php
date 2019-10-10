<?php

namespace App\Models;

use Carbon\Carbon;
use Eloquent as Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Profile
 * @package App\Models
 * @version August 28, 2019, 5:35 pm UTC
 *
 * @property \App\Models\User user
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property integer user_id
 * @property string date_of_birth
 * @property string due_date
 * @property string last_period_date
 * @property string phone
 * @property string photo
 * @property string gender
 * @property  attributes
 */
class Profile extends Model
{
//    use SoftDeletes;

    public $table = 'profiles';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'date_of_birth',
        'kid_date_of_birth',
        'due_date',
        'last_period_date',
        'phone',
        'photo',
        'gender'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'date_of_birth' => 'date',
        'kid_date_of_birth' => 'date',
        'due_date' => 'date',
        'last_period_date' => 'date',
        'phone' => 'string',
        'photo' => 'string',
        'gender' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'phone' => 'required'
    ];

    public $with = [

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function getDateOfBirthAttribute($value)
    {
        return $value === null ? null : Carbon::parse($value)->format('Y-m-d');
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getKidDateOfBirthAttribute($value)
    {
        return $value === null ? null : Carbon::parse($value)->format('Y-m-d');
    }

    public function setKidDateOfBirthAttribute($value)
    {
        $this->attributes['kid_date_of_birth'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getLastPeriodDateAttribute($value)
    {
        return $value === null ? null : Carbon::parse($value)->format('Y-m-d');
    }

    public function setLastPeriodDateAttribute($value)
    {
        $this->attributes['last_period_date'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function getDueDateAttribute($value)
    {
        return $value === null ? null : Carbon::parse($value)->format('Y-m-d');
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = Carbon::parse($value)->format('Y-m-d');
    }

}
