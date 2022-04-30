<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Get WorkEntries relationship
     *
     * @return HasMany
     */
    public function work_entries(): HasMany
    {
        return $this->hasMany(WorkEntry::class);
    }
}
