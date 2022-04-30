<?php

namespace Core\WorkSign\Domain\User\Contracts;

use Core\WorkSign\Domain\User\User;
use Core\WorkSign\Domain\User\ValueObjects\UserId;

interface UserRepositoryContract
{
    /**
     * Get user by id
     *
     * @param UserId $id
     * @return User|null
     */
    public function get(UserId $id): ?User;

    /**
     * Get all Users
     *
     * @return array
     */
    public function getAll(): array;

    /**
     * Update a user
     *
     * @param User $user
     * @return boolean
     */
    public function update(User $user): bool;

    /**
     * Create a user
     *
     * @param User $user
     * @return boolean
     */
    public function create(User $user): bool;

    /**
     * Delete a user by id
     *
     * @param UserId $id
     * @return boolean
     */
    public function delete(UserId $id): bool;
}
