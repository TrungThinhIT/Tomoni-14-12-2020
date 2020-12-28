<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <title>Admin | Success</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <<link rel="stylesheet" href="{{asset('assets/css/customcss/loginResetPassWord.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="{{asset('assets/js/jquery.validate.js')}}"></script>
    <script src="{{asset('assets/js/customjs/login.js')}}"></script>
</head>
<div class="container">
    <div class="row">
        <div class="col-md-4 offset-md-4 form">
                @csrf
                <h2 class="text-center">Success</h2>
                @if (Session('message_error'))
                <div class="alert alert-danger text-center">{{Session::get('message_error')}}</div>
                @endif
                @if (Session('message_success'))
                <div class="alert alert-success text-center">{{Session::get('message_success')}}</div>
                @endif
                <div class="link login-link text-center">
                    Your account already? <a href="{{route('auth.loginIndex')}}">Login here</a>
                </div>
        </div>
    </div>
</div>
</body>

</html>
