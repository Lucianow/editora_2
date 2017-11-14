<?php

namespace CodeEduUser\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeEduUser\Models\Role;
use CodePub\Validators\RolesValidator;

/**
 * Class RolesRepositoryEloquent
 * @package namespace CodePub\Repositories;
 */
class RolesRepositoryEloquent extends BaseRepository implements RolesRepository
{

    protected $fieldSearchable = [
        'name' => 'like',

    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
