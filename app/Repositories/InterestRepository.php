<?php

namespace App\Repositories;

use App\Models\Interest;
use App\Repositories\BaseRepository;

/**
 * Class InterestRepository
 * @package App\Repositories
 * @version August 24, 2019, 6:50 am UTC
*/

class InterestRepository extends BaseRepository
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
        return Interest::class;
    }
}
