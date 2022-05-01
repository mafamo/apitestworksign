<?php

namespace App\Http\Controllers;

use App\Http\Resources\WorkEntryResource;
use Core\WorkSign\Infrastructure\Rest\Controllers\WorkEntry\UpdateWorkEntryController as WorkEntryUpdateWorkEntryController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class UpdateWorkEntryController extends Controller
{
    /**
     * Constructor
     *
     * @param WorkEntryUpdateWorkEntryController $coreUpdateWorkEntryController
     */
    public function __construct(
        private WorkEntryUpdateWorkEntryController $coreUpdateWorkEntryController
    ) {
    }

    /**
     * Update WorkEntry
     *
     * @param integer $id
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(int $id, Request $request): JsonResponse
    {
        try {
            $request->merge(['id' => $id]);
            $workEntry = $this->coreUpdateWorkEntryController->__invoke($request);

            return response()->json(WorkEntryResource::make($workEntry));
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), $th->getCode() != 0 ? $th->getCode() : SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
