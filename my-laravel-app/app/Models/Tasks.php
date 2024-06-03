<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $primaryKey = 'task_id';
    public $incrementing = true;
    protected $keyType = 'int';

    public function taskTeamMembers()
    {
        return $this->hasMany(TaskTeamMembers::class, 'task_id', 'task_id');
    }
}
