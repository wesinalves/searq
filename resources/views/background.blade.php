@extends('layouts.searchlayout')

@section('content')
<!-- Begin page content -->
    <main role="main" class="container ">
      <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{route('search')}}">Home</a></li>
       <li class="breadcrumb-item active" aria-current="page">Fundos</li>
     </ol>
   </nav>
      <div class="mt-3">
        <h1>Fundos</h1>
      </div>
      
      <div class="row">
        @foreach($collections as $collection)
          <div class="col-sm-3">        
            <div class="card">
              @if(count($collection->objects()->where('type','jpg')->get()) > 0)
                <img src="{{Storage::url($collection->objects()->where('type','jpg')->first()->path)}}" class="rounded float-right" alt="{{Storage::url($collection->objects()->where('type','jpg')->first()->path)}}">
              @endif
               <div class="card-body">
                <h5 class="card-title">{{str_limit($collection->title,15)}}</h5>
                               
                <p class="text-warning">{{str_limit($collection->code,15)}}</p>
                <a href="{{route('background.view',['collection_id'=>$collection->id])}}" class="btn btn-primary">Detalhes</a>
               </div>
             </div>
          </div>
          @endforeach
      </div>
      


    </main>
@endsection