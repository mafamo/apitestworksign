<?php

namespace Core\WorkSign\Application\UseCases\User;

use Core\WorkSign\Domain\User\Contracts\UserRepositoryInterface;
use Core\WorkSign\Domain\User\ValueObjects\UserId;

class DeleteUserUseCase
{

    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    /**
     * Delete user
     *
     * @param integer $id
     * @return void
     */
    public function __invoke(int $id): void
    {
        $userId = new UserId($id);
        $this->repository->delete($userId);
    }
}
