<?php

namespace App\Http\Controllers\Api\Contracts;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

interface IPermissionController
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
     * @param  mixed $permission
     * @return void
     */
    public function show(Permission $permission);

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $permission
     * @return void
     */
    public function update(Request $request, Permission $permission);

    /**
     * destroy
     *
     * @param  mixed $permission
     * @return void
     */
    public function destroy(Permission $permission);
}
