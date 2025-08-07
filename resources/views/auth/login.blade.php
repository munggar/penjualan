{{-- @extends('layouts.app') --}}
{{-- @section('content') --}}

<style>
    * {
        box-sizing: border-box;
    }

    body {
        background-color: #f3f4f6;
        font-family: 'Segoe UI', sans-serif;
        margin: 0;
        padding: 0;
    }

    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    .login-card {
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        padding: 30px 40px;
        width: 100%;
        max-width: 400px;
    }

    .login-card h2 {
        text-align: center;
        margin-bottom: 24px;
        color: #4f46e5;
    }

    .form-group {
        margin-bottom: 16px;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: 600;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 8px;
        transition: border-color 0.3s;
        font-size: 1rem;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
        border-color: #4f46e5;
        outline: none;
    }

    .error {
        color: red;
        font-size: 0.875rem;
        margin-top: 4px;
    }

    .form-check {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.95rem;
        margin-bottom: 20px;
    }

    .btn-login {
        width: 100%;
        background-color: #4f46e5;
        color: white;
        border: none;
        padding: 10px;
        font-size: 1rem;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-login:hover {
        background-color: #3730a3;
    }
</style>

<div class="login-container">
    <div class="login-card">
        <h2>Login Admin</h2>
        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="username">Username</label>
                <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus>
                @error('username')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">Remember Me</label>
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>
</div>

{{-- @endsection --}}
