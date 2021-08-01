<?php

namespace App\Http\Controllers\Api;

use App\Models\CustomTenant;
use App\Traits\RestResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Exceptions\Custom\UnprocessableException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Controllers\Api\Contracts\ITenantController;

class TenantController extends Controller implements ITenantController
{

    use RestResponse;

    private $domain;

    public function __construct() {
        $this->domain = \parse_url(config('app.url'), PHP_URL_HOST);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $tenant = CustomTenant::where('domain', '<>', $this->domain)
            ->orderBy('id', 'desc')
            ->simplePaginate(10);

        return $this->success($tenant);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $rules = [
            'name' => ['required', 'unique:landlord.tenants', 'max:255'],
            'domain' => ['required', 'unique:landlord.tenants', 'max:255'],
        ];

        $request->validate($rules);

        $tenant = CustomTenant::create($request->all());

        return $this->success($tenant, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CustomTenant $tenant) {
        $tenant_main = CustomTenant::where('domain', $this->domain)->first();

        if ($tenant->id == $tenant_main->id)
            throw new ModelNotFoundException();

        return $this->success($tenant, Response::HTTP_FOUND);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tenant) {
        $rules = [
            'name' => 'unique:landlord.tenants,name,'.$tenant,
            'domain' => 'unique:landlord.tenants,domain,'.$tenant,
        ];

        $this->validate($request, $rules);

        $tenant = CustomTenant::findOrFail($tenant);

        $tenant->fill($request->all());

        if ($tenant->isClean())
            throw new UnprocessableException(__('messages.nochange'));

        $tenant->save();

        return $this->success($tenant);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomTenant $tenant) {
        $tenant_main = CustomTenant::where('domain', $this->domain)->first();

        if ($tenant->id == $tenant_main->id)
            throw new ModelNotFoundException();

        $tenant->delete();
        return $this->success($tenant);
    }
}
