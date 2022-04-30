<?php

namespace Core\WorkSign\Infrastructure\Rest\Controllers\User;

use Core\WorkSign\Application\UseCases\User\GetUserByIdUseCase;
use Core\WorkSign\Domain\User\User;
use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class GetUserByIdController
{
    /**
     * Constructor
     *
     * @param GetUserByIdUseCase $getUserByIdUseCase
     */
    public function __construct(
        private GetUserByIdUseCase $getUserByIdUseCase
    ) {
    }

    /**
     * Get a user by id
     *
     * @param Request $request
     * @return User
     */
    public function __invoke(Request $request): User
    {
        try {
            if (!$request->has('id')) {
                throw new InvalidArgumentException('The id is mandatory');
            }
            $id = $request->input('id');
            $user = $this->getUserByIdUseCase->__invoke($id);
            if (!$user) {
                throw new Exception('The user not exists', SymfonyResponse::HTTP_NOT_FOUND);
            }

            return $user;
        } catch (InvalidArgumentException $e) {
            throw new Exception($e->getMessage(), SymfonyResponse::HTTP_BAD_REQUEST);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), $th->getCode() ?? SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
