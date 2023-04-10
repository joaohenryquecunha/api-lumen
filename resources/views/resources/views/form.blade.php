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
