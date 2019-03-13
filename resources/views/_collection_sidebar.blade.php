<div class='col-md-3'>
    <div class="widget">
      <!-- Level widget -->
      <h4 class="text-info">Subníveis</h4>
      @if(count($collection->collections) > 0)
        <ul class="list-group">
        @foreach($collection->collections()->orderBy('id','asc')->paginate(15) as $index=>$sub_collection)
          <li class="list-group-item"><a href="{{route('collection.view',['collection_id'=>$sub_collection->id])}}">{{($sub_collection->level->name == 'item' or $sub_collection->level->name == 'dossie')? substr($sub_collection->code, -4): ''}} {{$sub_collection->level->name}}-{{str_limit($sub_collection->title,30)}} </a>
            @if(count($sub_collection->collections) > 0)
            <img src="{{asset('images/arrow-down.png')}}" alt="exibir mais" data-toggle="collapse" href="#collapseLevel{{$index}}" role="button" aria-expanded="false" aria-controls="collapseLevel" style="cursor:pointer">
              <div class="collapse" id="collapseLevel{{$index}}">
                @foreach($sub_collection->collections()->orderBy('id','asc')->paginate(5) as $sub_collection2)
                  <a class= "text-secondary" href="{{route('collection.view',['collection_id'=>$sub_collection2->id])}}">- {{$sub_collection2->level->name}}-{{str_limit($sub_collection2->title,30)}} </a><br>
                @endforeach
                @if(count($sub_collection->collections) > 5)
                  <a class= "text-secondary" href="{{route('collection.view',['collection_id'=>$sub_collection->id])}}">mais...</a>
                @endif
              </div>
            @endif
          </li>
        @endforeach
        </ul>
        <br>

        {{$collection->collections()->orderBy('title','desc')->paginate(15)->links()}}
      @else
        <p class="text-muted">Nenhum cadastrado</p>
      @endif
        <form method="get" action="{{route('collection.form_level')}}" id="formLevel">
          <input type="hidden" name="collection_id" value="{{$collection->id}}">

          <select id="slc_level" name="level_id" class="custom-select">
            <option>Selecione ...</option>
            @foreach($levels as $level)
            <option value="{{ $level->id }}">{{ $level->name }}</option>
            @endforeach
          </select>
        
        
        </form>
    </div>
    <hr>

    <!-- Digital Object widget -->
    <div class="widget">
      <h4 class="text-info">Objeto Digital</h4>
      @if(count($collection->objects) > 0)
        <ul class="list-group">
        @foreach($collection->objects as $object)
          <li class="list-group-item"><a href="{{Storage::url($object->path)}}">{{str_limit($object->path,20)}} - {{$object->type}} - {{round(Storage::size($object->path)/(1024*1024),2)}}MB</a>
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
      <input type="hidden" name="type" id="object_type">
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
      <a href="{{route('collection.publish_hierarchy',['collection_id'=>$collection->id]) }}" class="btn btn-info btn-sm btn-block">{{($collection->published)?'Não publicar hierarquia':'Publicar hierarquia'}}</a>
    </div>  
</div>