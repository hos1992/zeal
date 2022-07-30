<?php

namespace App\Http\Controllers\Api;

use App\Actions\Child\ChildDeleteAction;
use App\Actions\Child\ChildStoreAction;
use App\Actions\Child\ChildUpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ChildStoreRequest;
use App\Http\Requests\Api\ChildUpdateRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ChildrenController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return $this->successResponse([
            'children' => Auth::user()->children ?? []
        ]);
    }


    /**
     * @param ChildStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ChildStoreRequest $request)
    {
        try {
            $response = App::call(new ChildStoreAction($request->name));
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }

        return $this->successResponse($response);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $response = Auth::user()->children->where('id', $id)->first();
            if (!$response) {
                throw new \Exception("Wrong child id");
            }
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
        return $this->successResponse($response);
    }

    /**
     * @param ChildUpdateRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ChildUpdateRequest $request, $id)
    {
        try {
            $response = App::call(new ChildUpdateAction($request->only('name'), $id));
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }

        return $this->successResponse($response);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $response = App::call(new ChildDeleteAction($id));
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }

        return $this->successResponse($response);
    }
}
