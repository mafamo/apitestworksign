<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Core\WorkSign\Infrastructure\Rest\Controllers\User\CreateUserController as UserCreateUserController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class CreateUserController extends Controller
{
    /**
     * Constructor
     *
     * @param UserCreateUserController $coreCreateUserController
     */
    public function __construct(
        private UserCreateUserController $coreCreateUserController
    ) {
    }

    /**
     * Create user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $newUser = UserResource::make($this->coreCreateUserController->__invoke($request));

            return response()->json($newUser, SymfonyResponse::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), $th->getCode() != 0 ? $th->getCode() : SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
