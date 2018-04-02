@extends('layouts.dashlayout')

@section('content')
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
  <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
       <li class="breadcrumb-item"><a href="{{route('collection.view',['collection_id'=>$collection->id])}}">Acervo</a></li>
       <li class="breadcrumb-item">Níveis</li>
       <li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
     </ol>
  </nav>
   <h1>Cadastrar Grupos/Subgrupos/Séries e Subséries</h1>

  <div class="row">
    <div class="col-md-9"> 
      <h5>{{$collection->title}}</h5>
      <p>{{$collection->start_date}} - {{$collection->end_date}}</p>     

      <form action="{{ route('collection.create') }}" method="post">
        <fieldset>
          <legend>1. Área de identificação</legend>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="code">Código de referência</label>
            <input type="text" class="form-control " id="code" name="code" size="250" >
          </div>
          <div class="form-group col-md-4">
            <label for="title">Título</label>
            <input type="text" class="form-control " id="title" name="title" size="250">
          </div>
          <div class="form-group col-md-4">
            <label for="level">Nível de descrição</label> <img src="{{ asset('images/add-icon.png')}}">
            <select id="level" name="level" class="custom-select">
                <option>Selecione ...</option>
              @foreach($levels as $level)
                <option value="{{ $level->id }}">{{ $level->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="start_date">Data Inicial</label>
            <input type="date" class="form-control " id="start_date" name="start_date" size="10">
          </div>
          <div class="form-group col-md-4">
            <label for="end_date">Data Final</label>
            <input type="date" class="form-control " id="end_date" name="end_date" size="10">
          </div>
          

        </div>
        
        </fieldset>
      
        <fieldset>
          <legend>3. Área de conteúdo e estrutura</legend>
          
          <div class="form-row">
            <div class="form-group col-md-8">
              <label for="content">Âmbito e conteúdo</label>
              <textarea class="form-control " id="content" name="content" cols="250" rows="5"></textarea>
            </div>        
            <div class="form-group col-md-4">
              <label for="level_system">Sistema de arranjo</label>
              <textarea class="form-control " id="level_system" name="level_system" cols="250" rows="5"></textarea>
            </div>
          </div>
        </fieldset>

        <fieldset id="add_fields" class="d-none">
          <legend>4. Campos adicionais</legend>
          <div class="form-row" id="form_fields" >
            
          </div>
        </fieldset>
      

        {{ csrf_field() }}

        <div class="p-3 mb-2 bg-secondary">
          <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
          <button type="button" class="btn btn-primary btn-sm">Salvar e criar novo</button>
          <button type="button" class="btn btn-warning btn-sm">Salvar Rascunho</button>
          <button type="button" class="btn btn-light btn-sm">Cancelar</button>
        </div>

      </form>
    </div>

    <div class="col-md-3">
      <div class="widget">
        <!-- Level widget -->
        <h4 class="text-info">Adicionar Campos</h4>
          <select id="slc_field" name="field_id" class="custom-select" autofocus data-field="{{$collection}}">
            <option>Selecione ...</option>
            @foreach($fields as $field)
            <option value="{{ $field->name }}" >{{ $field->description }}</option>
            @endforeach
          </select>
                
      </div>
      
    </div>
  </div>

  </br>


         
</main>
@endsection
