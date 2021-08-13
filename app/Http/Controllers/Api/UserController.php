<?php

namespace App\Http\Controllers\Api;

use App\Cache\UserCache;
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
     * repoUser
     *
     * @var mixed
     */
    private $repoUser;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct (UserCache $repoUser) {
        $this->repoUser = $repoUser;
    }

    /**
     * index
     *
     * List all users
     * @return void
     */
    public function index (Request $request) {
        $users = $this->repoUser->all($request);
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
        $user = new User($request->all());
        $user = $this->repoUser->save($user);
        $user->syncRoles($request->roles);
        return $this->success($user, Response::HTTP_CREATED);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $user
     * @return void
     */
    public function update (Request $request, User $user) {

    }
}
