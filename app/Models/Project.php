<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['image_path', 'name', 'description', 'status', 'due_date', 'created_by', 'updated_by', 'duration'];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getDurationAttribute()
    {
        if ($this->due_date && $this->created_at) {
            $dueDate = Carbon::parse($this->due_date);
            $createdAt = Carbon::parse($this->created_at);

            return $createdAt->diffForHumans($dueDate, true);
        }
        return 'N/A';
    }
}