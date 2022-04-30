<?php

namespace Core\WorkSign\Domain\WorkEntry;

use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryCreatedAt;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryDeletedAt;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryEndDate;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryId;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryStartDate;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryUpdatedAt;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryUserId;

class WorkEntry
{

    /**
     * Constructor
     *
     * @param WorkEntryId $id
     * @param WorkEntryUserId $user_id
     * @param WorkEntryStartDate $start_date
     * @param WorkEntryCreatedAt $created_at
     * @param WorkEntryUpdatedAt|null $updated_at
     * @param WorkEntryEndDate|null $end_date
     * @param WorkEntryDeletedAt|null $deleted_at
     */
    public function __construct(
        private WorkEntryId $id,
        private WorkEntryUserId $user_id,
        private WorkEntryStartDate $start_date,
        private WorkEntryCreatedAt $created_at,
        private ?WorkEntryUpdatedAt $updated_at,
        private ?WorkEntryEndDate $end_date,
        private ?WorkEntryDeletedAt $deleted_at
    ) {
    }

    /**
     * Get id
     *
     * @return WorkEntryId
     */
    public function id(): WorkEntryId
    {
        return $this->id;
    }

    /**
     * Get user id property of WorkEntry
     *
     * @return WorkEntryUserId
     */
    public function userId(): WorkEntryUserId
    {
        return $this->user_id;
    }

    /**
     * Get Start Date
     *
     * @return WorkEntryStartDate
     */
    public function startDate(): WorkEntryStartDate
    {
        return $this->start_date;
    }

    /**
     * Get End Date
     *
     * @return WorkEntryEndDate|null
     */
    public function endDate(): ?WorkEntryEndDate
    {
        return $this->end_date;
    }

    /**
     * Get Created At
     *
     * @return WorkEntryCreatedAt
     */
    public function createdAt(): WorkEntryCreatedAt
    {
        return $this->created_at;
    }

    /**
     * Get updated at
     *
     * @return WorkEntryUpdatedAt|null
     */
    public function updatedAt(): ?WorkEntryUpdatedAt
    {
        return $this->updated_at;
    }

    /**
     * Get Deleted At
     *
     * @return WorkEntryDeletedAt|null
     */
    public function deletedAt(): ?WorkEntryDeletedAt
    {
        return $this->deleted_at;
    }

    /**
     * Create a WorkEntry
     *
     * @param WorkEntryId $id
     * @param WorkEntryUserId $user_id
     * @param WorkEntryStartDate $start_date
     * @param WorkEntryCreatedAt $created_at
     * @param WorkEntryUpdatedAt|null $updated_at
     * @param WorkEntryEndDate|null $end_date
     * @param WorkEntryDeletedAt|null $deleted_at
     * @return WorkEntry
     */
    public static function create(
        WorkEntryId $id,
        WorkEntryUserId $user_id,
        WorkEntryStartDate $start_date,
        WorkEntryCreatedAt $created_at,
        WorkEntryUpdatedAt $updated_at = null,
        WorkEntryEndDate $end_date = null,
        WorkEntryDeletedAt $deleted_at = null
    ): WorkEntry {
        return new self(
            id: $id,
            user_id: $user_id,
            start_date: $start_date,
            created_at: $created_at,
            updated_at: $updated_at,
            end_date: $end_date,
            deleted_at: $deleted_at
        );
    }
}
