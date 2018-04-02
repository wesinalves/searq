@extends('layouts.dashlayout')

@section('content')
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
   <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
       <li class="breadcrumb-item active" aria-current="page">Tipologia documental</li>
     </ol>
   </nav>
   <h1>Tipologia Documental</h1>
   <div class="row">
     <div class='col-md-6'>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nome</th>
            <th scope="col" ></th>
            
          </tr>
        </thead>
        <tbody>
          @foreach($types as $index=>$type)
          <tr>
            <th scope="row">{{++$index + $types->perPage() * ($types->currentPage() - 1)}}</th>
            <td>{{$type->name}}</td>
            <td align="right"><button type="button" class="btn btn-success" id="editType" data-type="{{$type}}">Editar</button>
            <a href="{{route('type.delete',['type_id'=>$type->id])}}" class="btn btn-danger">Excluir</a></td>
           </tr>
           @endforeach
                
          </tr>
        </tbody>
      </table>

    {{$types->links()}}
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Criar nova tipologia</h5>
          <form action="{{route('type.create')}}" method="post">
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
        <h5 class="modal-title" id="exampleModalLabel">Editar Tipologia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method='post' action="{{route('type.update')}}">
          <div class="form-group">
            <label for='name' >Nome</label>
            <input type="text" class="form-control" id="name2" name="name">
            </div>

            {{ csrf_field() }}

            <input type="hidden" name="id" id="type_id2">
            
            <button type="submit" class="btn btn-primary">Salvar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </form>

      </div>
      
    </div>
  </div>
</div>
@endsection