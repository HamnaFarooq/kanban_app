<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kanban App</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- css -->
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.css'); }} ">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css'); }} ">

    <!-- Js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Kanban App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav ms-auto">
                    @auth
                    <li class="nav-item">
                        <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                        <div class="dropdown-menu">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">{{ __('Log Out') }}</a>
                            </form>
                        </div>
                    </li>
                    @else
                    <!-- <a href="/login" class="nav-link">Log in</a> -->
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="temorary_msg">

        @if(( Session::get('errors') ?? 0 ))
        <!-- for error in a form -->
        <div class="alert alert-dismissible alert-danger text-center">
            <strong>Oh snap!</strong> There was a error! Please consider the following things and try submitting again.
            <p class="mb-0">
                @foreach ($errors->all() as $error)
            <div class="text-danger">
                {{$error}}
            </div>
            @endforeach
            </p>
        </div>
        @endif

        @if( session('success') )
        <div class="alert alert-dismissible alert-success text-center">
            <strong>Great!</strong> {{session('success')}}
        </div>
        @endif

        @if( session('errormsg') )
        <!-- for personal error message -->
        <div class="alert alert-dismissible alert-danger text-center">
            <strong>Oh snap!</strong> {{ session('errormsg') }}
        </div>
        @endif
    </div>

    <main class="container py-5" style="min-height: 90vh;">
        {{ $slot }}
    </main>

</body>

<script>
    $(function() {
        setTimeout(function() {
            $(".temorary_msg").fadeOut();
        }, 5000);
    });
</script>

</html>