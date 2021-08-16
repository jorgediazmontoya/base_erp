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
        parent::__construct($userRepository);
    }

    /**
     * all
     *
     * @param  mixed $request
     * @return void
     */
    public function all($request)
    {
        return $this->cache::remember($this->key, now()->addMinutes(150), function () use ($request) {
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
        $this->cache::flush();
        return $this->repository->save($model);
    }
}
