<?php

namespace Core\WorkSign\Domain\WorkEntry\Contracts;

use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryId;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryUserId;
use Core\WorkSign\Domain\WorkEntry\WorkEntry;

interface WorkEntryRepositoryInterface
{
    /**
     * Get WorkEntry by id
     *
     * @param WorkEntryId $id
     * @return WorkEntry|null
     */
    public function get(WorkEntryId $id): ?WorkEntry;

    /**
     * Update a WorkEntry
     *
     * @param WorkEntry $work_entry
     * @return boolean
     */
    public function update(WorkEntry $work_entry): bool;

    /**
     * Create a WorkEntry
     *
     * @param WorkEntry $work_entry
     * @return WorkEntryId
     */
    public function create(WorkEntry $work_entry): WorkEntryId;

    /**
     * Delete a WorkEntry by id
     *
     * @param WorkEntryId $id
     * @return boolean
     */
    public function delete(WorkEntryId $id): bool;

    /**
     * Get WorkEntries by user id
     *
     * @param WorkEntryUserId $user_id
     * @return array
     */
    public function getWorkEntriesByUserId(WorkEntryUserId $user_id): array;
}
