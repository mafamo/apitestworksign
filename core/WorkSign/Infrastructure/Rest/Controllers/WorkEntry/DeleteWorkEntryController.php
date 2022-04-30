<?php

namespace Core\WorkSign\Infrastructure\Rest\Controllers\WorkEntry;

use Core\WorkSign\Application\UseCases\WorkEntry\DeleteWorkEntryUseCase;
use Core\WorkSign\Application\UseCases\WorkEntry\GetWorkEntryByIdUseCase;
use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class DeleteWorkEntryController
{
    public function __construct(
        private DeleteWorkEntryUseCase $deleteWorkEntryUseCase,
        private GetWorkEntryByIdUseCase $getWorkEntryByIdUseCase
    ) {
    }

    /**
     * Delete a WorkEntry
     *
     * @param Request $request
     * @return boolean
     */
    public function __invoke(Request $request): bool
    {
        try {
            if (!$request->has('id')) {
                throw new InvalidArgumentException('The id is mandatory');
            }
            $id = $request->input('id');
            $workEntryToUpdate = $this->getWorkEntryByIdUseCase->__invoke($id);
            if (!$workEntryToUpdate) {
                throw new Exception('The work entry not exists', SymfonyResponse::HTTP_NOT_FOUND);
            }

            return $this->deleteWorkEntryUseCase->__invoke($id);
        } catch (InvalidArgumentException $e) {
            throw new Exception($e->getMessage(), SymfonyResponse::HTTP_BAD_REQUEST);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), $th->getCode() ?? SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
