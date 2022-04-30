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

class CreateUserUseCase
{

    public function __construct(private UserRepositoryInterface $repository)
    {
    }

    /**
     * Create user
     *
     * @param string $name
     * @param string $email
     * @return void
     */
    public function __invoke(
        string $name,
        string $email,
    ): void {
        $user = User::create(
            id: new UserId(),
            name: new UserName($name),
            email: new UserEmail($email),
            created_at: new UserCreatedAt((new DateTime())->format('Y-m-d H:i:s')),
            updated_at: new UserUpdatedAt((new DateTime())->format('Y-m-d H:i:s')),
            deleted_at: new UserDeletedAt()
        );
        $this->repository->create($user);
    }
}
