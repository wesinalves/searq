<!doctype html>
<html lang="pt">
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119959968-2"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-119959968-2');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{ url('favicon.ico') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Memory - Base de Memórias do Instituto Evandro Chagas</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/search.css') }}" rel="stylesheet">
  </head>

  <body>

    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="{{route('search')}}">Memory</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item {{Route::current()->named(['search','search_by','advanced_search','results','results_by','results_by_name','advanced_results','quick_results'])?'active':''}}">
              <a class="nav-link" href="{{route('search')}}">Pesquisa <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{Route::current()->named(['background','background.view'])?'active':''}}" href="{{route('background')}}">Fundos</a>
            </li>
            <li class="nav-item {{Route::current()->named('user.perfil')?'active':''}}">
              <a class="nav-link" href="{{route('user.perfil',['user_id'=>Auth::user()->id])}}">Perfil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Ajuda</a>
            </li>
            
            <li class="nav-item">
              <a class="nav-link" href="{{route('logout')}}"
                  onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                  Logout ( {{ Auth::user()->name }} )
              </a>
              
            </li>

          </ul>
          <form id="logout-form" action="{{route('logout')}}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </div>
      </nav>
    </header>

    
    @yield('content')


    <footer class="footer">
      <div class="container">
        <span class="text-muted">
        &#64;<?php echo date('Y');?> MS/SVS - Instituto Evandro Chagas. Desenvolvido por Wesin Alves.</span>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
 

      $(document).ready(function() {
        $('#local').select2();
        $('#producer').select2();
        $('#subject').select2();
        $('#idiom').select2();
        $('#type').select2();

        
      });
    </script>    

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    
  </body>
</html>
