<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Core\WorkSign\Infrastructure\Rest\Controllers\User\GetAllUsersController as UserGetAllUsersController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;


class GetAllUsersController extends Controller
{
    /**
     * Constructor
     *
     * @param UserGetAllUsersController $coreGetAllUsersController
     */
    public function __construct(
        private UserGetAllUsersController $coreGetAllUsersController
    ) {
    }

    /**
     * Get all users
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $users = $this->coreGetAllUsersController->__invoke($request);

            return response()->json(UserResource::collection($users));
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), $th->getCode() != 0 ? $th->getCode() : SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
