<?php

namespace Core\WorkSign\Domain\User\ValueObjects;

use DateTime;
use InvalidArgumentException;

final class UserDeletedAt
{
    private DateTime $value;

    public function __construct(string $deleted_at)
    {
        try {
            $this->value = new DateTime($deleted_at);
        } catch (\Throwable $th) {
            throw new InvalidArgumentException(
                sprintf('%s does not allow the value %s', self::class, $deleted_at)
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
        return $this->value->format('Y-m-d H:i:s');
    }
}
