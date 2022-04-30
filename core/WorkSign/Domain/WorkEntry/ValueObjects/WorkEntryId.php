<?php

namespace Core\WorkSign\Domain\WorkEntry\ValueObjects;

use InvalidArgumentException;

final class WorkEntryId
{
    private ?int $value;

    public function __construct(?int $id)
    {
        if (!is_null($id)) {
            $this->validate($id);
            $this->value = $id;
        }
    }

    /**
     * Validate value
     *
     * @param integer $id
     * @return void
     */
    private function validate(int $id): void
    {
        $options = [
            'options' => [
                'min_range' => 1
            ]
        ];

        if (!filter_var($id, FILTER_VALIDATE_INT, $options)) {
            throw new InvalidArgumentException(
                sprintf('%s does not allow the value %s', self::class, $id)
            );
        }
    }

    /**
     * Get Value
     *
     * @return integer|null
     */
    public function value(): ?int
    {
        return $this->value;
    }
}
