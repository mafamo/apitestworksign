<?php

namespace Core\WorkSign\Application\UseCases\WorkEntry;

use Core\WorkSign\Domain\WorkEntry\Contracts\WorkEntryRepositoryInterface;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryUserId;

class GetWorkEntriesByUserIdUseCase
{

    public function __construct(private WorkEntryRepositoryInterface $repository)
    {
    }

    /**
     * Get the WorkEntries of an user
     *
     * @param integer $user_id
     * @return array
     */
    public function __invoke(int $user_id): array
    {
        $workEntryId = new WorkEntryUserId($user_id);

        return $this->repository->getWorkEntriesByUserId($workEntryId);
    }
}
