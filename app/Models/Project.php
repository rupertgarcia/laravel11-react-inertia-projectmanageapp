<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(Task::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(Task::class, 'updated_by');
    }
}
