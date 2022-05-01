<?php

namespace Core\WorkSign\Domain\User\ValueObjects;

use InvalidArgumentException;

final class UserEmail
{
    private string $value;

    public function __construct(string $email)
    {
        $this->validate($email);
        $this->value = $email;
    }

    /**
     * Validate value
     *
     * @param string $email
     * @return void
     */
    private function validate(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(
                sprintf('%s does not allow the value %s', self::class, $email)
            );
        }
    }

    /**
     * Get Value
     *
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}
