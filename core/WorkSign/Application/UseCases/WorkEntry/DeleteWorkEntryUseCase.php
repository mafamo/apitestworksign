<?php

namespace Core\WorkSign\Application\UseCases\WorkEntry;

use Core\WorkSign\Domain\WorkEntry\Contracts\WorkEntryRepositoryInterface;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryId;

class DeleteWorkEntryUseCase
{

    public function __construct(private WorkEntryRepositoryInterface $repository)
    {
    }

    /**
     * Delete a WorkEntry
     *
     * @param integer $id
     * @return void
     */
    public function __invoke(int $id): void
    {
        $workEntryId = new WorkEntryId($id);
        $this->repository->delete($workEntryId);
    }
}
