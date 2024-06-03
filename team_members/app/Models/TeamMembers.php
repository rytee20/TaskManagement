<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMembers extends Model
{
    use HasFactory;

    protected $table = 'team_members';
    protected $primaryKey = 'team_member_id';
    public $incrementing = true; // Используем автоинкрементное значение
    protected $keyType = 'int'; // Тип поля автоинкремента
    public $timestamps = false;

    public function taskTeamMembers()
    {
        return $this->hasMany(TaskTeamMembers::class, 'team_member_id', 'team_member_id');
    }
}