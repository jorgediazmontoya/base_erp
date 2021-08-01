<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Traits\RestResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Controllers\Api\Contracts\IUserController;

class UserController extends Controller implements IUserController
{
    use RestResponse;

    /**
     * index
     *
     * List all users
     * @return void
     */
    public function index (Request $request) {
        $sort = $request->sort ?: 'id';
        $type_sort = $request->type_sort ?: 'desc';

        $users = User::orderBy($sort, $type_sort)
            ->simplePaginate(7);

        return $this->success($users);
    }

    /**
     * show
     *
     * User by :id
     * @param  mixed $user
     * @return void
     */
    public function show (User $user) {
        return $this->success($user, Response::HTTP_FOUND);
    }

    /**
     * store
     *
     * Add new user
     * @param  mixed $request
     * @return void
     */
    public function store (StoreUserRequest $request) {
        $user = User::create($request->all());
        return $this->success($user, Response::HTTP_CREATED);
    }
}
