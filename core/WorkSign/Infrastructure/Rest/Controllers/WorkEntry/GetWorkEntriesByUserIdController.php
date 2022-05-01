<?php

namespace Core\WorkSign\Infrastructure\Rest\Controllers\WorkEntry;

use Core\WorkSign\Application\UseCases\User\GetUserByIdUseCase;
use Core\WorkSign\Application\UseCases\WorkEntry\GetWorkEntriesByUserIdUseCase;
use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class GetWorkEntriesByUserIdController
{
    public function __construct(
        private GetWorkEntriesByUserIdUseCase $getWorkEntriesByUserIdUseCase,
        private GetUserByIdUseCase $getUserByIdUseCase
    ) {
    }

    /**
     * Get work entries by user id
     *
     * @param Request $request
     * @return array
     */
    public function __invoke(Request $request): array
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

            return $this->getWorkEntriesByUserIdUseCase->__invoke($user_id);
        } catch (InvalidArgumentException $e) {
            throw new Exception($e->getMessage(), SymfonyResponse::HTTP_BAD_REQUEST);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), $th->getCode() ?? SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
