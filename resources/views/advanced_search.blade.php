@extends('layouts.searchlayout')

@section('content')
<!-- Begin page content -->
    <main role="main" class="container ">
     <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{route('search')}}">Home</a></li>
       <li class="breadcrumb-item active" aria-current="page">Pesquisa avançada</li>
     </ol>
   </nav>

      <div class="mt-3">
        <h1>Pesquisa Avançada</h1>
      </div>
      
      <form action="{{route('advanced_results')}}" method="get">
        <fieldset id="first_criteria">
         <legend>Procurar descritores com *:</legend>
         <div class="form-row">
            <div class="form-group col-md-6">
              <input type="text" class="form-control" id="inputCriteria" name="inputCriteria[]" placeholder="Pesquisar" autofocus>
            </div>
            <div class="form-group col-md-5">
              <select id="criteria" name="criteria[]" class="custom-select">
                <option value="">Selecione ...</option>
                @foreach($descriptions as $index=>$description)
                  <option value="{{$fields[$index]}}" >{{$description}}</option>
                @endforeach
              
            </select>
            </div>
            
        </div>
        </fieldset>
  
        <button id="addCriteria" type="button" class="btn btn-default">Adicionar critério</button>
                      

        <?php /*
        <fieldset>
          <legend>Filtrar resultados por:</legend>

          <div class="form-row">
              <div class="form-group col-md-6">
                <select id="level" name="level" class="custom-select">
                                <option value="">nível de descrição ...</option>
                                @foreach($levels as $index=>$level)
                                  <option value="{{$level->id}}" >{{$level->name}}</option>
                                @endforeach
                              
                            </select>
              </div>
              <div class="form-group col-md-6">
                <select id="access" name="access" class="custom-select">
                                <option value="">condições de acesso ...</option>
                                @foreach($access as $index=>$acc)
                                  <option value="{{$acc}}" >{{$access_labels[$index]}}</option>
                                @endforeach
                              
                            </select>
              </div>
            </div>
                  
            

        </fieldset>
        */?>

        <fieldset>
          <legend>Filtrar por intervalos de data:</legend>
           <div class="form-row">
              <div class="form-group col-md-4">
                <input type="text" class="form-control" id="start_date" name="start_date" placeholder="Início">
              </div>
              <div class="form-group col-md-4">
                <input type="text" class="form-control" id="end_date" name="end_date" placeholder="Fim">
              </div>
              
          </div>
        </fieldset>

        
      <div class="p-3 mb-2 bg-secondary">
        <button type="submit" name="btn_create" value="1" class="btn btn-primary btn-sm">Pesquisar</button>
        <a href="{{route('search')}}" class="btn btn-light btn-sm">Cancelar</a>
      </div>

      </form>
    

    </main>
@endsection