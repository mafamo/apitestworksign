<?php

namespace Core\WorkSign\Application\UseCases\User;

use Core\WorkSign\Domain\User\Contracts\UserRepositoryInterface;

class GetAllUsersUseCase
{

    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    /**
     * Get all users
     *
     * @return array
     */
    public function __invoke(): array
    {
        return $this->repository->getAll();
    }
}
