<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $fillable = ['path','type'];

    public function imageable()
    {
        return $this->morphTo();
    }

    public function getPathAttribute($value)
    {
        if($value === null) {
            return $value;
        }
        if(filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }
        return asset(Storage::url($value));
    }
}
