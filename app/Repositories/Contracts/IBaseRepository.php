<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface IBaseRepository
{
    /**
     * all
     *
     * @param  mixed $request
     * @return void
     */
    public function all($request);

    /**
     * save
     *
     * @param  mixed $model
     * @return void
     */
    public function save(Model $model);
}
