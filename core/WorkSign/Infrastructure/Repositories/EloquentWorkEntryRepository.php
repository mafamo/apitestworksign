<?php

namespace Core\WorkSign\Infrastructure\Repositories;

use Core\WorkSign\Domain\WorkEntry\Contracts\WorkEntryRepositoryInterface;
use App\Models\User as EloquentUserModel;
use App\Models\WorkEntry as EloquentWorkEntryModel;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryCreatedAt;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryDeletedAt;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryEndDate;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryId;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryStartDate;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryUpdatedAt;
use Core\WorkSign\Domain\WorkEntry\ValueObjects\WorkEntryUserId;
use Core\WorkSign\Domain\WorkEntry\WorkEntry;

class EloquentWorkEntryRepository implements WorkEntryRepositoryInterface
{
    public function __construct(
        private EloquentWorkEntryModel $eloquentWorkEntryModel,
        private EloquentUserModel $eloquentUserModel
    ) {
    }

    /**
     * @inheritDoc
     */
    public function get(WorkEntryId $id): ?WorkEntry
    {
        $workEntryEloquent = $this->eloquentWorkEntryModel->find($id->value());

        return WorkEntry::create(
            id: new WorkEntryId($workEntryEloquent->id),
            user_id: new WorkEntryUserId($workEntryEloquent->user_id),
            start_date: new WorkEntryStartDate($workEntryEloquent->start_date),
            end_date: new WorkEntryEndDate($workEntryEloquent->end_date),
            created_at: new WorkEntryCreatedAt($workEntryEloquent->created_at),
            updated_at: new WorkEntryUpdatedAt($workEntryEloquent->updated_at),
            deleted_at: new WorkEntryDeletedAt($workEntryEloquent->deleted_at)
        );
    }

    /**
     * @inheritDoc
     */
    public function update(WorkEntry $work_entry): bool
    {
        $eloquentWorkEntryToUpdate = $this->eloquentWorkEntryModel;
        $data = [
            'user_id' => $work_entry->userId()->value(),
            'start_date' => $work_entry->startDate()->value(),
            'end_date' => $work_entry->endDate()->value(),
            'updated_at' => $work_entry->updatedAt()->value()
        ];
        $eloquentWorkEntryToUpdate->findOrFail($work_entry->id()->value())->update($data);

        return true;
    }

    /**
     * @inheritDoc
     */
    public function create(WorkEntry $work_entry): WorkEntryId
    {
        $eloquentWorkEntryNew = $this->eloquentWorkEntryModel;
        $data = [
            'user_id' => $work_entry->userId()->value(),
            'start_date' => $work_entry->startDate()->value(),
            'end_date' => $work_entry->endDate()->value(),
            'created_at' => $work_entry->createdAt()->value(),
            'updated_at' => $work_entry->updatedAt()->value()
        ];
        $eloquentWorkEntryNew->create($data);

        return new WorkEntryId($eloquentWorkEntryNew->id);
    }

    /**
     * @inheritDoc
     */
    public function delete(WorkEntryId $id): bool
    {
        $eloquentWorkEntryToDelete = $this->eloquentWorkEntryModel;

        return $eloquentWorkEntryToDelete->findOrFail($id->value())->delete();
    }

    /**
     * @inheritDoc
     */
    public function getWorkEntriesByUserId(WorkEntryUserId $user_id): array
    {
        $userEloquent = $this->eloquentUserModel->findOrFail($user_id->value());
        $workEntryCollectionEloquent = $userEloquent->work_entries()->get();
        $result = [];
        foreach ($workEntryCollectionEloquent as $workEntryEloquent) {
            $result[] = WorkEntry::create(
                id: new WorkEntryId($workEntryEloquent->id),
                user_id: new WorkEntryUserId($workEntryEloquent->user_id),
                start_date: new WorkEntryStartDate($workEntryEloquent->start_date),
                end_date: new WorkEntryEndDate($workEntryEloquent->end_date),
                created_at: new WorkEntryCreatedAt($workEntryEloquent->created_at),
                updated_at: new WorkEntryUpdatedAt($workEntryEloquent->updated_at),
                deleted_at: new WorkEntryDeletedAt($workEntryEloquent->deleted_at)
            );
        }

        return $result;
    }
}
