<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Core\WorkSign\Infrastructure\Rest\Controllers\User\UpdateUserController as UserUpdateUserController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;


class UpdateUserController extends Controller
{
    /**
     * Constructor
     *
     * @param UserUpdateUserController $coreUpdateUserController
     */
    public function __construct(
        private UserUpdateUserController $coreUpdateUserController
    ) {
    }

    /**
     * Update user
     *
     * @param integer $id
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(int $id, Request $request): JsonResponse
    {
        try {
            $request->merge(['id' => $id]);
            $user = UserResource::make($this->coreUpdateUserController->__invoke($request));

            return response()->json($user);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), $th->getCode() != 0 ? $th->getCode() : SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
