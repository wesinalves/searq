@extends('layouts.dashlayout')

@section('content')
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Fundos</li>
      </ol>
    </nav>
    <h1>Fundos</h1>
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
        @foreach($collections as $collection)
        <div class="col-sm-3">        
          <div class="card">
            @if(count($collection->objects()->where('type','jpg')->get()) > 0)
            <img src="{{Storage::url($collection->objects()->where('type','jpg')->first()->path)}}" class="card-img-top" alt="{{Storage::url($collection->objects()->where('type','jpg')->first()->path)}}">
            @endif
             <div class="card-body">
              
              <h5 class="card-title">{{str_limit($collection->title,15)}}</h5>
                          
              <p class="text-warning">{{str_limit($collection->code,15)}}</p>
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
