<?php

namespace App\Http\Controllers;

use App\Http\Resources\WorkEntryResource;
use Core\WorkSign\Infrastructure\Rest\Controllers\WorkEntry\CreateWorkEntryController as WorkEntryCreateWorkEntryController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class CreateWorkEntryController extends Controller
{
    /**
     * Constructor
     *
     * @param WorkEntryCreateWorkEntryController $coreCreateWorkEntryController
     */
    public function __construct(
        private WorkEntryCreateWorkEntryController $coreCreateWorkEntryController
    ) {
    }

    /**
     * Create WorkEntry
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $newWorkEntry = WorkEntryResource::make($this->coreCreateWorkEntryController->__invoke($request));

            return response()->json($newWorkEntry, SymfonyResponse::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), $th->getCode() != 0 ? $th->getCode() : SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
