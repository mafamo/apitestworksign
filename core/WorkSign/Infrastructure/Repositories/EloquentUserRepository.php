<?php

namespace Core\WorkSign\Infrastructure\Repositories;

use App\Models\User as EloquentUserModel;
use Core\WorkSign\Domain\User\Contracts\UserRepositoryInterface;
use Core\WorkSign\Domain\User\User;
use Core\WorkSign\Domain\User\ValueObjects\UserCreatedAt;
use Core\WorkSign\Domain\User\ValueObjects\UserDeletedAt;
use Core\WorkSign\Domain\User\ValueObjects\UserEmail;
use Core\WorkSign\Domain\User\ValueObjects\UserId;
use Core\WorkSign\Domain\User\ValueObjects\UserName;
use Core\WorkSign\Domain\User\ValueObjects\UserUpdatedAt;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function __construct(
        private EloquentUserModel $eloquentUserModel
    ) {
    }

    /**
     * @inheritDoc
     */
    public function get(UserId $id): ?User
    {
        $userEloquent = $this->eloquentUserModel->find($id->value());

        return User::create(
            id: new UserId($userEloquent->id),
            name: new UserName($userEloquent->name),
            email: new UserEmail($userEloquent->email),
            created_at: new UserCreatedAt($userEloquent->created_at?->format('Y-m-d H:i:s')),
            updated_at: new UserUpdatedAt($userEloquent->updated_at?->format('Y-m-d H:i:s')),
            deleted_at: new UserDeletedAt($userEloquent->created_at?->format('Y-m-d H:i:s'))
        );
    }

    /**
     * @inheritDoc
     */
    public function getAll(): array
    {
        $result = [];
        $userCollectionEloquent = $this->eloquentUserModel->all()->toArray();
        foreach ($userCollectionEloquent as $userEloquent) {
            $result[] = User::create(
                id: new UserId($userEloquent->id),
                name: new UserName($userEloquent->name),
                email: new UserEmail($userEloquent->email),
                created_at: new UserCreatedAt($userEloquent->created_at?->format('Y-m-d H:i:s')),
                updated_at: new UserUpdatedAt($userEloquent->updated_at?->format('Y-m-d H:i:s')),
                deleted_at: new UserDeletedAt($userEloquent->created_at?->format('Y-m-d H:i:s'))
            );
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function update(User $user): bool
    {
        $eloquentUserToUpdate = $this->eloquentUserModel;
        $data = [
            'name' => $user->name()->value(),
            'email' => $user->email()->value(),
            'updated_at' => $user->updatedAt()->value()
        ];
        $eloquentUserToUpdate->findOrFail($user->id()->value())->update($data);

        return true;
    }

    /**
     * @inheritDoc
     */
    public function create(User $user): UserId
    {
        $eloquentUserNew = $this->eloquentUserModel;
        $data = [
            'name' => $user->name()->value(),
            'email' => $user->email()->value(),
            'created_at' => $user->updatedAt()->value(),
            'updated_at' => $user->updatedAt()->value()
        ];
        $eloquentUserNew->create($data);

        return new UserId($eloquentUserNew->id);
    }

    /**
     * @inheritDoc
     */
    public function delete(UserId $id): bool
    {
        $eloquentUserModelToDelete = $this->eloquentUserModel->findOrFail($id->value());
        $eloquentUserModelToDelete->delete();

        return true;
    }
}
