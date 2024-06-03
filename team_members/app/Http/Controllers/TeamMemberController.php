<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\TeamMembers;

class TeamMemberController extends Controller
{
    public function getTasksNames()
    {
        $response = Http::get('http://app1:8090/tasks/names');

        if ($response->successful()) {
            $data = $response->json();

            return $data['tasks'];
        } else {
            echo "Failed to fetch tasks names";
        }
    }

    public function getTasks(Request $request) 
    {
        // Получаем параметры запроса
        $role = $request->query('role'); 
        $taskName = $request->query('task_name');
    
        $taskId = null;
    
        // Получаем идентификатор участника по его имени
        if ($taskName) { 
            $response = Http::get('http://app1:8090/tasks/id', ['task_name' => $taskName]); 
    
            if ($response->successful()) { 
                $taskId = $response->json()['tasks']['task_id']; 
            } else {
                // Обработка ошибки при запросе к сервису участников
                return response()->json(['error' => 'Failed to fetch task ID'], 500); 
            }
        }
    
        // Формируем запрос к задачам
        $query = TeamMembers::query(); 
    
        // Фильтруем задачи по статусу
        if ($role) { 
            $query->where('role', $role); 
        } 
    
        // Фильтруем задачи по идентификатору участника
        if ($taskId) { 
            $query->whereHas('taskTeamMembers', function ($query) use ($taskId) { 
                $query->where('task_id', $taskId); 
            }); 
        } 
    
        // Получаем задачи
        $teamMember = $query->get(); 

        return response()->json($teamMember); 
    }

    public function createTeamMember()
    {
        return view('teamMember.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|in:Разработчик,Тестировщик,Дизайнер,Менеджер проекта,Руководитель',
        ]);

        $member = new TeamMembers();
        $member->name = $validated['name'];
        $member->role = $validated['role'];
        $member->save();

        return redirect('/team_member/create')->with('success', 'Участник добавлен!');
    }

    public function getTeamMembersNames(Request $request)
    {
        // Log for debugging
        \Log::info('Fetching team members names');
    
        $teamMembers = TeamMembers::pluck('name')->all();
    
        // Log the fetched names
        \Log::info('Team members names: ' . json_encode($teamMembers));
    
        return response()->json(['teamMembers' => $teamMembers]);
    }

    public function getTeamMemberIdByName(Request $request)
    {
        $name = $request->input('name');

        $teamMember = TeamMembers::where('name', $name)->first();

        if ($teamMember) {
            return response()->json(['teamMember' => $teamMember]);
        } else {
            return response()->json(['error' => 'Team member not found'], 404);
        }
    }
}


