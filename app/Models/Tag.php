<?php

namespace App\Models;

use Eloquent as Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Tag
 * @package App\Models
 * @version August 24, 2019, 6:50 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection languages
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection posts
 * @property \Illuminate\Database\Eloquent\Collection 
 * @property \Illuminate\Database\Eloquent\Collection superCategories
 * @property string name
 * @property string range
 * @property boolean active
 */
class Tag extends Model
{
//    use SoftDeletes;

    public $table = 'tags';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'range',
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
        'range' => 'string',
        'active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'range' => 'required',
        'active' => 'required'
    ];

    public $with = [
        'languages',
        'superCategories',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function languages()
    {
        return $this->belongsToMany(\App\Models\Language::class, 'language_tag');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function posts()
    {
        return $this->belongsToMany(\App\Models\Post::class, 'post_tag');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function superCategories()
    {
        return $this->belongsToMany(\App\Models\SuperCategory::class, 'super_category_tag');
    }
}
