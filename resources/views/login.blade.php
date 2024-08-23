<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>

<link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    <div class="outerdiv">
        <div class="innerdiv">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <h1>LOGIN HERE</h1>
                
                @if(session('success'))
                   <li style="color: green">{{ session('success') }} </li><br>
                @endif

                @foreach ($errors->all() as $err)
                    <li id="error">{{ $err }}</li>
                @endforeach

                <label for="email">Email</label>
                <input type="text" name="email" required><br>
                
                <label for="password">Password</label>
                <input type="password" name="password" required><br>
                <a href="/forget_password">forget password</a>
                <input type="submit" name="submit" id="btn">

            </form>
            <a href="/registration"><button>Registration</button></a>
        </div>
    </div>
</body>

</html>
