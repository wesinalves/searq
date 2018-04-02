
<!doctype html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Este sistema foi criado para gerenciar os arquivos produzidos pelos pesquisadores do Instituto Evandro Chagas">
    <meta name="author" content="Wesin Ribeiro Alves">
    <link rel="shortcut icon" href="{{ url('favicon.ico') }}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    <title>SEARQ - Instituto Evandro Chagas</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />


    <!-- Custom styles for this template -->
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
  </head>

  <body>
    <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="{{route('admin.dashboard')}}">SEARQ</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{route('search')}}">Pesquisa <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Configurações</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Perfil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Ajuda</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                  Logout ( {{ Auth::user()->name }} )
              </a>
              
            </li>

          </ul>
          <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
          <a href="{{ route('collection.form')}}" class="btn btn-success mr-sm-2 "><< Criar novo acervo >></a>
          
        </div>
      </nav>
    </header>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
          <ul class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link {{Route::current()->named(['admin.dashboard','collection.view','collection.edit'])?'active':''}}" href="{{route('admin.dashboard')}}"><img src="{{ asset('images/archive-icon.png')}}"> Acervo <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{Route::current()->named('level')?'active':''}}" href="{{route('level')}}"><img src="{{ asset('images/document-tree-icon.png')}}"> Estrutura do Arranjo</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{Route::current()->named('type')?'active':''}}" href="{{route('type')}}"><img src="{{ asset('images/File-Types-zip-icon.png')}}"> Tipologia documental</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{Route::current()->named('subject')?'active':''}}" href="{{route('subject')}}"><img src="{{ asset('images/Font-Type-icon.png')}}"> Assunto</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{Route::current()->named('producer')?'active':''}}" href="{{route('producer')}}"><img src="{{ asset('images/Manager-icon.png')}}"> Produtor</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{Route::current()->named('local')?'active':''}}" href="{{route('local')}}"><img src="{{ asset('images/Place-icon.png')}}"> Local</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><img src="{{ asset('images/users-icon.png')}}"> Usuário</a>
            </li>
          </ul>

          @yield('contextmenu')

        </nav>

         @yield('content')

        

      </div>
    </div>

    

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
