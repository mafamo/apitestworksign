<?php

namespace Core\WorkSign\Domain\WorkEntry\ValueObjects;

use DateTime;
use InvalidArgumentException;

final class WorkEntryStartDate
{
    private DateTime $value;

    public function __construct(string $start_date)
    {
        try {
            $this->value = new DateTime($start_date);
        } catch (\Throwable $th) {
            throw new InvalidArgumentException(
                sprintf('%s does not allow the value %s', self::class, $start_date)
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
