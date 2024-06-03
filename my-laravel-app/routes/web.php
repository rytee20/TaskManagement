<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

Route::get('/', function () { 
    return view('tasks');
});

Route::get('/tasks', [TasksController::class, 'getTasks']);

Route::get('/tasks/create', [TasksController::class,'createTask'])->name('tasks.create');

Route::post('/tasks', [TasksController::class, 'store'])->name('tasks.store');

Route::get('/tasks/team_members/names', [TasksController::class, 'getTeamMembersNames']);

Route::get('/tasks/names', [TasksController::class, 'getTasksName']);

Route::get('/tasks/id', [TasksController::class,'getTaskIdByName']);