<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Repositories\BaseRepository;

/**
 * Class TagRepository
 * @package App\Repositories
 * @version August 24, 2019, 6:50 am UTC
*/

class TagRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'range',
        'active'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Tag::class;
    }
}
