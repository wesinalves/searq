<div class="row">
    <div class="col-md-4">
      <h4 class="text-primary">Produtores <span class="badge badge-primary">{{count($collection->producers)}}</span> 
        <a class="text-primary" title="inserir produtor" data-toggle="collapse" href="#collapseProducer" role="button" aria-expanded="false" aria-controls="collapseProducer">+</a>
      </h4> 
        <div class="collapse" id="collapseProducer">
            <label class="sr-only" for="slc_producer">Produtores</label>
            <select id="slc_producer" name="producer" class="custom-select">
              <option>Selecione...</option>
              @foreach($producers as $producer)
                <option value="{{ $producer->id }}">{{ $producer->name }}</option>
              @endforeach
              
            </select>
        </div>
        <producers>
        @foreach($collection->producers as $producer)
          <span class="badge badge-light">
            {{$producer->name}} <a id="{{$producer->id}}" href="#" class="delproducer text-danger" title="Remover item">(x)</a>
          </span>
        @endforeach
      </producers>
           
    </div>
    <div class="col-md-4">
      <h4 class="text-success">Assuntos <span class="badge badge-success">{{count($collection->subjects)}}</span> 
        <a class="text-success" title="inserir assuntos" data-toggle="collapse" href="#collapseSubject" role="button" aria-expanded="false" aria-controls="collapseSubject">+</a>
      </h4>
        <div class="collapse" id="collapseSubject">
          <label for="slc_subject" class="sr-only">Assuntos:</label>
            <select id="slc_subject" name="subject" class="custom-select">
              <option>Selecione...</option>
              @foreach($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
              @endforeach
              
            </select>
        </div>
       <subjects>
          @foreach($collection->subjects as $subject)
            <span class="badge badge-light">
              {{$subject->name}}
              <a id="{{$subject->id}}" href="#" class="delsubject text-danger" title="Remover item">(x)</a>
            </span>
          @endforeach
       </subjects>
    </div>


  </div>

  <div class="row">
    <div class="col-md-4">
      <h4 class="text-warning">Locais <span class="badge badge-warning">{{count($collection->locales)}}</span> 
        <a class="text-warning" title="inserir locais" data-toggle="collapse" href="#collapseLocal" role="button" aria-expanded="false" aria-controls="collapseLocal">+</a>
      </h4>
        <div class="collapse" id="collapseLocal">
          <label for="slc_local" class="sr-only">Nomes dos locais:</label>
            <select id="slc_local" name="local" class="custom-select">
              <option>Selecione...</option>
              @foreach($locales as $local)
                <option value="{{ $local->id }}">{{ $local->name }}</option>
              @endforeach
              
            </select>
        </div>
        <locales>
         @foreach($collection->locales as $local)
          <span class="badge badge-light">
            {{$local->name}}
            <a id="{{$local->id}}" href="#" class="dellocal text-danger" title="Remover item">(x)</a>
          </span>
        @endforeach
      </locales>
      
    </div>
    <div class="col-md-4">
      <h4 class="text-danger">Idiomas <span class="badge badge-danger">{{count($collection->idioms)}}</span> 
        <a class="text-danger" title="inserir idiomas" data-toggle="collapse" href="#collapseIdiom" role="button" aria-expanded="false" aria-controls="collapseIdiom">+</a>
      </h4>
        <div class="collapse" id="collapseIdiom">
          <label for="slc_idiom" class="sr-only">Nomes dos idiomas:</label>
            <select id="slc_idiom" name="idiom" class="custom-select">
              <option>Selecione...</option>
              @foreach($idioms as $idiom)
                <option value="{{ $idiom->id }}">{{ $idiom->name }}</option>
              @endforeach
              
            </select>
        </div>
        <idioms>
          @foreach($collection->idioms as $idiom)
            <span class="badge badge-light">
              {{$idiom->name}}
              <a id="{{$idiom->id}}" href="#" class="delidiom text-danger" title="Remover item">(x)</a>
            </span>
          @endforeach
        </idioms>
        </div>    
  </div>
  <div class="row">
    <div class="col-md-4">
      <h4 class="text-info">Tipologia <span class="badge badge-info">{{count($collection->types)}}</span> 
        <a class="text-info" title="inserir tipologia" data-toggle="collapse" href="#collapseType" role="button" aria-expanded="false" aria-controls="collapseType">+</a>
      </h4>
        <div class="collapse" id="collapseType">
          <label for="slc_type" class="sr-only">Tipologia:</label>
            <select id="slc_type" name="local" class="custom-select">
              <option>Selecione...</option>
              @foreach($types as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
              @endforeach
              
            </select>
        </div>
        <types>
         @foreach($collection->types as $type)
          <span class="badge badge-light">
            {{$type->name}}
            <a id="{{$type->id}}" href="#" class="deltype text-danger" title="Remover item">(x)</a>
          </span>
        @endforeach
      </types>
      
    </div>

  </div>
  <br>