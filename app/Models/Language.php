<?php

namespace App\Models;

use App\User;
use Eloquent as Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Language
 * @package App\Models
 * @version August 24, 2019, 6:47 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection interests
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection posts
 * @property \Illuminate\Database\Eloquent\Collection tags
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property \Illuminate\Database\Eloquent\Collection
 * @property string name
 * @property string iso2
 * @property boolean active
 */
class Language extends Model
{
//    use SoftDeletes;

    public $table = 'languages';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'name',
        'iso2',
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
        'iso2' => 'string',
        'active' => 'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'iso2' => 'required',
        'active' => 'required'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function interests()
    {
        return $this->belongsToMany(\App\Models\Interest::class, 'interest_language');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function posts()
    {
        return $this->belongsToMany(\App\Models\Post::class, 'language_post');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function tags()
    {
        return $this->belongsToMany(\App\Models\Tag::class, 'language_tag');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     **/
    public function superCategories()
    {
        return $this->belongsToMany(\App\Models\SuperCategory::class, 'super_category_tag');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'language_user');
    }
}
