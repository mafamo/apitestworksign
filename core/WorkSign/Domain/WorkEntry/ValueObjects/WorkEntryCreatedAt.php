<?php

namespace Core\WorkSign\Domain\WorkEntry\ValueObjects;

use DateTime;
use InvalidArgumentException;

final class WorkEntryCreatedAt
{
    private ?DateTime $value;

    public function __construct(?string $created_at)
    {
        try {
            $this->value = is_null($created_at) ? null : new DateTime($created_at);
        } catch (\Throwable $th) {
            throw new InvalidArgumentException(
                sprintf('%s does not allow the value %s', self::class, $created_at)
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
