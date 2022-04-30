<?php

namespace Core\WorkSign\Domain\User;

use Core\WorkSign\Domain\User\ValueObjects\UserCreatedAt;
use Core\WorkSign\Domain\User\ValueObjects\UserDeletedAt;
use Core\WorkSign\Domain\User\ValueObjects\UserEmail;
use Core\WorkSign\Domain\User\ValueObjects\UserId;
use Core\WorkSign\Domain\User\ValueObjects\UserName;
use Core\WorkSign\Domain\User\ValueObjects\UserUpdatedAt;

class User
{

    /**
     * Constructor
     *
     * @param UserId $id
     * @param UserName $name
     * @param UserEmail $email
     * @param UserCreatedAt $created_at
     * @param UserUpdatedAt|null $updated_at
     * @param UserDeletedAt|null $deleted_at
     */
    public function __construct(
        private UserId $id,
        private UserName $name,
        private UserEmail $email,
        private UserCreatedAt $created_at,
        private ?UserUpdatedAt $updated_at,
        private ?UserDeletedAt $deleted_at
    ) {
    }

    /**
     * Get Id
     *
     * @return UserId
     */
    public function id(): UserId
    {
        return $this->id;
    }

    /**
     * Get Name
     *
     * @return UserName
     */
    public function name(): UserName
    {
        return $this->name;
    }

    /**
     * Get Email
     *
     * @return UserEmail
     */
    public function email(): UserEmail
    {
        return $this->email;
    }

    /**
     * Get Created At
     *
     * @return UserCreatedAt
     */
    public function createdAt(): UserCreatedAt
    {
        return $this->created_at;
    }

    /**
     * Get Updated At
     *
     * @return UserUpdatedAt|null
     */
    public function updatedAt(): ?UserUpdatedAt
    {
        return $this->updated_at;
    }

    /**
     * Get Deleted At
     *
     * @return UserDeletedAt|null
     */
    public function deletedAt(): ?UserDeletedAt
    {
        return $this->deleted_at;
    }

    /**
     * Create User
     *
     * @param UserId $id
     * @param UserName $name
     * @param UserEmail $email
     * @param UserCreatedAt $created_at
     * @param UserUpdatedAt|null $updated_at
     * @param UserDeletedAt|null $deleted_at
     * @return User
     */
    public static function create(
        UserId $id,
        UserName $name,
        UserEmail $email,
        UserCreatedAt $created_at,
        UserUpdatedAt $updated_at = null,
        UserDeletedAt $deleted_at = null
    ): User {
        return new self(
            id: $id,
            name: $name,
            email: $email,
            created_at: $created_at,
            updated_at: $updated_at,
            deleted_at: $deleted_at
        );
    }
}
