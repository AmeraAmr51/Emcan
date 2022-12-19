<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <title>Emcan</title>
</head>
<header>
    <div class="header-area ">
        <div id="sticky-header" class="main-header-area">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg navbar-light shadow">
                    <div class="container d-flex justify-content-between align-items-center">
                        <div class="align-self-center d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                            <div class="flex-fill">
                                @if (Route::has('login'))
                                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                    @auth
                                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                                    @else
                                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
                
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                                
                            </div>
                           
                        </div>

                    </div>
                </nav>
            </div>

        </div>
    </div>
    </div>
</header>
<body class="img" style="background-image: url('images/bg.jpg')">

    @yield('content')

