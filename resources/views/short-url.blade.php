<!-- resources/views/short-url.blade.php -->

<form action="/short-url" method="POST">
    @csrf
    <input type="text" name="original_url" placeholder="Enter a long URL" required>
    <button type="submit">Generate Short URL</button>
</form>
