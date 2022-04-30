<?php

namespace Core\WorkSign\Infrastructure\Rest\Controllers\User;

use Core\WorkSign\Application\UseCases\User\CreateUserUseCase;
use Core\WorkSign\Application\UseCases\User\GetUserByIdUseCase;
use Core\WorkSign\Domain\User\User;
use Exception;
use Illuminate\Http\Request;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class CreateUserController
{
    /**
     * Constructor
     *
     * @param CreateUserUseCase $createUserUseCase
     * @param GetUserByIdUseCase $getUserByIdUseCase
     */
    public function __construct(
        private CreateUserUseCase $createUserUseCase,
        private GetUserByIdUseCase $getUserByIdUseCase
    ) {
    }

    /**
     * Create a user
     *
     * @param Request $request
     * @return User
     */
    public function __invoke(Request $request): User
    {
        try {
            if (!$request->has('name')) {
                throw new InvalidArgumentException('The name is mandatory');
            }
            $name = $request->input('name');
            if (!$request->has('email')) {
                throw new InvalidArgumentException('The email is mandatory');
            }
            $email = $request->input('email');
            $userId = $this->createUserUseCase->__invoke($name, $email);

            return $this->getUserByIdUseCase->__invoke($userId->value());
        } catch (InvalidArgumentException $e) {
            throw new Exception($e->getMessage(), SymfonyResponse::HTTP_BAD_REQUEST);
        } catch (\Throwable $th) {
            throw new Exception($th->getMessage(), $th->getCode() ?? SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
