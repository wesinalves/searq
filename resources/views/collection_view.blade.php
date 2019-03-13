@extends('layouts.dashlayout')

@section('content')
<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Fundos</a></li>
        @if(isset($collection->collection->collection))
          <li class="breadcrumb-item"><a href="{{route('collection.view',['collection_id'=>$collection->collection->collection->id])}}">{{str_limit($collection->collection->collection->title,50)}}</a></li>
        @endif
        @if(isset($collection->collection))
          <li class="breadcrumb-item"><a href="{{route('collection.view',['collection_id'=>$collection->collection->id])}}">{{str_limit($collection->collection->title,50)}}</a></li>
        @endif
        <li class="breadcrumb-item active" aria-current="admin.dashboard">Detalhes</li>
      </ol>
    </nav>

   <h1>{{str_limit($collection->title,20)}}</h1>
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

    @if (session('error'))
     <div class="alert alert-danger alert-dismissible fade show" role="alert">
         {{ session('error') }}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
     </div>
    @endif

   <div class="row">

    @include('_collection_details')
    @include('_collection_sidebar')
  
	 </div>

  <hr>
         
         
</main>


@include('_collection_modals')

<script type="text/javascript">
  var token = '{{ Session::token() }}';

  var collection_id = '{{ $collection->id}}'

  var url_addproducer = '{{route('producer.attach')}}';
  var url_addsubject = '{{route('subject.attach')}}';
  var url_addidiom = '{{route('idiom.attach')}}';
  var url_addlocal = '{{route('local.attach')}}';
  var url_addtype = '{{route('type.attach')}}';

  var url_delproducer = '{{route('producer.detach')}}';
  var url_delsubject = '{{route('subject.detach')}}';
  var url_delidiom = '{{route('idiom.detach')}}';
  var url_dellocal = '{{route('local.detach')}}';
  var url_deltype = '{{route('type.detach')}}';
  var url_deldimension = '{{route('dimension.detach')}}';
  var url_delobject = '{{route('object.detach')}}';

</script>
@endsection
