<?php

namespace App\Http\Controllers\Api;

use App\Actions\Parent\ParentStoreAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ParentLoginRequest;
use App\Http\Requests\Api\ParentStoreRequest;
use App\Models\MParent;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class ParentsAuthController extends Controller
{

    /**
     * @param ParentStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(ParentStoreRequest $request)
    {
        try {
            $response = App::call(new ParentStoreAction($request->only(['name', 'email'])));
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }

        return $this->successResponse($response);
    }

    /**
     * @param ParentLoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(ParentLoginRequest $request)
    {
        $parent = MParent::where('email', $request->email)->first();

        if (!$parent) {
            return $this->errorResponse('Wrong Email !');
        }

        return $this->successResponse([
            'token' => $parent->createToken($parent->id)->plainTextToken,
        ]);
    }
}
