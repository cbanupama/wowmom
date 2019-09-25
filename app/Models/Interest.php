<?php

namespace App\Models;

use App\Image;
use Eloquent as Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Interest
 * @package App\Models
 * @version August 24, 2019, 6:50 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection languages
 * @property \Illuminate\Database\Eloquent\Collection posts
 * @property \Illuminate\Database\Eloquent\Collection superCategories
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property string name
 * @property boolean active
 */
class Interest extends Model
{
//    use SoftDeletes;

    public $table = 'interests';
    
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
        'superCategories',
        'images'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function languages()
    {
        return $this->belongsToMany(\App\Models\Language::class, 'interest_language');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function posts()
    {
        return $this->belongsToMany(\App\Models\Post::class, 'interest_post');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function superCategories()
    {
        return $this->belongsToMany(\App\Models\SuperCategory::class, 'interest_super_category');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
