@extends('layouts.searchlayout')

@section('content')
<!-- Begin page content -->
    <main role="main" class="container ">
      <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="{{route('search')}}">Home</a></li>
         <li class="breadcrumb-item active" aria-current="page">Pesquisa por descritor</li>
       </ol>
     </nav>
      <div class="mt-3">
        <h1>Pesquisa de Acervo</h1>
      </div>
      
      <form class="form-inline" action="{{route('results_by_name')}}" method="get">
        <div class="form-group">


          <label for="type">{{$name_descritor}}</label>
          <input type="text" class="form-control mx-sm-3" name="txt_name">
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="position" value="start" checked>
            <label class="form-check-label" for="inlineRadio1">Iniciado por...</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="position" value="middle">
            <label class="form-check-label" for="inlineRadio2">Contendo</label>
          </div>
          
        </div>
        <input type="hidden" name="descritor" value="{{$descritor}}">
        
        <button type="submit" class="btn btn-primary mb-2">Pesquisar</button>
      </form>

      <br>

             
      	<p>Filtrar:
          @foreach($letters as $letter)
              <a href="{{route('search_by',['descritor'=>$descritor,'letter'=>$letter])}}" class="btn btn-primary mb-2">{{$letter}}</a>
            
          @endforeach
        </p>
        
        <input type="hidden" name="descritor" value="{{$descritor}}">
      


      <form action="{{route('results_by')}}" method="get">
        <?php /*
      	<div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="search" value="all">
            <label class="form-check-label" for="inlineRadio1">Todos os selecionados</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="search" value="any">
            <label class="form-check-label" for="inlineRadio2">Qualquer um dos selecionados</label>
          </div>*/?>

          <div class="form-group">
              <label for="exampleFormControlSelect2">Termos disponíveis: {{count($data_provider)}} <br>Dica: Aparte a tecla <code>Ctrl</code> para selecionar mais de uma opção.</label>
              <select multiple class="form-control" id="exampleFormControlSelect2" size=7 name="slc_terms[]">
                @foreach($data_provider as $term)
                  <option value="{{$term->id}}">{{$term->name}}</option>
                @endforeach
              </select>
            </div>
            
            <input type="hidden" name="descritor" value="{{$descritor}}">
            <button type="submit" class="btn btn-primary mb-2">Pesquisar</button>
            <a href="{{route('search_by',['descritor'=>$descritor])}}"class="btn btn-light mb-2">Limpar Filtro</a>
          
      </form>

      
    </main>
@endsection