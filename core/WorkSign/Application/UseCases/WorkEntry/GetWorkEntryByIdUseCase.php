<?php

namespace Core\WorkSign\Application\UseCases\WorkEntry;


use Core\WorkSign\Domain\WorkEntry\Contracts\WorkEntryRepositoryInterface;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryId;
use Core\WorkSign\Domain\WorkEntry\WorkEntry;

class GetWorkEntryByIdUseCase
{

    public function __construct(private WorkEntryRepositoryInterface $repository)
    {
    }

    /**
     * Get a WorkEntry by id
     *
     * @param integer $id
     * @return WorkEntry|null
     */
    public function __invoke(int $id): ?WorkEntry
    {
        $workEntryId = new WorkEntryId($id);

        return $this->repository->get($workEntryId);
    }
}
