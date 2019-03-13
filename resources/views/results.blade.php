@extends('layouts.searchlayout')

@section('content')
<!-- Begin page content -->
    <main role="main" class="container ">
      <nav aria-label="breadcrumb">
       <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="{{route('search')}}">Home</a></li>
         <li class="breadcrumb-item active"><a href="{{route('search')}}">Pesquisa</a></li>
         <li class="breadcrumb-item active" aria-current="page">Resultados</li>
       </ol>
     </nav>
      <div class="mt-3">
        <h1>Resultados da pesquisa</h1>
      </div>
      
      @if(isset($letter) and isset($descritor))
      <nav aria-label="Page navigation example">
        {{$collections->appends(['letter' => $letter, 'descritor'=>$descritor])->links()}}
      </nav>
      @elseif(isset($name) and isset($position) and isset($descritor))
      <nav aria-label="Page navigation example">
        {{$collections->appends(['txt_name' => $name, 'position'=>$position,'descritor'=>$descritor])->links()}}
      </nav>
      @elseif(isset($content))
      <nav aria-label="Page navigation example">
        {{$collections->appends(['content'=>$content])->links()}}
      </nav>
      @elseif(isset($terms) and isset($descritor))
      <nav aria-label="Page navigation example">
        {{$collections->appends(['slc_terms' => $terms, 'descritor'=>$descritor])->links()}}
      </nav>
      @elseif(isset($criteria))
      <nav aria-label="Page navigation example">
        {{$collections->appends(['inputCriteria' => $inputCriteria, 'criteria' => $criteria,'level'=>$level,'access'=>$access,'start_date'=>$start_date,'end_date'=>$end_date])->links()}}
      </nav>
      @endif

      @foreach($collections as $collection)

      <div class='result'>
        <p><span>Titulo:</span> <a href="{{route('background.view',['collection_id'=>$collection->id])}}">{{$collection->title}}<a/><br>
          <span>Conteúdo:</span> {{$collection->content}}<br>
          <span>Produtor:</span> 
          <?php

            for($i = 0; $i < count($collection->producers); $i++){
              $prod[$i] = $collection->producers[$i]->name;
            }
          ?>
          @if(isset($prod))
            {{implode(", ",$prod)}}
          @else
            Nenhum produtor cadastrado
          @endif
          <br>
          <span>Código:</span> {{$collection->code}}<br>
          <span>Ano de criação:</span> {{$collection->start_date}}
        </p>
        @foreach($collection->objects()->where('type','pdf')->get() as $object)
          <a href="{{route('download',['object_id'=>$object->id]) }}" >
            <img src="{{asset('images/pdf-icon.png')}}" ></a>
        @endforeach
        
        
      </div>

      @endforeach

      @if(isset($letter) and isset($descritor))
      <nav aria-label="Page navigation example">
        {{$collections->appends(['letter' => $letter, 'descritor'=>$descritor])->links()}}
      </nav>
      @elseif(isset($name) and isset($position) and isset($descritor))
      <nav aria-label="Page navigation example">
        {{$collections->appends(['txt_name' => $name, 'position'=>$position,'descritor'=>$descritor])->links()}}
      </nav>
      @elseif(isset($content))
      <nav aria-label="Page navigation example">
        {{$collections->appends(['content'=>$content])->links()}}
      </nav>
      @elseif(isset($terms) and isset($descritor))
      <nav aria-label="Page navigation example">
        {{$collections->appends(['slc_terms' => $terms, 'descritor'=>$descritor])->links()}}
      </nav>
      @elseif(isset($criteria))
      <nav aria-label="Page navigation example">
        {{$collections->appends(['inputCriteria' => $inputCriteria,'criteria' => $criteria, 'level'=>$level,'access'=>$access,'start_date'=>$start_date,'end_date'=>$end_date])->links()}}
      </nav>
      @endif

    </main>
@endsection