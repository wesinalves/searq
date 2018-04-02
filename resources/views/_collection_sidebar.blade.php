<div class='col-md-3'>
    <div class="widget">
      <!-- Level widget -->
      <h4 class="text-info">Níveis</h4>
      @if(count($collection->collections) > 0)
        <ul class="list-group">
        @foreach($collection->collections as $sub_collection)
          <li class="list-group-item">{{$sub_collection->name}}</li>
        @endforeach
        </ul>
        <br>
      @else
        <p class="text-muted">Nenhum cadastrado</p>
      @endif
        <form method="post" action="{{route('collection.form_level')}}" id="formLevel">
        <select id="slc_level" name="level_id" class="custom-select" autofocus>
          <option>Selecione ...</option>
          @foreach($levels as $level)
          <option value="{{ $level->id }}">{{ $level->name }}</option>
          @endforeach
        </select>
        {{ csrf_field() }}
        <input type="hidden" name="collection_id" value="{{$collection->id}}">
      </form>
    </div>
    <hr>

    <!-- Digital Object widget -->
    <div class="widget">
      <h4 class="text-info">Objeto Digital</h4>
      @if(count($collection->objects) > 0)
        <ul class="list-group">
        @foreach($collection->objects as $object)
          <li class="list-group-item">{{str_limit($object->path,20)}} - {{$object->type}} - {{round(Storage::size($object->path)/(1024*1024),2)}}MB
            <a id="{{$object->id}}" href="#" class="delobject text-danger" title="Remover item">(x)</a>
          </li>
        @endforeach
        </ul>
        <br>
      @else
        <p class="text-muted">Nenhum cadastrado</p>
      @endif
      <form method="post" action="{{route('object.attach')}}" enctype="multipart/form-data" id="formObject">
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="customFile" name="path">
        <label class="custom-file-label" for="customFile">Escolher arquivo</label>
      </div>
      {{ csrf_field() }}
      <input type="hidden" name="collection_id" value="{{$collection->id}}">
      <input type="hidden" name="type" value="jpeg">
      </form> 
    </div>
    <hr>

    <!-- Dimension widget -->
    <div class="widget">
      <h4 class="text-info">Dimensão e suporte</h4>
      @if(count($collection->dimensions) > 0)
        <ul class="list-group">
        @foreach($collection->dimensions as $dimension)
          <li class="list-group-item">{{$dimension->name}}, ({{$dimension->size}}) {{$dimension->type}}
            <a id="{{$dimension->id}}" href="#" class="deldimension text-danger" title="Remover item">(x)</a>
          </li>
        @endforeach
        </ul>
        <br>
      @else
        <p class="text-muted">Nenhum cadastrado</p>
      @endif        
      <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#dimensionModal">Inserir</button>
    </div>
    <hr>

    <!-- Action widget -->
    <div class="widget">
      <h4 class="text-info">Operações</h4>
      <a href="{{route('collection.edit',['collection_id'=>$collection->id])}}" class="btn btn-warning btn-sm btn-block">Editar</a>
      <button type="button" class="btn btn-danger btn-sm btn-block" id="btDelCollection" data-toggle="modal" data-target="#deleteModal" >Excluir</button>
      <a href="{{route('collection.publish',['collection_id'=>$collection->id]) }}" class="btn btn-primary btn-sm btn-block">{{($collection->published)?'Não publicar':'Publicar'}}</a>
    </div>  
</div>