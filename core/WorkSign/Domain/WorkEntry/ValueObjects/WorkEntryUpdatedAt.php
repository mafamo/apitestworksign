<?php

namespace Core\WorkSign\Domain\WorkEntry\ValueObjects;

use DateTime;
use InvalidArgumentException;

final class WorkEntryUpdatedAt
{
    private DateTime $value;

    public function __construct(string $updated_at)
    {
        try {
            $this->value = new DateTime($updated_at);
        } catch (\Throwable $th) {
            throw new InvalidArgumentException(
                sprintf('%s does not allow the value %s', self::class, $updated_at)
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
