<?php

namespace Core\WorkSign\Infrastructure\Rest\Controllers\WorkEntry;

use Core\WorkSign\Application\UseCases\WorkEntry\GetWorkEntryByIdUseCase;
use Core\WorkSign\Domain\WorkEntry\WorkEntry;
use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class GetWorkEntryByIdController
{
    public function __construct(
        private GetWorkEntryByIdUseCase $getWorkEntryByIdUseCase
    ) {
    }

    /**
     * Get a WorkEntry
     *
     * @param Request $request
     * @return WorkEntry
     */
    public function __invoke(Request $request): WorkEntry
    {
        try {
            if (!$request->has('id')) {
                throw new InvalidArgumentException('The id is mandatory');
            }
            $id = $request->input('id');
            $workEntry = $this->getWorkEntryByIdUseCase->__invoke($id);
            if (!$workEntry) {
                throw new Exception('The work entry not exists', SymfonyResponse::HTTP_NOT_FOUND);
            }

            return $workEntry;
        } catch (InvalidArgumentException $e) {
            throw new Exception($e->getMessage(), SymfonyResponse::HTTP_BAD_REQUEST);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), $th->getCode() ?? SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
