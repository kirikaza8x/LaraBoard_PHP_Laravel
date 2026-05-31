<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'workspace_id',
        'name',
        'description',
        'due_date',
        'status',
    ];

    // A Project belongs to one Workspace
    public function workspace(): BelongsTo
    {
        return $this->belongsTo(Workspace::class);
    }

    // A Project has many Tasks (we'll build Tasks next)
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}