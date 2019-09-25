<?php

namespace App\Repositories;

use App\Models\Profile;
use App\Repositories\BaseRepository;

/**
 * Class ProfileRepository
 * @package App\Repositories
 * @version August 28, 2019, 5:35 pm UTC
*/

class ProfileRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'date_of_birth',
        'due_date',
        'last_period_date',
        'phone',
        'photo',
        'gender'
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
        return Profile::class;
    }
}
