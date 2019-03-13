<div class="row">
    <div class="col-md-4">
      <h4 class="text-primary">Produtores <span class="badge badge-primary">{{count($collection->producers)}}</span> 
      </h4> 

        <producers>
        @foreach($collection->producers as $producer)
          <span class="badge badge-light">
            {{$producer->name}} 
          </span>
        @endforeach
      </producers>
           
    </div>
    <div class="col-md-4">
      <h4 class="text-success">Assuntos <span class="badge badge-success">{{count($collection->subjects)}}</span> 
      </h4>

       <subjects>
          @foreach($collection->subjects as $subject)
            <span class="badge badge-light">
              {{$subject->name}}
            </span>
          @endforeach
       </subjects>
    </div>


  </div>

  <div class="row">
    <div class="col-md-4">
      <h4 class="text-warning">Locais <span class="badge badge-warning">{{count($collection->locales)}}</span> 
      </h4>

        <locales>
         @foreach($collection->locales as $local)
          <span class="badge badge-light">
            {{$local->name}}
          </span>
        @endforeach
      </locales>
      
    </div>
    <div class="col-md-4">
      <h4 class="text-danger">Idiomas <span class="badge badge-danger">{{count($collection->idioms)}}</span> 
      </h4>

        <idioms>
          @foreach($collection->idioms as $idiom)
            <span class="badge badge-light">
              {{$idiom->name}}
            </span>
          @endforeach
        </idioms>
        </div>    
  </div>
  <div class="row">
    <div class="col-md-4">
      <h4 class="text-info">Tipologia <span class="badge badge-info">{{count($collection->types)}}</span> 
      </h4>
        
        <types>
         @foreach($collection->types as $type)
          <span class="badge badge-light">
            {{$type->name}}
          </span>
        @endforeach
      </types>
      
    </div>

  </div>
  <br>