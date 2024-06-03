<!DOCTYPE html> 
<html> 
<head> 
    <title>Участники</title> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> 
</head> 
<body> 
<div class="container"> 
    <h1>Участники</h1> 
 
    <div class="mb-4"> 
        <a href="{{ url('/team_member/create') }}" class="btn btn-success">Добавить нового участника</a> 
    </div> 
 
    <form method="GET" action="{{ url('/team_member') }}"> 
        <div class="form-group"> 
            <label for="role">Роль</label> 
            <select id="role" name="role" class="form-control"> 
                <option value="">Все</option> 
                <option value="Разработчик">Разработчик</option> 
                <option value="Тестировщик">Тестировщик</option> 
                <option value="Дизайнер">Дизайнер</option> 
                <option value="Менеджер проекта">Менеджер проекта</option> 
                <option value="Руководитель">Руководитель</option> 
            </select> 
        </div> 
 
        <div class="form-group"> 
            <label for="task_name">Имя Задачи</label> 
            <input type="text" id="task_name" name="task_name" class="form-control"> 
        </div> 
 
        <button type="submit" class="btn btn-primary">Поиск</button> 
    </form> 
 
    <hr> 
 
    <ul id="task-list" class="list-group"> 
        <!-- Tasks will be displayed here --> 
    </ul> 
</div> 
 
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 
<script> 
    $(document).ready(function() { 
        // Fetch tasks when the page loads 
        fetchTeamMembers(); 
 
        // Fetch tasks based on filter 
        $('form').on('submit', function(e) { 
            e.preventDefault(); 
            fetchTeamMembers(); 
        }); 
 
        function fetchTeamMembers() { 
            let role = $('#role').val(); 
            let taskName = $('#task_name').val(); 
 
            $.ajax({ 
                url: '{{ url('/team_member') }}', 
                method: 'GET', 
                data: { 
                    role: role, 
                    task_name: taskName
                }, 
                success: function(teamMembers) { 
                    $('#task-list').empty(); 
                    teamMembers.forEach(function(member) { 
                        $('#task-list').append('<li class="list-group-item">' + member.name + ' - ' + member.role + '</li>'); 
                    }); 
                } 
            }); 
        } 
    }); 
</script> 
</body> 
</html>