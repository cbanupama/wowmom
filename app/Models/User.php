<?php

namespace App\Models;

use App\Models\Interest;
use App\Models\Language;
use App\Models\SuperCategory;
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

<<<<<<< HEAD
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
=======
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
<<<<<<< HEAD:app/Models/User.php
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
=======
//    public function profile()
//    {
//        return $this->hasMany(\App\Models\Profile::class, 'user_id');
//    }
//    public function language()
//    {
//        return $this->hasMany(\App\Models\Language::class, 'user_id');
//    }
//    public function superCategory()
//    {
//        return $this->hasMany(\App\Models\SuperCategory::class, 'user_id');
//    }
//    public function foodCategory()
//    {
//        return $this->hasMany(\App\Models\FoodCategory::class, 'user_id');
//    }
//    public function tag()
//    {
//        return $this->hasMany(\App\Models\Tag::class, 'user_id');
//    }
>>>>>>> 6b6913f033859ea86153292ddcceac4904c7ae25
>>>>>>> 4c48a9ae165410a179d82cb55e8a476b162ad9f4:app/User.php
}
