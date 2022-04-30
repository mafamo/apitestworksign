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

class CreateWorkEntryUseCase
{

    public function __construct(private WorkEntryRepositoryInterface $repository)
    {
    }

    /**
     * Create a WorkEntry
     *
     * @param integer $user_id
     * @param string $start_date
     * @param string|null $end_date
     * @return WorkEntryId
     */
    public function __invoke(
        int $user_id,
        string $start_date,
        ?string $end_date = null
    ): WorkEntryId {
        $workEntry = WorkEntry::create(
            id: new WorkEntryId(),
            user_id: new WorkEntryUserId($user_id),
            start_date: new WorkEntryStartDate($start_date),
            end_date: new WorkEntryEndDate($end_date),
            created_at: new WorkEntryCreatedAt((new DateTime())->format('Y-m-d H:i:s')),
            updated_at: new WorkEntryUpdatedAt((new DateTime())->format('Y-m-d H:i:s')),
            deleted_at: new WorkEntryDeletedAt()
        );

        return $this->repository->create($workEntry);
    }
}
