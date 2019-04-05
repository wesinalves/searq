<div class='col-md-3'>
    <div class="widget">
      <!-- Level widget -->
      <h4 class="text-info">Subníveis</h4>
      @if(count($collection->collections()->where('published',1)->get()) > 0)
        <ul class="list-group">
        @foreach($collection->collections()->where('published',1)->orderBy('id','asc')->paginate(50) as $index=>$sub_collection)
          <li class="list-group-item"><a href="{{route('background.view',['collection_id'=>$sub_collection->id])}}">{{$sub_collection->level->name}}-{{str_limit($sub_collection->title,30)}} </a>
            @if(count($sub_collection->collections()->where('published',1)->get()) > 0)
            <img src="{{asset('images/arrow-down.png')}}" alt="exibir mais" data-toggle="collapse" href="#collapseLevel{{$index}}" role="button" aria-expanded="false" aria-controls="collapseLevel" style="cursor:pointer">
              <div class="collapse" id="collapseLevel{{$index}}">
                @foreach($sub_collection->collections()->where('published',1)->orderBy('id','asc')->paginate(5) as $sub_collection2)
                  <a class= "text-secondary" href="{{route('background.view',['collection_id'=>$sub_collection2->id])}}">- {{$sub_collection2->level->name}}-{{str_limit($sub_collection2->title,30)}} </a><br>
                @endforeach
                 @if(count($sub_collection->collections()->where('published',1)->get()) > 5)
                  <a class= "text-secondary" href="{{route('collection.view',['collection_id'=>$sub_collection->id])}}">mais...</a>
                @endif
              </div>
            @endif
          </li>
        @endforeach
        </ul>
        <br>

        {{$collection->collections()->where('published',1)->orderBy('title','desc')->paginate(50)->links()}}

      @else
        <p class="text-muted">Nenhum cadastrado</p>
      @endif
        
    </div>
    <hr>

    <!-- Digital Object widget -->
    <div class="widget">
      <h4 class="text-info">Objeto Digital</h4>
      @if(count($collection->objects) > 0)
        <ul class="list-group">
        @foreach($collection->objects as $object)
          <li class="list-group-item"><a href="{{route('download',['file'=>$object->id ]) }}">
            {{str_limit($object->path,20)}} - {{$object->type}} - {{round(Storage::size($object->path)/(1024*1024),2)}}MB</a>
            
          </li>
        @endforeach
        </ul>
        <br>
      @else
        <p class="text-muted">Nenhum cadastrado</p>
      @endif
      
    </div>
    <hr>

    <!-- Dimension widget -->
    <div class="widget">
      <h4 class="text-info">Dimensão e suporte</h4>
      @if(count($collection->dimensions) > 0)
        <ul class="list-group">
        @foreach($collection->dimensions as $dimension)
          <li class="list-group-item">{{$dimension->name}}, ({{$dimension->size}}) {{$dimension->type}}
            
          </li>
        @endforeach
        </ul>
        <br>
      @else
        <p class="text-muted">Nenhum cadastrado</p>
      @endif        
      
    </div>
    
    <hr>
    
</div>