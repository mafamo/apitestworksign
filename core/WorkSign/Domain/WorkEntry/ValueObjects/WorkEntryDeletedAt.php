<?php

namespace Core\WorkSign\Domain\WorkEntry\ValueObjects;

use DateTime;
use InvalidArgumentException;

final class WorkEntryDeletedAt
{
    private ?DateTime $value;

    public function __construct(?string $deleted_at = null)
    {
        try {
            $this->value = is_null($deleted_at) ? null : new DateTime($deleted_at);
        } catch (\Throwable $th) {
            throw new InvalidArgumentException(
                sprintf('%s does not allow the value %s', self::class, $deleted_at)
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
