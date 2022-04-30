<?php

namespace Core\WorkSign\Domain\User\ValueObjects;

use DateTime;
use InvalidArgumentException;

final class UserUpdatedAt
{
    private ?DateTime $value;

    public function __construct(?string $updated_at = null)
    {
        try {
            $this->value = is_null($updated_at) ? null : new DateTime($updated_at);
        } catch (\Throwable $th) {
            throw new InvalidArgumentException(
                sprintf('%s does not allow the value %s', self::class, $updated_at)
            );
        }
    }

    /**
     * Get Value
     *
     * @return string|null
     */
    public function value(): ?string
    {
        return $this->value?->format('Y-m-d H:i:s');
    }
}
