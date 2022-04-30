<?php

namespace Core\WorkSign\Domain\WorkEntry\ValueObjects;

use DateTime;
use InvalidArgumentException;

final class WorkEntryEndDate
{
    private ?DateTime $value;

    public function __construct(?string $end_date)
    {
        try {
            $this->value = is_null($end_date) ? null : new DateTime($end_date);
        } catch (\Throwable $th) {
            throw new InvalidArgumentException(
                sprintf('%s does not allow the value %s', self::class, $end_date)
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
