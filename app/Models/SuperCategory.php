<?php

namespace App\Models;

use App\Image;
use App\User;
use Eloquent as Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SuperCategory
 * @package App\Models
 * @version August 24, 2019, 6:49 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection interests
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection posts
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection tags
 * @property string name
 * @property boolean active
 */
class SuperCategory extends Model
{
//    use SoftDeletes;

    public $table = 'super_categories';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'active',
        'user_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'active' => 'required'
    ];

    public $with = [
        'languages',
        'images'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function interests()
    {
        return $this->belongsToMany(\App\Models\Interest::class, 'interest_super_category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function posts()
    {
        return $this->belongsToMany(\App\Models\Post::class, 'post_super_category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function tags()
    {
        return $this->belongsToMany(\App\Models\Tag::class, 'super_category_tag');
    }

    public function foodCategories()
    {
        return $this->belongsToMany(FoodCategory::class, 'food_category_super_category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function languages()
    {
        return $this->belongsToMany(\App\Models\Language::class, 'language_super_categories');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'super_category_user');
    }
}
