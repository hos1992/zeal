<?php

namespace App\Http\Controllers\Api;

use App\Actions\Parent\ParentAssignPartnerAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ParentAssignPartnerRequest;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ParentsController extends Controller
{
    /**
     * @param ParentAssignPartnerRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignPartner(ParentAssignPartnerRequest $request)
    {
        try {
            $response = App::call(new ParentAssignPartnerAction($request->email));
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }

        return $this->successResponse([
            'partner' => $response
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPartners()
    {
        return $this->successResponse([
            'partners' => Auth::user()->partners,
        ]);
    }
}
