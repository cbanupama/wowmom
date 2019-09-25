<?php


namespace App\Traits;


use App\Image;

trait UploadImage
{
    public function uploadImage($input, $model, $type)
    {
        if (isset($input['images']) && count($input['images'])) {
            foreach ($input['images'] as $image) {
                $path = $image->store('public/' . $type);
                $img = new Image(['path' => $path, 'type' => $type]);
                $model->images()->save($img);
            }
        }
    }
}