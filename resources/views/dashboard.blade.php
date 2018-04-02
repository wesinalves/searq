@extends('layouts.dashlayout')

@section('content')
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Acervo</li>
      </ol>
    </nav>
    <h1>Acervo</h1>
     <div class="row">
        @foreach($collections as $collection)
        <div class="col-sm-3">        
          <div class="card">
             <div class="card-body">
              <h5 class="card-title">{{str_limit($collection->title,15)}}</h5>
              @if(count($collection->objects()->where('type','jpeg')->get()) > 0)
            <img src="{{Storage::url($collection->objects()->where('type','jpeg')->first()->path)}}" class="rounded float-right" alt="{{Storage::url($collection->objects()->where('type','jpeg')->first()->path)}}" style="width:50px">
            @endif
              <p class="card-text">{{$collection->content}}
              </p>
              <p class="text-warning">{{str_limit($collection->code,15)}}</p>
              <p class="text-muted">{{$collection->published?'Publicado':'Não publicado'}}</p>
              <a href="{{route('collection.view',['collection_id'=>$collection->id])}}" class="btn btn-primary">Detalhes</a>
             </div>
           </div>
        </div>
        @endforeach

       
      </div>



    </div>
    
   <br>

    {{$collections->links()}}

           
         
</main>
@endsection
