<?php

namespace App\Http\Controllers;

use Core\WorkSign\Infrastructure\Rest\Controllers\WorkEntry\DeleteWorkEntryController as WorkEntryDeleteWorkEntryController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class DeleteWorkEntryController extends Controller
{
    /**
     * Constructor
     *
     * @param WorkEntryDeleteWorkEntryController $coreDeleteWorkEntryController
     */
    public function __construct(
        private WorkEntryDeleteWorkEntryController $coreDeleteWorkEntryController
    ) {
    }

    /**
     * Delete WorkEntry
     *
     * @param integer $id
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(int $id, Request $request): JsonResponse
    {
        try {
            $request->merge(['id' => $id]);
            $result = $this->coreDeleteWorkEntryController->__invoke($request);

            return response()->json($result);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), $th->getCode() != 0 ? $th->getCode() : SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
