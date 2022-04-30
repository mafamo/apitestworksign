<?php

namespace Core\WorkSign\Infrastructure\Rest\Controllers\WorkEntry;

use Core\WorkSign\Application\UseCases\User\GetUserByIdUseCase;
use Core\WorkSign\Application\UseCases\WorkEntry\CreateWorkEntryUseCase;
use Core\WorkSign\Application\UseCases\WorkEntry\GetWorkEntryByIdUseCase;
use Core\WorkSign\Domain\WorkEntry\WorkEntry;
use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class CreateWorkEntryController
{
    public function __construct(
        private CreateWorkEntryUseCase $createWorkEntryUseCase,
        private GetWorkEntryByIdUseCase $getWorkEntryByIdUseCase,
        private GetUserByIdUseCase $getUserByIdUseCase
    ) {
    }

    /**
     * Create a WorkEntry
     *
     * @param Request $request
     * @return WorkEntry
     */
    public function __invoke(Request $request): WorkEntry
    {
        try {
            if (!$request->has('user_id')) {
                throw new InvalidArgumentException('The user id is mandatory');
            }
            $user_id = $request->input('user_id');
            $user = $this->getUserByIdUseCase->__invoke($user_id);
            if (!$user) {
                throw new Exception('The user not exists', SymfonyResponse::HTTP_NOT_FOUND);
            }
            if (!$request->has('start_date')) {
                throw new InvalidArgumentException('The start date is mandatory');
            }
            $start_date = $request->input('start_date');
            $end_date = $request->input('end_date');
            $workEntryId = $this->createWorkEntryUseCase->__invoke($user_id, $start_date, $end_date);

            return $this->getWorkEntryByIdUseCase->__invoke($workEntryId->value());
        } catch (InvalidArgumentException $e) {
            throw new Exception($e->getMessage(), SymfonyResponse::HTTP_BAD_REQUEST);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), $th->getCode() ?? SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
