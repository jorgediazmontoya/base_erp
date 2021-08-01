<?php

namespace App\Http\Controllers\Api\Contracts;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;

interface IUserController
{
    /**
     * index
     *
     * List all users
     * @return void
     */
    public function index (Request $request);

    /**
     * show
     *
     * Get user by id
     * @return void
     */
    public function show (User $user);

    /**
     * store
     *
     * Create a new user
     * @param  mixed $request
     * @return void
     */
    public function store (StoreUserRequest $request);
}
