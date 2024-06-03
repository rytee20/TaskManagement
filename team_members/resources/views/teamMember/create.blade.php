<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить нового участника</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Добавить нового участника</h1>

    <div class="mb-5">
        <a href="{{ url('/') }}" class="btn btn-secondary">Назад к списку учасников</a>
    </div>

    <form method="POST" action="{{ route('team_member.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Имя:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="role">Роль:</label>
            <select id="role" name="role" class="form-control">
                <option value="Разработчик">Разработчик</option>
                <option value="Тестировщик">Тестировщик</option>
                <option value="Дизайнер">Дизайнер</option>
                <option value="Менеджер проекта">Менеджер проекта</option>
                <option value="Руководитель">Руководитель</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Добавить участника</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</body>
</html>