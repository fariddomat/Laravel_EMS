<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="{{ asset('home/assets/css files/login.css') }}">

    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Baloo+Bhaijaan+2:wght@400..800&family=Rubik:ital,wght@0,300..900;1,300..900&family=Vazirmatn:wght@100..900&display=swap"
        rel="stylesheet" />
</head>

<body>
    <div class="page">


        <form action="{{ route('login') }}" method="POST" class="log" style="text-align: center">
            <div style="color: red">

                @foreach ($errors->all() as $error)
                    {{ $error }}<br />
                @endforeach
            </div>
            @csrf
            <h2>login</h2>
            <div class="email">
                <input type="email" name="email" id="" required>
                <span>enter your email</span>
            </div>
            <div class="password">
                <input type="password" name="password" id="" required>
                <span>enter your password</span>
            </div>
            <input type="submit" value="login">
            <a href="" class="link">انشاء حساب</a>
        </form>

        <form class="sign" action="{{ route('register') }}" method="POST" style="text-align: center">
            @csrf
            <h2>sign</h2>

            <div class="name">
                <input type="text" name="name" id="" required>
                <span>enter username</span>
            </div>
            <div class="email">
                <input type="text" name="email" id="" required>
                <span>enter email</span>
            </div>
            <div class="password">
                <input type="password" name="password" id="" required>
                <span>enter your password</span>
            </div>
            <div class="password">
                <input type="password" name="password_confirmation" id="" required>
                <span>enter your password again</span>
            </div>
            <button type="submit" value="sign"> إنشاء حساب</button>
        </form>
    </div>
    <script src="{{ asset('home/assets/JS files/login.js') }}"></script>
</body>

</html>
