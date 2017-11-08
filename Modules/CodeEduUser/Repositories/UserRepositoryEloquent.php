<?php

namespace CodeEduUser\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeEduUser\Repositories\UserRepository;
use CodeEduUser\Models\User;
use CodePub\Validators\UserRepositoryValidator;

/**
 * Class UserRepositoryEloquent
 * @package namespace CodePub\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{

    public function create(array $attributes)
    {
        $attributes['password'] = User::generatePassword();
        $model = parent::create($attributes);
        \UserVerification::generate($model);
        $subject = config('codeeduuser.email.user_created.subject');
        \UserVerification::emailView('codeeduuser::emails.user-created');
        \UserVerification::send($model, $subject);
        return $model;
    }

    public function update(array $attributes, $id)
    {
        if (isset($attributes['password'])){
            $attributes['password'] = User::generatePassword($attributes['password']);
        }
        return parent::update($attributes, $id);
    }


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
