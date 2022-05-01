<?php

namespace App\Http\Controllers;

use App\Http\Resources\WorkEntryResource;
use Core\WorkSign\Infrastructure\Rest\Controllers\WorkEntry\GetWorkEntriesByUserIdController as WorkEntryGetWorkEntriesByUserIdController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class GetWorkEntriesByUserIdController extends Controller
{
    /**
     * Constructor
     *
     * @param WorkEntryGetWorkEntriesByUserIdController $coreGetWorkEntriesByUserIdController
     */
    public function __construct(
        private WorkEntryGetWorkEntriesByUserIdController $coreGetWorkEntriesByUserIdController
    ) {
    }

    /**
     * Get Work Entries by user id
     *
     * @param integer $user_id
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(int $user_id, Request $request): JsonResponse
    {
        try {
            $request->merge(['user_id' => $user_id]);
            $workEntries = $this->coreGetWorkEntriesByUserIdController->__invoke($request);

            return response()->json(WorkEntryResource::collection($workEntries));
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), $th->getCode() != 0 ? $th->getCode() : SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
