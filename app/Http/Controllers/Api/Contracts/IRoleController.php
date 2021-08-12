<?php

namespace App\Http\Controllers\Api\Contracts;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

interface IRoleController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request);

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request);

    /**
     * show
     *
     * @param  mixed $role
     * @return void
     */
    public function show(Role $role);

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $role
     * @return void
     */
    public function update(Request $request, Role $role);

    /**
     * destroy
     *
     * @param  mixed $role
     * @return void
     */
    public function destroy(Role $role);
}
