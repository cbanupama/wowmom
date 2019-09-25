<?php

namespace App\Models;

use App\Image;
use Illuminate\Database\Eloquent\Model;

//use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Post
 * @package App\Models
 * @version August 24, 2019, 6:51 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection interests
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection languages
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection superCategories
 * @property \Illuminate\Database\Eloquent\Collection tags
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property string type
 * @property string title
 * @property string body
 */
class Post extends Model
{
//    use SoftDeletes;

    public $table = 'posts';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'type',
        'title',
        'body',
        'youtube_link',
        'web_link',
        'web_link_title',
        'credit_link',
        'credit_title'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'    => 'integer',
        'type'  => 'string',
        'title' => 'string',
        'body'  => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
//        'title' => 'required',
//        'body' => 'required'
    ];

    public $with = [
        'superCategories',
        'tags',
        'languages',
        'foodCategories',
        'interests',
        'images'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function interests()
    {
        return $this->belongsToMany(\App\Models\Interest::class, 'interest_post');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function languages()
    {
        return $this->belongsToMany(\App\Models\Language::class, 'language_post');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function superCategories()
    {
        return $this->belongsToMany(\App\Models\SuperCategory::class, 'post_super_category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function tags()
    {
        return $this->belongsToMany(\App\Models\Tag::class, 'post_tag');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function foodCategories()
    {
        return $this->belongsToMany(\App\Models\FoodCategory::class, 'food_category_post');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
