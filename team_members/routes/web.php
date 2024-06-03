<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamMemberController;

Route::get('/', function () { 
    return view('TeamMember');
});

Route::get('/team_member', [TeamMemberController::class, 'getTasks']);

Route::get('/team_member/create', [TeamMemberController::class,'createTeamMember'])->name('TeamMember.create');

Route::post('/team_member', [TeamMemberController::class, 'store'])->name('team_member.store');

Route::get('/team_member/tasks/names', [TeamMemberController::class, 'getTasksNames']);

Route::get('/team_member/names', [TeamMemberController::class, 'getTeamMembersNames']);

Route::get('/team_member/id', [TeamMemberController::class,'getTeamMemberIdByName']);