<!DOCTYPE html>
<html>
<head>
    <title>Verify OTP</title>
</head>
<body>
    <h1>Verify OTP</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('otp.verify') }}" method="POST">
        @csrf
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ session('email') }}" readonly>
        </div>
        <div>
            <label for="otp">OTP:</label>
            <input type="text" name="otp" id="otp">
        </div>
        <div>
            <button type="submit">Verify</button>
        </div>
    </form>
</body>
</html>
