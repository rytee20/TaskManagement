<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить новую задачу</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Добавить новую задачу</h1>

    <div class="mb-5">
        <a href="{{ url('/') }}" class="btn btn-secondary">Назад к списку задач</a>
    </div>

    <form method="POST" action="{{ route('tasks.store') }}">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="task_name">Название задачи:</label>
            <input type="text" id="task_name" name="task_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="status">Статус:</label>
            <select id="status" name="status" class="form-control">
                <option value="завершено">Завершено</option>
                <option value="в работе">В работе</option>
                <option value="остановлено">Остановлено</option>
                <option value="не начато">Не начато</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Добавить задачу</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</body>
</html>