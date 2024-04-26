<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>
<body>
    <h2>Password Reset</h2>
    @if (session('status'))
        <div>{{ session('status') }}</div>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div>
            <label for="email">Email Address:</label>
            <input type="email" id="email" name="email" required>
            @error('email')
                <div>{{ $message }}</div>
            @enderror
        </div>
        <button type="submit">Send Password Reset Link</button>
    </form>
</body>
</html>
