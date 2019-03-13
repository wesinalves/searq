@extends('layouts.dashlayout')

@section('content')
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
   <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
       <li class="breadcrumb-item active" aria-current="page">Usuário</li>
     </ol>
   </nav>
   <h1>Usuário</h1>
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
    <div class='col-md-6' >

      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="admin-tab" data-toggle="tab" href="#admin" role="tab" aria-controls="admin" aria-selected="true">Administradores</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="user-tab" data-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="false">Usurários</a>
        </li>
        
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="admin" role="tabpanel" aria-labelledby="admin-tab">
            <table class="table mt-2">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nome</th>
                  <th scope="col" ></th>
                  
                </tr>
              </thead>
              <tbody>
                @foreach($admins as $index=>$admin)
                <tr>
                  <th scope="row">{{++$index + $admins->perPage() * ($admins->currentPage() - 1)}}</th>
                  <td>{{$admin->name}}</td>
                  <td align="right"><button type="button" class="btn btn-success" id="editAdmin" data-admin="{{$admin}}">Editar</button>
                  <a href="{{route('admin.delete',['admin_id'=>$admin->id])}}" class="btn btn-danger">Excluir</a></td>
                  </tr>
                 @endforeach
                      
                </tr>
              </tbody>
            </table>
            {{$admins->links()}}

        </div>
        <div class="tab-pane fade" id="user" role="tabpanel" aria-labelledby="user-tab">
          <table class="table mt-2">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nome</th>
                  <th scope="col" ></th>
                  
                </tr>
              </thead>
              <tbody>
                @foreach($users as $index=>$user)
                <tr>
                  <th scope="row">{{++$index + $users->perPage() * ($users->currentPage() - 1)}}</th>
                  <td>{{$user->name}}</td>
                  <td align="right"><button type="button" class="btn btn-success" id="editUser" data-user="{{$user}}">Editar</button>
                  <a href="{{route('user.delete',['user_id'=>$user->id])}}" class="btn btn-danger">Excluir</a></td>
                 </tr>
                 @endforeach
                      
                </tr>
              </tbody>
            </table>
            {{$users->links()}}
        </div>
        
      </div>
      
    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Criar novo administrador</h5>
          <form class="form-horizontal" method="POST" action="{{ route('admin.register.submit') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="control-label">Name</label>

                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required >

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label">E-Mail Address</label>

                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group{{ $errors->has('job_title') ? ' has-error' : '' }}">
                <label for="job_title" class="control-label">Função</label>

                    <input id="job_title" type="text" class="form-control" name="job_title" value="{{ old('job_title') }}" required>

                    @if ($errors->has('job_title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('job_title') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="control-label">Password</label>

                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group">
                <label for="password-confirm" class="control-label">Confirm Password</label>

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>

            <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Salvar
                    </button>
            </div>
        </form>
        </div>
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
        <h5 class="modal-title" id="exampleModalLabel">Editar Administrador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form class="form-horizontal" method="POST" action="{{ route('admin.update') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="control-label">Name</label>

                    <input id="name2" type="text" class="form-control" name="name" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label">E-Mail Address</label>

                    <input id="email2" type="email" class="form-control" name="email" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group{{ $errors->has('job_title') ? ' has-error' : '' }}">
                <label for="job_title" class="control-label">Função</label>

                    <input id="job_title2" type="text" class="form-control" name="job_title" required>

                    @if ($errors->has('job_title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('job_title') }}</strong>
                        </span>
                    @endif
            </div>

            <input id="admin_id2" name="id" type="hidden">

            <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Salvar
                    </button>
            </div>
        </form>

      </div>
      
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="edit-modal-user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Usuário</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <form class="form-horizontal" method="POST" action="{{ route('user.update') }}">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                <label for="name" class="control-label">Name</label>

                    <input id="name3" type="text" class="form-control" name="name" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="control-label">E-Mail</label>

                    <input id="email3" type="email" class="form-control" name="email" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group{{ $errors->has('rg') ? ' has-error' : '' }}">
                <label for="rg" class="control-label">RG</label>

                    <input id="rg3" type="rg" class="form-control" name="rg" required>

                    @if ($errors->has('rg'))
                        <span class="help-block">
                            <strong>{{ $errors->first('rg') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                <label for="address" class="control-label">Endereço</label>

                    <input id="address3" type="address" class="form-control" name="address" required>

                    @if ($errors->has('address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                <label for="phone" class="control-label">Telefone</label>

                    <input id="phone3" type="phone" class="form-control" name="phone" required>

                    @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group{{ $errors->has('researcher') ? ' has-error' : '' }}">
                <label for="researcher" class="col-md-4 control-label">Tipo pesquisador</label>

                <div class="col-md-6">
                    <div class="custom-control custom-radio">
                      <input type="radio" id="researcher1" name="researcher" class="custom-control-input" value="academic" >
                      <label class="custom-control-label" for="researcher1">Acadêmico</label>
                    </div>
                    <div class="custom-control custom-radio ">
                      <input type="radio" id="researcher2" name="researcher" class="custom-control-input" value="independent">
                      <label class="custom-control-label" for="researcher2">Independente</label>
                    </div>

                    @if ($errors->has('researcher'))
                        <span class="help-block">
                            <strong>{{ $errors->first('researcher') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            
            <input id="user_id3" name="id" type="hidden">

            <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        Salvar
                    </button>
            </div>
        </form>

      </div>
      
    </div>
  </div>
</div>

@endsection