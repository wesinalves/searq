@extends('layouts.dashlayout')

@section('content')
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
  <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
       <li class="breadcrumb-item"><a href="{{route('collection.view',['collection_id'=>$collection->id])}}">Fundos</a></li>
      @if(isset($collection->collection->collection))
          <li class="breadcrumb-item"><a href="{{route('collection.view',['collection_id'=>$collection->collection->collection->id])}}">{{str_limit($collection->collection->collection->title,50)}}</a></li>
        @endif
        @if(isset($collection->collection))
          <li class="breadcrumb-item"><a href="{{route('collection.view',['collection_id'=>$collection->collection->id])}}">{{str_limit($collection->collection->title,50)}}</a></li>
        @endif
       <li class="breadcrumb-item"><a href="{{route('collection.view',['collection_id'=>$collection->id])}}">{{str_limit($collection->title,15)}}</a></li>
       <li class="breadcrumb-item">Níveis</li>
       <li class="breadcrumb-item active" aria-current="page">Cadastrar</li>
     </ol>
  </nav>
   <h1>Cadastrar Itens/Dossiê</h1>

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

  <div class="row">
    <div class="col-md-9"> 
      <h5>{{$collection->title}}</h5>
      <p>{{$collection->start_date}} - {{$collection->end_date}}</p>     

      <form action="{{ route('collection.create_child') }}" method="post">
        <fieldset>
          <legend>1. Área de identificação</legend>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="code">Código de referência*</label>
            <input type="text" class="form-control " id="code" name="code" size="250" value="{{$collection->code}}">
          </div>
          <div class="form-group col-md-4">
            <label for="title">Título*</label>
            <input type="text" class="form-control " id="title" name="title" size="250">
          </div>
          <div class="form-group col-md-4">
            <label for="level">Nível de descrição*</label> 
            <select id="level" name="level" class="custom-select" onchange="this.value = '{{$level_id}}'">
                <option>Selecione ...</option>
              @foreach($levels as $level)
                <option value="{{ $level->id }}" {{($level->id == $level_id)?'selected':''}}>{{ $level->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="start_date">Data Inicial</label>
            <input type="text" class="form-control " id="start_date" name="start_date" maxlength="4" placeholder="YYYY">
          </div>
          <div class="form-group col-md-4">
            <label for="end_date">Data Final</label>
            <input type="text" class="form-control " id="end_date" name="end_date" maxlength="4" placeholder="YYYY">
          </div>
          

        </div>
        
        </fieldset>

        <fieldset>
          <legend>2. Área de contextualização</legend>
          <div class="form-row">
                              
            <div class="form-group col-md-4">
              <label for="producer">Nomes dos produtores</label> <a href="#producerModal" data-toggle="modal"><img src="{{ asset('images/add-icon.png')}}"></a>
              <select id="producer" name="producers[]" class="custom-select custom-select-sm js-example-basic-multiple" multiple>
                @foreach($producers as $producer)
                  <option value="{{ $producer->id }}">{{ $producer->name }}</option>
                @endforeach
                
              </select>
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
            
          </div>
        </fieldset>

        <fieldset>
          <legend>4. Área de condições de acesso e uso</legend>
          
          <div class="form-row">
          
            <div class="form-group col-md-4">
              <label for="level">Condições de Acesso</label>
              <select id="access" name="access" class="custom-select">
                  <option value="">Selecione ...</option>
                  <option value="restricted">Restrito</option>
                  <option value="private">Pessoal</option>
                  <option value="public">Publico</option>
                
              </select>
            </div>  

            
          
            <div class="form-group col-md-4">
              <label for="idiom">Idioma</label> <a href="#idiomModal" data-toggle="modal"><img src="{{ asset('images/add-icon.png')}}"></a>
              <select id="idiom" name="idioms[]" class="custom-select custom-select-sm js-example-basic-multiple" multiple>
                @foreach($idioms as $idiom)
                  <option value="{{ $idiom->id }}">{{ $idiom->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </fieldset>

        <fieldset>
          <legend>8. Área de pontos de acesso e indexação de assuntos</legend>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="type">Tipologia documental</label> <a href="#typeModal" data-toggle="modal"><img src="{{ asset('images/add-icon.png')}}"></a>
              <select id="type" class="custom-select custom-select-sm js-example-basic-multiple" name="types[]" multiple>
                @foreach($types as $type)
                  <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group col-md-4">
              <label for="subject">Assunto</label> <a href="#subjectModal" data-toggle="modal"><img src="{{ asset('images/add-icon.png')}}"></a>
              <select id="subject" name="subjects[]" class="custom-select custom-select-sm js-example-basic-multiple" multiple>
                @foreach($subjects as $subject)
                  <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group col-md-4">
              <label for="local">Locais</label> <a href="#localModal" data-toggle="modal"><img src="{{ asset('images/add-icon.png')}}"></a>
              <select id="local" name="locales[]" class="custom-select custom-select-sm js-example-basic-multiple" multiple>
                @foreach($locales as $local)
                  <option value="{{ $local->id }}">{{ $local->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

        </fieldset>

        <fieldset id="add_fields" class="d-none">
          <legend>Campos adicionais</legend>
          <div class="form-row" id="form_fields" >
            
          </div>
        </fieldset>
      
        <input type="hidden" name="collection_id" value="{{$collection->id}}">

        {{ csrf_field() }}

        <div class="p-3 mb-2 bg-secondary">
          <button type="submit" name="btn_create" value="1" class="btn btn-primary btn-sm">Salvar</button>
          <button type="submit" name="btn_create_and_new" value="1" class="btn btn-primary btn-sm">Salvar e criar novo</button>
          <button type="button" class="btn btn-light btn-sm" onclick="location.reload()">Cancelar</button>
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
