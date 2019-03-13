@extends('layouts.dashlayout')

@section('content')
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
   <nav aria-label="breadcrumb">
     <ol class="breadcrumb">
       <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
       <li class="breadcrumb-item active" aria-current="page">Perfil</li>
     </ol>
   </nav>
   <h1>Perfil</h1>

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

   <h3>{{$admin->name}}</h3>
    <p>{{$admin->email}}</p>  
    <p>{{$admin->job_title}}</p>  
    <p>ativado em {{$admin->created_at}}</p>  
    <p>ultima atualização em {{$admin->updated_at}}</p>  

    </div>

    <div class="col-md-6">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Alterar senha</h5>
          <form class="form-horizontal" method="POST" action="{{ route('admin.update_password') }}">
            {{ csrf_field() }}

            
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password" class="control-label">Nova senha</label>

                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group">
                <label for="password-confirm" class="control-label">Confirmar nova senha</label>

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>

            <input type="hidden" value="{{$admin->id}}" name="id">

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




@endsection