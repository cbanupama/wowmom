<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles,Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
//        'language_id',
//        'interest_id',
//        'tag_id',
//        'super_category_id',
//        'food_category_id'
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

    public $with = [
//        'profile',
//        'language',
//        'interest',
//        'tag',
//        'super_category',
//        'food_category'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profile()
    {
        return $this->hasOne(\App\Models\Profile::class, 'user_id');
    }
    public function languages()
    {
        return $this->belongsToMany(\App\Models\Language::class, 'language_user');
    }
    public function superCategories()
    {
        return $this->belongsToMany(\App\Models\SuperCategory::class, 'super_category_user');
    }
    public function foodCategories()
    {
        return $this->belongsToMany(\App\Models\FoodCategory::class, 'food_category_user');
    }
    public function tags()
    {
        return $this->belongsToMany(\App\Models\Tag::class, 'tag_user');
    }
    public function interests()
    {
        return $this->belongsToMany(\App\Models\Interest::class, 'interest_user');
    }
}
