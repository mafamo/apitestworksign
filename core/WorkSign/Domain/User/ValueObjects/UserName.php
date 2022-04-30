<?php

namespace Core\WorkSign\Domain\User\ValueObjects;

final class UserName
{
    private string $value;

    public function __construct(string $name)
    {
        $this->value = $name;
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
