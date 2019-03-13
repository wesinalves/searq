@extends('layouts.dashlayout')

@section('content')


<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
   <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
       <li class="breadcrumb-item active" aria-current="page">Produtor</li>
     </ol>
   </nav>
   <h1>Produtor</h1>
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
     <div class='col-md-6'>
      <form action="{{route('producer')}}" id="search-form">
        <div class="form-group">
            <label for='name' class='sr-only'>Pesquisa</label>
            <input type="text" class="form-control" id="search" name="search" placeholder="pesquisar" onchange="event.preventDefault();
                           document.getElementById('search-form').submit();" value="{{session('session_producer')}}">
        </div>
      </form>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col" ></th>
            
          </tr>
        </thead>
        <tbody>
          @foreach($producers as $index=>$producer)
          <tr>
            <th scope="row">{{++$index + $producers->perPage() * ($producers->currentPage() - 1)}}</th>
            <td><a href="{{route('producer.get_collections', ['producer_id'=>$producer->id])}}">{{$producer->name}}</a></td>
            <td align="right"><button type="button" class="btn btn-success" id="editProducer" data-producer="{{$producer}}">Editar</button>
            <a href="{{route('producer.delete',['producer_id'=>$producer->id])}}" class="btn btn-danger">Excluir</a></td>
           </tr>
           @endforeach
                
          </tr>
        </tbody>
      </table>

    {{$producers->links()}}
    @if($clear)
      <a class="btn btn-primary" href="{{route('producer.delete_session')}}">Limpar</a>
    @endif
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Criar novo produtor</h5>
          <form action="{{route('producer.create')}}" method="post">
            <div class="form-group">
            <label for='name' >Nome</label>
            <input type="text" class="form-control" id="name" name="name">
            </div>

            {{ csrf_field() }}
            
            <button type="submit" class="btn btn-primary">Salvar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  
</main>

<!-- Modal -->
<div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Produtor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method='post' action="{{route('producer.update')}}">
          <div class="form-group">
            <label for='name' >Nome</label>
            <input type="text" class="form-control" id="name2" name="name">
            </div>

            {{ csrf_field() }}

            <input type="hidden" name="id" id="producer_id2">
            
            <button type="submit" class="btn btn-primary">Salvar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </form>

      </div>
      
    </div>
  </div>
</div>



@endsection