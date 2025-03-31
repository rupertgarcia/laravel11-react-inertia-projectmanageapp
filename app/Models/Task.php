<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_path',
        'status',
        'priority',
        'due_date',
        'assigned_user_id',
        'created_by',
        'updated_by',
        'project_id',
        'duration'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    // Compute duration dynamically
    public function getDurationAttribute()
    {
        if ($this->due_date && $this->created_at) {
            $dueDate = Carbon::parse($this->due_date);
            $createdAt = Carbon::parse($this->created_at);

            return $createdAt->diffForHumans($dueDate, true); // Example: "2 days", "5 hours"
        }
        return 'N/A';
    }
}