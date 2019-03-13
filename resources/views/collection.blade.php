@extends('layouts.dashlayout')

@section('content')
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
   <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
       <li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
     </ol>
   </nav>
   <h1>Cadastrar Fundo</h1>
   @if ($errors->any())
       <div class="alert alert-danger alert-dismissible fade show" role="alert">
           <ul>
               @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
           </ul>
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
       </div>
   @endif

   @if (session('message'))
     <div class="alert alert-success alert-dismissible fade show" role="alert">
         {{ session('message') }}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
     </div>
    @endif
    
    <form action="{{ route('collection.create') }}" method="post">
      <fieldset>
        <legend>1. Área de identificação</legend>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="code">Código de referência*</label>
          <input type="text" class="form-control " id="code" name="code" size="250" autofocus value="{{session('code')}}">
        </div>
        <div class="form-group col-md-4">
          <label for="title">Título*</label>
          <input type="text" class="form-control " id="title" name="title" size="250" value="{{session('title')}}">
        </div>
        <div class="form-group col-md-4">
          <label for="level">Nível de descrição*</label> 
          <select id="level" name="level" class="custom-select" onchange="this.value = '7'">
              <option>Selecione ...</option>
            @foreach($levels as $level)
              <option value="{{ $level->id }}" {{($level->id == 7)?'selected':''}}>{{ $level->name }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="start_date">Ano Inicial</label>
          <input type="text" class="form-control " id="start_date" name="start_date" maxlength="4" placeholder="YYYY" value="{{session('start_date')}}">
        </div>
        <div class="form-group col-md-4">
          <label for="end_date">Ano Final</label>
          <input type="text" class="form-control " id="end_date" name="end_date" maxlength="4" placeholder="YYYY" value="{{session('end_date')}}">
        </div>
        

      </div>
      
      </fieldset>
      <fieldset>
        <legend>2. Área de contextualização</legend>
        <div class="form-row">
             
        
          <div class="form-group col-md-3">
            <label for="history">História arquivística</label>
            <textarea class="form-control " id="history" name="history" cols="250" rows="5">{{session('history')}}</textarea>
          </div>
          <div class="form-group col-md-3">
            <label for="origin">Procedência</label>
            <textarea class="form-control " id="origin" name="origin" cols="250" rows="5">{{session('origin')}}</textarea>
          </div>
          <div class="form-group col-md-3">
            <label for="producer">Nomes dos produtores</label> <a href="#producerModal" data-toggle="modal"><img src="{{ asset('images/add-icon.png')}}"></a>
            <select id="producer" name="producers[]" class="custom-select custom-select-sm js-example-basic-multiple" multiple>
              @foreach($producers as $producer)
                <option value="{{ $producer->id }}" {{(session('producers'))?(in_array($producer->id,session('producers'))?'selected':''):''}}>{{ $producer->name }}</option>
              @endforeach
              
            </select>
          </div>

      </div>
      <div class="form-row">
          <div class="form-group col-md-6">
            <label for="biography">História administrativa/biografia</label>
            <textarea class="form-control " id="biography" name="biography" cols="250" rows="5">{{session('biography')}}</textarea>
          </div>
        
      </div>
      </fieldset>
      <fieldset>
        <legend>3. Área de conteúdo e estrutura</legend>
        <div class="form-row">
        
          <div class="form-group col-md-3">
            <label for="evaluate">Avaliação, eliminação, temporalidade</label>
            <textarea class="form-control " id="evaluate" name="evaluate" cols="250" rows="5">{{session('evaluate')}}</textarea>
          </div>
        
          <div class="form-group col-md-3">
            <label for="incorporation">Incorporações</label>
            <textarea class="form-control " id="incorporation" name="incorporation" cols="250" rows="5">{{session('incorporation')}}</textarea>
          </div>
          <div class="form-group col-md-3">
            <label for="level_system">Sistema de arranjo</label>
            <textarea class="form-control " id="level_system" name="level_system" cols="250" rows="5">{{session('level_system')}}</textarea>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="content">Âmbito e conteúdo</label>
            <textarea class="form-control " id="content" name="content" cols="250" rows="5">{{session('content')}}</textarea>
          </div>        
        </div>
      </fieldset>
      <fieldset>
        <legend>4. Área de condições de acesso e uso</legend>
        <div class="form-row">
          <div class="form-group col-md-3">
            <label for="features">Características físicas e requisitos</label>
            <textarea class="form-control " id="features" name="features" cols="250" rows="5">{{session('features')}}</textarea>
          </div>
          <div class="form-group col-md-3">
            <label for="tools">Instrumentos de pesquisa</label>
            <textarea class="form-control " id="tools" name="tools" cols="250" rows="5">{{session('tools')}}</textarea>
          </div>
          <div class="form-group col-md-3">
            <label for="reproduction">Condições de reprodução</label>
            <textarea class="form-control " id="reproduction" name="reproduction" cols="250" rows="5">{{session('reproduction')}}</textarea>
          </div>
        </div>
        <div class="form-row">
        
          <div class="form-group col-md-3">
            <label for="level">Condições de Acesso</label>
            <select id="access" name="access" class="custom-select">
                <option value="">Selecione ...</option>
                <option value="restricted" {{(session('access') == 'restricted')?'selected':''}}>Restrito</option>
                <option value="private" {{(session('access') == 'private')?'selected':''}}>Pessoal</option>
                <option value="public" {{(session('access') == 'public')?'selected':''}}>Publico</option>
              
            </select>
          </div>

          
        
          <div class="form-group col-md-3">
            <label for="idiom">Idioma</label> <a href="#idiomModal" data-toggle="modal"><img src="{{ asset('images/add-icon.png')}}"></a>
            <select id="idiom" name="idioms[]" class="custom-select custom-select-sm js-example-basic-multiple" multiple>
              @foreach($idioms as $idiom)
                <option value="{{ $idiom->id }}" {{(session('idioms'))?(in_array($idiom->id,session('idioms'))?'selected':''):''}}>{{ $idiom->name }}</option>
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
            <textarea class="form-control " id="origin_localization" name="origin_localization" cols="250" rows="5">{{session('origin_localization')}}</textarea>
          </div>        

          <div class="form-group col-md-3">
            <label for="copy_localization">Existência e localização de cópias</label>
            <textarea class="form-control " id="copy_localization" name="copy_localization" cols="250" rows="5">{{session('copy_localization')}}</textarea>
          </div>
        
          <div class="form-group col-md-3">
            <label for="unit_description">Unidades de descrição relacionadas</label>
            <textarea class="form-control " id="unit_description" name="unit_description" cols="250" rows="5">{{session('unit_description')}}</textarea>
          </div>
          <div class="form-group col-md-3">
            <label for="publish_note">Nota sobre publicação</label>
            <textarea class="form-control " id="publish_note" name="publish_note" cols="250" rows="5">{{session('publish_note')}}</textarea>
          </div>
        </div>
      </fieldset>
      <fieldset>
        <legend>6. Área de notas</legend>
        <div class="form-row">
        
          <div class="form-group col-md-3">
            <label for="conservation_note">Notas sobre conservação</label>
            <textarea class="form-control " id="conservation_note" name="conservation_note" cols="250" rows="5">{{session('conservation_note')}}</textarea>
          </div>
          <div class="form-group col-md-3">
            <label for="general_note">Notas gerais</label>
            <textarea class="form-control " id="general_note" name="general_note" cols="250" rows="5">{{session('general_note')}}</textarea>
          </div>
        </div>
      </fieldset>
      <fieldset>
        <legend>7. Área de controle da descrição</legend>
        <div class="form-row">
        
          <div class="form-group col-md-3">
            <label for="professional_note">Nota do arquivista</label>
            <textarea class="form-control " id="professional_note" name="professional_note" cols="250" rows="5">{{session('professional_note')}}</textarea>
          </div>
          <div class="form-group col-md-3">
            <label for="rules">Regras e convenções</label>
            <textarea class="form-control " id="rules" name="rules" cols="250" rows="5">{{session('rules')}}</textarea>
          </div>
          <div class="form-group col-md-3">
            <label for="description_date">Data(s) da(s) descrição(ões)</label>
            <textarea class="form-control " id="description_date" name="description_date" cols="250" rows="5">{{session('description_date')}}</textarea>
          </div>
        </div>
      </fieldset>
      <fieldset>
        <legend>8. Área de pontos de acesso e indexação de assuntos</legend>
        <div class="form-row">
          <div class="form-group col-md-3">
            <label for="type">Tipologia documental</label> <a href="#typeModal" data-toggle="modal"><img src="{{ asset('images/add-icon.png')}}"></a>
            <select id="type" class="custom-select custom-select-sm js-example-basic-multiple" name="types[]" multiple>
              @foreach($types as $type)
                <option value="{{ $type->id }}" {{(session('types'))?(in_array($type->id,session('types'))?'selected':''):''}}>{{ $type->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group col-md-3">
            <label for="subject">Assunto</label> <a href="#subjectModal" data-toggle="modal"><img src="{{ asset('images/add-icon.png')}}"></a>
            <select id="subject" name="subjects[]" class="custom-select custom-select-sm js-example-basic-multiple" multiple>
              @foreach($subjects as $subject)
                <option value="{{ $subject->id }}" {{(session('subjects'))?(in_array($subject->id,session('subjects'))?'selected':''):''}}>{{ $subject->name }}</option>
              @endforeach
            </select>
          </div>

          <div class="form-group col-md-3">
            <label for="local">Locais</label> <a href="#localModal" data-toggle="modal"><img src="{{ asset('images/add-icon.png')}}"></a>
            <select id="local" name="locales[]" class="custom-select custom-select-sm js-example-basic-multiple" multiple>
              @foreach($locales as $local)
                <option value="{{ $local->id }}" {{(session('locales'))?(in_array($local->id,session('locales'))?'selected':''):''}}>{{ $local->name }}</option>
              @endforeach
            </select>
          </div>
        </div>

      </fieldset>

      {{ csrf_field() }}

      <div class="p-3 mb-2 bg-secondary">
        <button type="submit" name="btn_create" value="1" class="btn btn-primary btn-sm">Salvar</button>
        <button type="submit" name="btn_create_and_new" value="1" class="btn btn-primary btn-sm">Salvar e criar novo</button>
        <button type="submit" name="btn_create_session" value="1" class="btn btn-warning btn-sm">Salvar Rascunho</button>
        <a href="{{route('collection.delete_session')}}" class="btn btn-light btn-sm">Cancelar</a>
      </div>

    </form>
  </br>
         
</main>
@include('_collection_auxmodals')

<script type="text/javascript">
  var token = '{{ Session::token() }}';
  var url_createproducer = '{{route('producer.create_ajax')}}';
  var url_createlocal = '{{route('local.create_ajax')}}';
  var url_createtype = '{{route('type.create_ajax')}}';
  var url_createidiom = '{{route('idiom.create_ajax')}}';
  var url_createsubject = '{{route('subject.create_ajax')}}';
  

</script>

@endsection
