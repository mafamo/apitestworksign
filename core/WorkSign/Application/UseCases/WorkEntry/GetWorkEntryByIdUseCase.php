<?php

namespace Core\WorkSign\Application\UseCases\WorkEntry;

use App\Models\WorkEntry;
use Core\WorkSign\Domain\WorkEntry\Contracts\WorkEntryRepositoryInterface;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryId;

class GetWorkEntryByIdUseCase
{

    public function __construct(private WorkEntryRepositoryInterface $repository)
    {
    }

    /**
     * Get a WorkEntry by id
     *
     * @param integer $id
     * @return ?WorkEntry
     */
    public function __invoke(int $id): ?WorkEntry
    {
        $workEntryId = new WorkEntryId($id);

        return $this->repository->get($workEntryId);
    }
}
