<!DOCTYPE html>
<html>
<head>
    <title>Login Siswa</title>
</head>
<body>
<h2>Login Siswa</h2>

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<form method="POST" action="/login-siswa">
    @csrf
    <input type="text" name="username" placeholder="ID / Username"><br><br>
    <input type="password" name="password" placeholder="Password"><br><br>
    <button type="submit">Login</button>
</form>
</body>
</html>