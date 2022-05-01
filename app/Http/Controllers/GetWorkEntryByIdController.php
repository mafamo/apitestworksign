<?php

namespace App\Http\Controllers;

use App\Http\Resources\WorkEntryResource;
use Core\WorkSign\Infrastructure\Rest\Controllers\WorkEntry\GetWorkEntryByIdController as WorkEntryGetWorkEntryByIdController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class GetWorkEntryByIdController extends Controller
{
    /**
     * Constructor
     *
     * @param WorkEntryGetWorkEntryByIdController $coreGetWorkEntryByIdController
     */
    public function __construct(
        private WorkEntryGetWorkEntryByIdController $coreGetWorkEntryByIdController
    ) {
    }

    /**
     * Get WorkEntry by id
     *
     * @param integer $id
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(int $id, Request $request): JsonResponse
    {
        try {
            $request->merge(['id' => $id]);
            $workEntry = $this->coreGetWorkEntryByIdController->__invoke($request);

            return response()->json(WorkEntryResource::make($workEntry));
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), $th->getCode() != 0 ? $th->getCode() : SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
