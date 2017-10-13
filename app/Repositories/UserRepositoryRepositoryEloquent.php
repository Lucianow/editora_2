<?php

namespace CodePub\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodePub\Repositories\UserRepositoryRepository;
use CodePub\Models\User;
use CodePub\Validators\UserRepositoryValidator;

/**
 * Class UserRepositoryRepositoryEloquent
 * @package namespace CodePub\Repositories;
 */
class UserRepositoryRepositoryEloquent extends BaseRepository implements UserRepositoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
