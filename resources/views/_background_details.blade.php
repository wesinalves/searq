 <div class='col-md-9'>
  <!-- collection identification -->
  @if(count($collection->objects()->where('type','jpg')->get()) > 0)
  <img src="{{Storage::url($collection->objects()->where('type','jpg')->first()->path)}}" class="rounded float-right img-thumbnail" alt="{{Storage::url($collection->objects()->where('type','jpg')->first()->path)}}" style="width:150px">
  @endif
  <h5>{{$collection->content}}</h5>
  <p class="text-warning">{{$collection->code}}</p>
  <p>{{$collection->start_date}} - {{$collection->end_date}}</p>
  <p>{{$collection->level->name}}</p>
  <p class="text-muted">{{$collection->published?'Publicado':'Não publicado'}}</p>

  <!-- All details about collection -->
  <p>
    <a class="btn btn-primary" data-toggle="collapse" href="#collapseDetails" role="button" aria-expanded="false" aria-controls="collapseDetails">
      Mais detalhes...
    </a>
  </p>
  <div class="collapse" id="collapseDetails">
 	  <table class="table table-sm">
   	<thead class="thead-dark">
      <tr>
        <th scope="col">Descritor</th>
        <th scope="col">Valor</th>            
      </tr>
    </thead>
    <tbody>

	   @foreach($collection->getAttributes() as $key => $attribute)
      @if($attribute != '')
	   		<tr>
          <th scope="row">@lang("collection.$key")</th>
          <td>{{$attribute}}</td>	            
       </tr>
       @endif
     @endforeach

   </table>
    

    <!-- area for notes widgets -->
    <div class="row">
        <div class="col-4">
          <div class="list-group" id="list-tab" role="tablist">
            @foreach($collection->notes as $index=>$note)
            <a class="list-group-item list-group-item-action {{($index==0)?'active':''}}" id="list-{{$note->type}}-list" data-toggle="list" href="#list-{{$note->type}}" role="tab" aria-controls="{{$note->type}}">{{$note->name}}</a>
            @endforeach
          </div>
        </div>
        <div class="col-8">
          <div class="tab-content" id="nav-tabContent">
            @foreach($collection->notes as $index=>$note)
            <div class="tab-pane fade {{($index==0)?'show active':''}}" id="list-{{$note->type}}" role="tabpanel" aria-labelledby="list-{{$note->type}}-list">{{$note->description}}
              
            </div>
            @endforeach
          </div>
        </div>
    </div>
    <br>
      <p>
        <a class="btn btn-primary" data-toggle="collapse" href="#collapseDetails" role="button" aria-expanded="false" aria-controls="collapseDetails">
          Menos detalhes...
        </a>
      </p>
  </div>

  <br>

  <!-- entities related to collection -->
  @include('_background_relations')
  
	
</div>
