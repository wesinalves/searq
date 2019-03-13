@extends('layouts.dashlayout')

@section('content')


<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
   <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
       <li class="breadcrumb-item" aria-current="page"><a href="{{route('idiom')}}">Idioma  
       </a></li>
       <li class="breadcrumb-item active" aria-current="page">Idioma > Documentos</li>
     </ol>
   </nav>
   <h1>Documentos relacionados</h1>
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
     <div class='col-md-7'>
      
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Título</th>
            
            
          </tr>
        </thead>
        <tbody>
          @foreach($collections as $index=>$collection)
          
          <tr>
            <th scope="row">{{++$index}}</th>
            <td><a href="{{route('collection.view', ['collection_id'=>$collection->id])}}">{{$collection->title}}</a></td>
            
          </tr>
           @endforeach
                
          </tr>
        </tbody>
      </table>

    {{$collections->links()}}
    
    </div>

      
</main>


@endsection