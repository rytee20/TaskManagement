<!DOCTYPE html>
<html>
<head>
    <title>Задачи</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Задачи</h1>

    <div class="mb-4">
        <a href="{{ url('/tasks/create') }}" class="btn btn-success">Добавить новую задачу</a>
    </div>

    <form method="GET" action="{{ url('/tasks') }}">
        <div class="form-group">
            <label for="status">Статус задачи</label>
            <select id="status" name="status" class="form-control">
                <option value="">Все</option>
                <option value="завершено">Завершено</option>
                <option value="в работе">В работе</option>
                <option value="остановлено">Остановлено</option>
                <option value="не начато">Не начато</option>
            </select>
        </div>

        <div class="form-group">
            <label for="team_member_name">Имя Исполнителя</label>
            <input type="text" id="team_member_name" name="team_member_name" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Поиск</button>
    </form>

    <hr>

    <ul id="task-list" class="list-group">
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
    $(document).ready(function() {
        fetchTasks();

        $('form').on('submit', function(e) {
            e.preventDefault();
            fetchTasks();
        });

        function fetchTasks() {
            let status = $('#status').val();
            let teamMemberName = $('#team_member_name').val();

            $.ajax({
                url: '{{ url('/tasks') }}',
                method: 'GET',
                data: {
                    status: status,
                    team_member_name: teamMemberName
                },
                success: function(tasks) {
                    $('#task-list').empty();
                    tasks.forEach(function(task) {
                        $('#task-list').append('<li class="list-group-item">' + task.task_name + ' - ' + task.status + '</li>');
                    });
                }
            });
        }
    });
</script>
</body>
</html>