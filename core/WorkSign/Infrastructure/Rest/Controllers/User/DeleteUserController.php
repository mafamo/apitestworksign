<?php

namespace Core\WorkSign\Infrastructure\Rest\Controllers\User;

use Core\WorkSign\Application\UseCases\User\DeleteUserUseCase;
use Core\WorkSign\Application\UseCases\User\GetUserByIdUseCase;
use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class DeleteUserController
{
    /**
     * Constructor
     *
     * @param DeleteUserUseCase $deleteUserUseCase
     * @param GetUserByIdUseCase $getUserByIdUseCase
     */
    public function __construct(
        private DeleteUserUseCase $deleteUserUseCase,
        private GetUserByIdUseCase $getUserByIdUseCase
    ) {
    }

    /**
     * Delete a user
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
            $userToDelete = $this->getUserByIdUseCase->__invoke($id);
            if (!$userToDelete) {
                throw new Exception('The user not exists', SymfonyResponse::HTTP_NOT_FOUND);
            }

            return $this->deleteUserUseCase->__invoke($id);
        } catch (InvalidArgumentException $e) {
            throw new Exception($e->getMessage(), SymfonyResponse::HTTP_BAD_REQUEST);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), $th->getCode() ?? SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
