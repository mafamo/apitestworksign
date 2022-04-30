<?php

namespace Core\WorkSign\Application\UseCases\User;

use Core\WorkSign\Domain\User\Contracts\UserRepositoryInterface;
use Core\WorkSign\Domain\User\User;
use Core\WorkSign\Domain\User\ValueObjects\UserCreatedAt;
use Core\WorkSign\Domain\User\ValueObjects\UserDeletedAt;
use Core\WorkSign\Domain\User\ValueObjects\UserEmail;
use Core\WorkSign\Domain\User\ValueObjects\UserId;
use Core\WorkSign\Domain\User\ValueObjects\UserName;
use Core\WorkSign\Domain\User\ValueObjects\UserUpdatedAt;
use DateTime;

class UpdateUserUseCase
{

    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    /**
     * Update user
     *
     * @param string $name
     * @param string $email
     * @param integer $id
     * @return void
     */
    public function __invoke(
        string $name,
        string $email,
        int $id,
    ): void {
        $user = User::create(
            id: new UserId($id),
            name: new UserName($name),
            email: new UserEmail($email),
            created_at: new UserCreatedAt(),
            updated_at: new UserUpdatedAt((new DateTime())->format('Y-m-d H:i:s')),
            deleted_at: new UserDeletedAt()
        );
        $this->repository->update($user);
    }
}
