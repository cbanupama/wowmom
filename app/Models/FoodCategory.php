<?php

namespace App\Models;

use App\Image;
use Eloquent as Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class FoodCategory
 * @package App\Models
 * @version August 26, 2019, 8:48 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection languages
 * @property \Illuminate\Database\Eloquent\Collection superCategories
 * @property \Illuminate\Database\Eloquent\Collection tags
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property string name
 * @property boolean active
 */
class FoodCategory extends Model
{
//    use SoftDeletes;

    public $table = 'food_categories';
    
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
        'superCategories',
        'languages',
        'tags',
        'interests',
        'images'

    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function languages()
    {
        return $this->belongsToMany(\App\Models\Language::class, 'food_category_language');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function superCategories()
    {
        return $this->belongsToMany(\App\Models\SuperCategory::class, 'food_category_super_category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function tags()
    {
        return $this->belongsToMany(\App\Models\Tag::class, 'food_category_tag');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function interests()
    {
        return $this->belongsToMany(\App\Models\Interest::class, 'food_category_interest');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
