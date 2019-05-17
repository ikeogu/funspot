
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FunSpot') }}</title>

    <!-- Scripts -->
   

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
   
     <!-- Scripts -->
     <!-- Core -->
     <script src="{{asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{asset('vendor/popper/popper.min.js') }}"></script>
  <script src="{{asset('vendor/bootstrap/bootstrap.min.js') }}"></script>
  <script src="{{asset('vendor/headroom/headroom.min.js') }}"></script>
  <script src="{{ asset('/js/app.js') }}"></script>
  <script src="{{ mix('/js/app.js') }}"></script>
  <script>
        var token = '{{ Session::token() }}';
        var urlLike = "{{ route('like') }}";
        
  </script>
  <script>
    var video = document.getElementById('lk');
    var videoId = video.getAttribute("data-videoId");  
    var count = '/countlike/' + videoId;
    var discount = '/discount/' + videoId;
    function like(){
        $(document).ready(function(){
            $.ajax({
            type: "GET",
            url: count,
            success: function(data)
            {
                $('#count').text(data.count_like);
            }
            });
        });
    }      
    function dislike(){
        $(document).ready(function(){
            $.ajax({
            type: "GET",
            url: discount,
            success: function(data)
            {
                $('#discount').text(data.discount);
            }
            });
        });  
    }        
    $('.like').on('click',function(event){
        event.preventDefault();
        var videoId = event.target.getAttribute("data-videoId");
        console.log(videoId); 
       
        var isLike = event.target.previousElementSibling == null;
        
        $.ajax({
           method:'POST',
           url:urlLike,
           data:{
               isLike: isLike,
               videoId: videoId,
               _token: token,
              
           }
        }).done(function(e){
            like(); 
            // dislike();
        });      
    });
   
</script>
   
</html>
