<?php

namespace App\Models;

use App\TaskPriority;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'column_id',
        'title',
        'description',
        'order',
        'sprint_points',
        'priority',
        'estimated_time',
        'elapsed_time',
        'due_date',
    ];

    protected $casts = [
        'priority' => TaskPriority::class,
        'estimated_time' => 'time',
        'elapsed_time' => 'time',
        'due_date' => 'date',
    ];

    public function column()
    {
        return $this->belongsTo(Column::class);
    }

    public function assignees()
    {
        return $this->belongsToMany(User::class, 'task_user');
    }

    public function dependencies()
    {
        return $this->belongsToMany(
            Task::class,
            'task_dependencies',
            'task_id',
            'depends_on_task_id'
        );
    }

    public function dependents()
    {
        return $this->belongsToMany(
            Task::class,
            'task_dependencies',
            'depends_on_task_id',
            'task_id'
        );
    }
}
