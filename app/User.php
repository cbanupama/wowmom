<?php

namespace App;

use App\Models\Interest;
use App\Models\Language;
use App\Models\SuperCategory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','language_id','interest_id','tag_id', 'super_category_id', 'food_category_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function interests()
    {
        return $this->belongsToMany(Interest::class, 'interest_user');
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'language_user');
    }

    public function superCategories()
    {
        return $this->belongsToMany(SuperCategory::class, 'super_category_user');
    }
}
