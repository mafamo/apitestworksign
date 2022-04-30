<?php

namespace Core\WorkSign\Application\UseCases\WorkEntry;

use Core\WorkSign\Domain\WorkEntry\Contracts\WorkEntryRepositoryInterface;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryCreatedAt;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryDeletedAt;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryEndDate;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryId;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryStartDate;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryUpdatedAt;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryUserId;
use Core\WorkSign\Domain\WorkEntry\WorkEntry;
use DateTime;

class UpdateWorkEntryUseCase
{

    public function __construct(private WorkEntryRepositoryInterface $repository)
    {
    }

    /**
     * Update a WorkEntry
     *
     * @param integer $id
     * @param integer $user_id
     * @param string $start_date
     * @param string|null $end_date
     * @return void
     */
    public function __invoke(
        int $id,
        int $user_id,
        string $start_date,
        ?string $end_date = null
    ): void {
        $workEntry = WorkEntry::create(
            id: new WorkEntryId($id),
            user_id: new WorkEntryUserId($user_id),
            start_date: new WorkEntryStartDate($start_date),
            end_date: new WorkEntryEndDate($end_date),
            created_at: new WorkEntryCreatedAt(),
            updated_at: new WorkEntryUpdatedAt((new DateTime())->format('Y-m-d H:i:s')),
            deleted_at: new WorkEntryDeletedAt()
        );
        $this->repository->update($workEntry);
    }
}
