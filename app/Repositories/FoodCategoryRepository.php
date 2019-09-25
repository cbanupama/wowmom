<?php

namespace App\Repositories;

use App\Models\FoodCategory;
use App\Repositories\BaseRepository;

/**
 * Class FoodCategoryRepository
 * @package App\Repositories
 * @version August 26, 2019, 8:48 am UTC
*/

class FoodCategoryRepository extends BaseRepository
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
        return FoodCategory::class;
    }
}
