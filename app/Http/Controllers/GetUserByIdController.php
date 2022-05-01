<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Core\WorkSign\Infrastructure\Rest\Controllers\User\GetUserByIdController as UserGetUserByIdController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;


class GetUserByIdController extends Controller
{
    /**
     * Constructor
     *
     * @param UserGetUserByIdController $coreGetUserByIdController
     */
    public function __construct(
        private UserGetUserByIdController $coreGetUserByIdController
    ) {
    }

    /**
     * Get user by id
     *
     * @param integer $id
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(int $id, Request $request): JsonResponse
    {
        try {
            $request->merge(['id' => $id]);
            $user = UserResource::make($this->coreGetUserByIdController->__invoke($request));

            return response()->json($user);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), $th->getCode() != 0 ? $th->getCode() : SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
