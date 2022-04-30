<?php

namespace Core\WorkSign\Infrastructure\Rest\Controllers\User;

use Core\WorkSign\Application\UseCases\User\GetAllUsersUseCase;
use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class GetAllUsersController
{
    /**
     * Constructor
     *
     * @param GetAllUsersUseCase $getAllUsersUseCase
     */
    public function __construct(
        private GetAllUsersUseCase $getAllUsersUseCase
    ) {
    }

    /**
     * Get all users
     *
     * @param Request $request
     * @return array
     */
    public function __invoke(Request $request): array
    {
        try {
            return $this->getAllUsersUseCase->__invoke();
        } catch (InvalidArgumentException $e) {
            throw new Exception($e->getMessage(), SymfonyResponse::HTTP_BAD_REQUEST);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), $th->getCode() ?? SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
