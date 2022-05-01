<?php

namespace Core\WorkSign\Infrastructure\Rest\Controllers\WorkEntry;

use Core\WorkSign\Application\UseCases\User\GetUserByIdUseCase;
use Core\WorkSign\Application\UseCases\WorkEntry\GetWorkEntryByIdUseCase;
use Core\WorkSign\Application\UseCases\WorkEntry\UpdateWorkEntryUseCase;
use Core\WorkSign\Domain\WorkEntry\WorkEntry;
use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UpdateWorkEntryController
{
    public function __construct(
        private UpdateWorkEntryUseCase $updateWorkEntryUseCase,
        private GetWorkEntryByIdUseCase $getWorkEntryByIdUseCase,
        private GetUserByIdUseCase $getUserByIdUseCase
    ) {
    }

    /**
     * Update a WorkEntry
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
            $workEntryToUpdate = $this->getWorkEntryByIdUseCase->__invoke($id);
            if (!$workEntryToUpdate) {
                throw new Exception('The work entry not exists', SymfonyResponse::HTTP_NOT_FOUND);
            }
            $user_id = $request->input('user_id') ?? $workEntryToUpdate->userId()?->value();
            if (!$user_id) {
                $user = $this->getUserByIdUseCase->__invoke($user_id);
                if (!$user) {
                    throw new Exception('The user not exists', SymfonyResponse::HTTP_NOT_FOUND);
                }
            }
            $start_date = $request->input('start_date') ?? $workEntryToUpdate->startDate()?->value();
            $end_date = $request->input('end_date') ?? $workEntryToUpdate->endDate()?->value();
            $this->updateWorkEntryUseCase->__invoke($id, $user_id, $start_date, $end_date);

            return $this->getWorkEntryByIdUseCase->__invoke($id);
        } catch (InvalidArgumentException $e) {
            throw new Exception($e->getMessage(), SymfonyResponse::HTTP_BAD_REQUEST);
        } catch (NotFoundHttpException $e) {
            throw new Exception($e->getMessage(), SymfonyResponse::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), $th->getCode() ?? SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
