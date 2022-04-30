<?php

namespace Core\WorkSign\Domain\WorkEntry\ValueObjects;

use InvalidArgumentException;

final class WorkEntryUserId
{
    private int $value;

    public function __construct(private int $user_id)
    {
        $this->validate($user_id);
        $this->value = $user_id;
    }

    /**
     * Validate value
     *
     * @param integer $id
     * @return void
     */
    private function validate(int $user_id): void
    {
        $options = [
            'options' => [
                'min_range' => 1
            ]
        ];

        if (!filter_var($user_id, FILTER_VALIDATE_INT, $options)) {
            throw new InvalidArgumentException(
                sprintf('%s does not allow the value %s', self::class, $user_id)
            );
        }
    }

    /**
     * Get Value
     *
     * @return integer
     */
    public function value(): int
    {
        return $this->value;
    }
}
