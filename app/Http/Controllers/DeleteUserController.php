<?php

namespace App\Http\Controllers;

use Core\WorkSign\Infrastructure\Rest\Controllers\User\DeleteUserController as UserDeleteUserController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class DeleteUserController extends Controller
{
    /**
     * Constructor
     *
     * @param UserDeleteUserController $coreDeleteUserController
     */
    public function __construct(
        private UserDeleteUserController $coreDeleteUserController
    ) {
    }

    /**
     * Delete User
     *
     * @param integer $id
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(int $id, Request $request): JsonResponse
    {
        try {
            $request->merge(['id' => $id]);
            $result = $this->coreDeleteUserController->__invoke($request);

            return response()->json($result);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), $th->getCode() != 0 ? $th->getCode() : SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
