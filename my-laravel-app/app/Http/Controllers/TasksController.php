<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Tasks;

use GuzzleHttp\Client;

class TasksController extends Controller
{
    public function getTeamMembersNames()
    {
        $client=new Client();
        try{
            $response = $client->get('http://app2:80/team_member/names');
            //$response = Http::get('http://app2:8081/team_member/names');

            // Проверяем успешность запроса
            if ($response->getStatusCode() == 200) {
                // Получаем данные об именах работников
                $data = json_decode( $response->getBody(), true ); 

                // Выводим полученные имена
                return $data['teamMembers'];
            } else {
                // Обработка ошибки при запросе к сервису работников
                echo "Failed to fetch tasks names";
            }
        }
        catch (RequestException $e) {
            echo "Request failed: " . $e->getMessage();
        }
    }

    public function getTaskIdByName(Request $request)
    {
        $task_name = $request->input('task_name');

        $tasks = Tasks::where('task_name', $task_name)->first();

        if ($tasks) {
            return response()->json(['tasks' => $tasks]);
        } else {
            return response()->json(['error' => 'Tasks not found'], 404);
        }
    }

    public function getTasksName(Request $request)
    {
        // Log for debugging
        \Log::info('Fetching tasks names');
    
        $tasks = Tasks::pluck('task_name')->all();
    
        // Log the fetched names
        \Log::info('Tasks names: ' . json_encode($tasks));
    
        return response()->json(['tasks' => $tasks]);
    }

    public function getTasks(Request $request) 
    {
        // Получаем параметры запроса
        $status = $request->query('status'); 
        $teamMemberName = $request->query('team_member_name');
    
        $teamMemberId = null;

        $client = new Client();
    
        // Получаем идентификатор участника по его имени
        if ($teamMemberName) { 
            //$response = Http::get('http://app2:8081/team_member/id', ['name' => $teamMemberName]);
            try{
                $response=$client->request('GET','http://app2:80/team_member/id',['query'=>['name'=>$teamMemberName]]);
    
                if ($response->getStatusCode()==200) { 
                    $data=json_decode($response->getBody()->getContents());
                    $teamMemberId = $data->json()['teamMember']['team_member_id']; 
                } else {
                    // Обработка ошибки при запросе к сервису участников
                    return response()->json(['error' => 'Failed to fetch team member ID'], 500); 
                }
            }
            catch (\Exception $e){
                return response()->json(['error' => 'Failed to fetch team member ID'], 500);
            }
        }
    
        // Формируем запрос к задачам
        $query = Tasks::query(); 
    
        // Фильтруем задачи по статусу
        if ($status) { 
            $query->where('status', $status); 
        } 
    
        // Фильтруем задачи по идентификатору участника
        if ($teamMemberId) { 
            $query->whereHas('taskTeamMembers', function ($query) use ($teamMemberId) { 
                $query->where('team_member_id', $teamMemberId); 
            }); 
        } 
    
        // Получаем задачи
        $tasks = $query->get(); 

        return response()->json($tasks); 
    }

    public function createTask()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'status' => 'required|in:завершено,в работе,остановлено,не начато',
        ]);

        $task = new Tasks();
        $task->task_name = $validated['task_name'];
        $task->status = $validated['status'];
        $task->save();

        return redirect('/tasks/create')->with('success', 'Задача успешно добавлена!');
    }
}
