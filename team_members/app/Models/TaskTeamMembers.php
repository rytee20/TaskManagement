<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskTeamMembers extends Model
{
    use HasFactory;

    protected $table = 'task_team_members';
    public $incrementing = false; // Не использовать автоинкремент
    protected $primaryKey = null; // Первичный ключ отсутствует (используем составной ключ)
    //public $timestamps = false;

    public function teamMembers()
    {
        return $this->belongsTo(TeamMembers::class, 'team_member_id', 'team_member_id');
    }


}
