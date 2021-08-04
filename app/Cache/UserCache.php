<?php

namespace App\Cache;

use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;

class UserCache extends BaseCache {

    /**
     * __construct
     *
     * @return void
     */
    public function __construct(UserRepository $userRepository) {
        parent::__construct($userRepository, 'user');
    }

    /**
     * all
     *
     * @param  mixed $request
     * @return void
     */
    public function all($request)
    {
        //$this->cache::forget($this->key);
        return $this->cache::remember($this->key, self::TTL, function () use ($request) {
            return $this->repository->all($request);
        });
    }

    /**
     * save
     *
     * @param  mixed $model
     * @return void
     */
    public function save(Model $model)
    {
        $this->cache::forget($this->key);
        $this->repository->save($model);
    }
}
