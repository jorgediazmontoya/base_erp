<?php

namespace App\Http\Controllers\Api;

use App\Models\File;
use App\Traits\RestResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File as FileFacade;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Api\Contracts\IFileController;

class FileController extends Controller implements IFileController
{

    use RestResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        return $this->success(File::orderBy('id', 'desc')->simplePaginate($request->size ?: 10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $rules = ['file' => 'required'];

        $this->validate($request, $rules);

        if($request->file()) {
            $name = time() . '_' . $request->file->getClientOriginalName();
            Storage::put($name, FileFacade::get($request->file('file')));

            $attr = new File();
            $attr->name = $name;
            $attr->url = $name;
            $attr->save();

            return $this->success($attr, Response::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(File $file) {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file) {
        //
    }
}
