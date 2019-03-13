@extends('layouts.dashlayout')

@section('content')
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
   <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
       <li class="breadcrumb-item active" aria-current="page">Assunto</li>
     </ol>
   </nav>
   <h1>Assunto</h1>
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
      <form action="{{route('subject')}}" id="search-form">
        <div class="form-group">
            <label for='name' class='sr-only'>Pesquisa</label>
            <input type="text" class="form-control" id="search" name="search" placeholder="pesquisar" onchange="event.preventDefault();
                           document.getElementById('search-form').submit();" value="{{session('session_subject')}}">
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
          @foreach($subjects as $index=>$subject)
          <tr>
            <th scope="row">{{++$index + $subjects->perPage() * ($subjects->currentPage() - 1)}}</th>
            <td><a href="{{route('subject.get_collections',['subject_id'=>$subject->id])}}">{{$subject->name}}</a></td>
            <td align="right"><button type="button" class="btn btn-success" id="editSubject" data-subject="{{$subject}}">Editar</button>
            <a href="{{route('subject.delete',['subject_id'=>$subject->id])}}" class="btn btn-danger">Excluir</a></td>
           </tr>
           @endforeach
                
          </tr>
        </tbody>
      </table>

    {{$subjects->links()}}

    @if($clear)
      <a class="btn btn-primary" href="{{route('subject.delete_session')}}">Limpar</a>
    @endif
    </div>
    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Criar novo assunto</h5>
          <form action="{{route('subject.create')}}" method="post">
            <div class="form-group">
            <label for='name' >Nome</label>
            <input type="text" class="form-control" id="name" name="name" >
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
        <h5 class="modal-title" id="exampleModalLabel">Editar Assunto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method='post' action="{{route('subject.update')}}">
          <div class="form-group">
            <label for='name' >Nome</label>
            <input type="text" class="form-control" id="name2" name="name">
            </div>

            {{ csrf_field() }}

            <input type="hidden" name="id" id="subject_id2">
            
            <button type="submit" class="btn btn-primary">Salvar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </form>

      </div>
      
    </div>
  </div>
</div>
@endsection