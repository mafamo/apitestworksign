<?php

namespace Core\WorkSign\Infrastructure\Rest\Controllers\User;

use Core\WorkSign\Application\UseCases\User\GetUserByIdUseCase;
use Core\WorkSign\Application\UseCases\User\UpdateUserUseCase;
use Core\WorkSign\Domain\User\User;
use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UpdateUserController
{
    /**
     * Constructor
     *
     * @param UpdateUserUseCase $updateUserUseCase
     * @param GetUserByIdUseCase $getUserByIdUseCase
     */
    public function __construct(
        private UpdateUserUseCase $updateUserUseCase,
        private GetUserByIdUseCase $getUserByIdUseCase
    ) {
    }

    /**
     * Update a user
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
            $userToUpdate = $this->getUserByIdUseCase->__invoke($id);
            if (!$userToUpdate) {
                throw new NotFoundHttpException('The user not exists');
            }
            $userName = $request->input('name') ?? $userToUpdate->name()->value();
            $userEmail = $request->input('email') ?? $userToUpdate->email()->value();
            $this->updateUserUseCase->__invoke($userName, $userEmail, $id);

            return $this->getUserByIdUseCase->__invoke($id);
        } catch (InvalidArgumentException $e) {
            throw new Exception($e->getMessage(), SymfonyResponse::HTTP_BAD_REQUEST);
        } catch (NotFoundHttpException $e) {
            throw new Exception($e->getMessage(), SymfonyResponse::HTTP_NOT_FOUND);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), $th->getCode() ?? SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
