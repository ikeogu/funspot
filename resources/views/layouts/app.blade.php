
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FunSpot') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="{{asset('vendor/nucleo/css/nucleo.css')}}" rel="stylesheet">
  <link href="{{asset('vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <!-- Argon CSS -->
  
</head>


        <main id="app">
            @include('inc.navbar')
            <p>hola</p>
            <section class="container body">
                @include('inc.msg')
                @yield('content')
            </section>
        </main>
    </body>
    <script src="{{asset('js/app.js')}}"></script>
     <!-- Scripts -->
     <!-- Core -->
  <script src="{{asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{asset('vendor/popper/popper.min.js') }}"></script>
  <script src="{{asset('vendor/bootstrap/bootstrap.min.js') }}"></script>
  <script src="{{asset('vendor/headroom/headroom.min.js') }}"></script>
  <!-- Argon JS -->
  <script src="{{asset('js/argon.js') }}"></script>
     <script src="{{ mix('js/app.js') }}"></script>
</html>
