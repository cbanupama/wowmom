<?php

namespace App\Repositories;

use App\Models\SuperCategory;
use App\Repositories\BaseRepository;

/**
 * Class SuperCategoryRepository
 * @package App\Repositories
 * @version August 24, 2019, 6:49 am UTC
*/

class SuperCategoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
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
        return SuperCategory::class;
    }
}
