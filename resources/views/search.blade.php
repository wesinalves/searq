@extends('layouts.searchlayout')

@section('content')
<!-- Begin page content -->
    <main role="main" class="container ">
    <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{route('search')}}">Home</a></li>
       <li class="breadcrumb-item active" aria-current="page">Pesquisa</li>
     </ol>
   </nav>
      <div class="mt-3">
        <h1>Pesquisa de Acervo</h1>
      </div>
      
      <form action="{{route('results')}}" method="get">
        <div class="form-row align-items-center">
          <div class="col-sm-10 my-1">
            <label class="sr-only" for="inlineFormInputName">Name</label>
            <input type="text" class="form-control" id="content" name="content" placeholder="Insira o termo a ser pesquisado" autofocus>
          </div>
                 
          <div class="col-auto my-1">
            <button type="submit" class="btn btn-primary">Pesquisar</button>
          </div>
        </div>

      </form>
      <div class="mt-3">
        <h3>Pesquisar por descritores:</h3>
        <ul>
          <li><a href="{{route('search_by',['descritor'=>'subject'])}}">Assunto</a></li>
          <li><a href="{{route('search_by',['descritor'=>'type'])}}">Tipologia documental</a></li>
          <li><a href="{{route('search_by',['descritor'=>'producer'])}}">Produtor</a></li>
          <li><a href="{{route('search_by',['descritor'=>'local'])}}">Local</a></li>
          <li><a href="{{route('advanced_search')}}">Pesquisa avançada</a></li>

        </ul>
      </div>

      


    </main>
@endsection