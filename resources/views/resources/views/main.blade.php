<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="POST" action="{{ url('/') }}">
    @csrf
    <label for="url">URL:</label>
    <input type="text" name="url" required>
    <br>
    <label for="slug">Slug:</label>
    <input type="text" name="slug" required>
    <br>
    <button type="submit">Criar Link</button>
</form>

    
</body>
</html>