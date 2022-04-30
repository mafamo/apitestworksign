<?php

namespace Core\WorkSign\Application\UseCases\User;

use Core\WorkSign\Domain\User\Contracts\UserRepositoryInterface;
use Core\WorkSign\Domain\User\User;
use Core\WorkSign\Domain\User\ValueObjects\UserId;

class GetUserByIdUseCase
{

    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    /**
     * Get user by id
     *
     * @param integer $id
     * @return User|null
     */
    public function __invoke(int $id): ?User
    {
        $userId = new UserId($id);
        return $this->repository->get($userId);
    }
}
