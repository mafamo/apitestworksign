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
     * @return boolean
     */
    public function __invoke(int $id): bool
    {
        $userId = new UserId($id);
        $this->repository->delete($userId);

        return true;
    }
}
