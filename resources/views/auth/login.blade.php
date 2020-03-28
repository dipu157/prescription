<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login</title>

    <!-- Styles -->
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="{!! asset('assets/bootstrap-4.0.0/css/bootstrap.min.css') !!}" rel="stylesheet">
    <script src="{!! asset('assets/bootstrap-4.0.0/js/bootstrap.min.js') !!}"></script>
</head>


<body>


<div class="container">

    <div class="row">
        <div class="col-8 mx-auto">
            <h1><strong>Welcome </strong>{!! get_company_name() !!}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-8 mx-auto">
            <h3 class="text-center login-title">Login To Continue</h3>

            <div class="account-wall">
                <img class="profile-img" src="{!! asset('images/sign.png') !!}"  alt="Key Image">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>

                    </div>
                @endif

                <form class="form-signin" role="form" method="POST" action="{{ route('login') }}">


                    {{ csrf_field() }}

                    {!! Form::email('email', 'your-id@brbhospital.com' , array('id' => 'email', 'class' => 'col-sm-12 form-control', 'required')) !!}


                    {!! Form::password('password', array('class' => 'form-control','placeholder' => 'Password', 'required')) !!}
                    {{ $errors->has('password') ? ' has-error' : '' }}
                    @if ($errors->has('password'))
                        <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                    @endif

                    <button class="btn btn-lg btn-primary btn-block" type="submit">
                        Sign in</button>
                </form>

            </div>
        </div>
    </div>
</div>
@include('partials.flash-message')


<!-- Javascript -->
<script src="{!! asset('assets/js/jquery-1.11.1.min.js') !!}"></script>
<script src="{!! asset('assets/js/scripts.js') !!}"></script>
{{--<script src="{!! asset('assets/js/placeholder.js') !!}"></script>--}}

</body>
</html>
