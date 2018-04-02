@extends('layouts.dashlayout')

@section('content')
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
   <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
       <li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
     </ol>
   </nav>
   <h1>Cadastrar Acervo</h1>
    
    <form action="{{ route('collection.create') }}" method="post">
      <fieldset>
        <legend>1. Área de identificação</legend>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="code">Código de referência</label>
          <input type="text" class="form-control " id="code" name="code" size="250" autofocus >
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
        <legend>2. Área de contextualização</legend>
        <div class="form-row">
             
        
          <div class="form-group col-md-3">
            <label for="history">História arquivística</label>
            <textarea class="form-control " id="history" name="history" cols="250" rows="5"></textarea>
          </div>
          <div class="form-group col-md-3">
            <label for="origin">Procedência</label>
            <textarea class="form-control " id="origin" name="origin" cols="250" rows="5"></textarea>
          </div>
          <div class="form-group col-md-3">
            <label for="producer">Nomes dos produtores</label> <img src="{{ asset('images/add-icon.png')}}">
            <select id="producer" name="producers[]" class="custom-select custom-select-sm js-example-basic-multiple" multiple>
              @foreach($producers as $producer)
                <option value="{{ $producer->id }}">{{ $producer->name }}</option>
              @endforeach
              
            </select>
          </div>

      </div>
      <div class="form-row">
          <div class="form-group col-md-6">
            <label for="biography">História administrativa/biografia</label>
            <textarea class="form-control " id="biography" name="biography" cols="250" rows="5"></textarea>
          </div>
        
      </div>
      </fieldset>
      <fieldset>
        <legend>3. Área de conteúdo e estrutura</legend>
        <div class="form-row">
        
          <div class="form-group col-md-3">
            <label for="evaluate">Avaliação, eliminação, temporalidade</label>
            <textarea class="form-control " id="evaluate" name="evaluate" cols="250" rows="5"></textarea>
          </div>
        
          <div class="form-group col-md-3">
            <label for="incorporation">Incorporações</label>
            <textarea class="form-control " id="incorporation" name="incorporation" cols="250" rows="5"></textarea>
          </div>
          <div class="form-group col-md-3">
            <label for="level_system">Sistema de arranjo</label>
            <textarea class="form-control " id="level_system" name="level_system" cols="250" rows="5"></textarea>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="content">Âmbito e conteúdo</label>
            <textarea class="form-control " id="content" name="content" cols="250" rows="5"></textarea>
          </div>        
        </div>
      </fieldset>
      <fieldset>
        <legend>4. Área de condições de acesso e uso</legend>
        <div class="form-row">
          <div class="form-group col-md-3">
            <label for="features">Características físicas e requisitos</label>
            <textarea class="form-control " id="features" name="features" cols="250" rows="5"></textarea>
          </div>
          <div class="form-group col-md-3">
            <label for="tools">Instrumentos de pesquisa</label>
            <textarea class="form-control " id="tools" name="tools" cols="250" rows="5"></textarea>
          </div>
          <div class="form-group col-md-3">
            <label for="reproduction">Condições de reprodução</label>
            <textarea class="form-control " id="reproduction" name="reproduction" cols="250" rows="5"></textarea>
          </div>
        </div>
        <div class="form-row">
        
          <div class="form-group col-md-3">
            <label for="level">Condições de Acesso</label>
            <select id="access" name="access" class="custom-select">
                <option>Selecione ...</option>
                <option value="restricted">Restrito</option>
                <option value="private">Pessoal</option>
                <option value="public">Publico</option>
              
            </select>
          </div>

          
        
          <div class="form-group col-md-3">
            <label for="idiom">Idioma</label> <img src="{{ asset('images/add-icon.png')}}">
            <select id="idiom" name="idioms[]" class="custom-select custom-select-sm js-example-basic-multiple" multiple>
              @foreach($idioms as $idiom)
                <option value="{{ $idiom->id }}">{{ $idiom->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </fieldset>
      <fieldset>
        <legend>5. Área de fontes relacionadas</legend>
        <div class="form-row">
        
          <div class="form-group col-md-3">
            <label for="origin_localization">Existência e localização de originais</label>
            <textarea class="form-control " id="origin_localization" name="origin_localization" cols="250" rows="5"></textarea>
          </div>        

          <div class="form-group col-md-3">
            <label for="copy_localization">Existência e localização de cópias</label>
            <textarea class="form-control " id="copy_localization" name="copy_localization" cols="250" rows="5"></textarea>
          </div>
        
          <div class="form-group col-md-3">
            <label for="unit_description">Unidades de descrição relacionadas</label>
            <textarea class="form-control " id="unit_description" name="unit_description" cols="250" rows="5"></textarea>
          </div>
          <div class="form-group col-md-3">
            <label for="publish_note">Nota sobre publicação</label>
            <textarea class="form-control " id="publish_note" name="publish_note" cols="250" rows="5"></textarea>
          </div>
        </div>
      </fieldset>
      <fieldset>
        <legend>6. Área de notas</legend>
        <div class="form-row">
        
          <div class="form-group col-md-3">
            <label for="conservation_note">Notas sobre conservação</label>
            <textarea class="form-control " id="conservation_note" name="conservation_note" cols="250" rows="5"></textarea>
          </div>
          <div class="form-group col-md-3">
            <label for="general_note">Notas gerais</label>
            <textarea class="form-control " id="general_note" name="general_note" cols="250" rows="5"></textarea>
          </div>
        </div>
      </fieldset>
      <fieldset>
        <legend>7. Área de controle da descrição</legend>
        <div class="form-row">
        
          <div class="form-group col-md-3">
            <label for="professional_note">Nota do arquivista</label>
            <textarea class="form-control " id="professional_note" name="professional_note" cols="250" rows="5"></textarea>
          </div>
          <div class="form-group col-md-3">
            <label for="rules">Regras e convenções</label>
            <textarea class="form-control " id="rules" name="rules" cols="250" rows="5"></textarea>
          </div>
          <div class="form-group col-md-3">
            <label for="description_date">Data(s) da(s) descrição(ões)</label>
            <textarea class="form-control " id="description_date" name="description_date" cols="250" rows="5"></textarea>
          </div>
        </div>
      </fieldset>
      <fieldset>
        <legend>8. Área de pontos de acesso e indexação de assuntos</legend>
        <div class="form-row">
          <div class="form-group col-md-3">
            <label for="type">Tipologia documental</label> <img src="{{ asset('images/add-icon.png')}}">
            <select id="type" class="custom-select custom-select-sm js-example-basic-multiple" name="types[]" multiple>
              @foreach($types as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group col-md-3">
            <label for="subject">Assunto</label> <img src="{{ asset('images/add-icon.png')}}">
            <select id="subject" name="subjects[]" class="custom-select custom-select-sm js-example-basic-multiple" multiple>
              @foreach($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group col-md-3">
            <label for="local">Locais</label> <img src="{{ asset('images/add-icon.png')}}">
            <select id="local" name="locales[]" class="custom-select custom-select-sm js-example-basic-multiple" multiple>
              @foreach($locales as $local)
                <option value="{{ $local->id }}">{{ $local->name }}</option>
              @endforeach
            </select>
          </div>
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
  </br>


         
</main>
@endsection
