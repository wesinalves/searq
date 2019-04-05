@extends('layouts.dashlayout')

@section('content')

<main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Relatório</li>
      </ol>
    </nav>
    <h1>Relatórios</h1>
    @if (session('message'))
     <div class="alert alert-success alert-dismissible fade show" role="alert">
         {{ session('message') }}
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
     </div>
    @endif
     
     <div class="row">
        <div class="col-md-6">
            <h2>Gerados pelo sistema</h2>
            @foreach($numbers as $number)
            <h4>{{$number[1]}}: <span class="badge badge-info">{{$number[0]}}</span></h4>
            @endforeach
        </div>
        <div class="col-md-6">
            <h2>Google Analytics</h2>
            <!-- Step 1: Create the containing elements. -->

            <section id="auth-button"></section>
            <section id="view-selector"></section>
            <section id="timeline"></section>

            <!-- Step 2: Load the library. -->

            <script>
            (function(w,d,s,g,js,fjs){
              g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(cb){this.q.push(cb)}};
              js=d.createElement(s);fjs=d.getElementsByTagName(s)[0];
              js.src='https://apis.google.com/js/platform.js';
              fjs.parentNode.insertBefore(js,fjs);js.onload=function(){g.load('analytics')};
            }(window,document,'script'));
            </script>

            <script>
            gapi.analytics.ready(function() {

              // Step 3: Authorize the user.

              var CLIENT_ID = '229253131822-2ivmdl0qv59r2gnv15npvngmj7kmt2bp.apps.googleusercontent.com';

              gapi.analytics.auth.authorize({
                container: 'auth-button',
                clientid: CLIENT_ID,
              });

              // Step 4: Create the view selector.

              var viewSelector = new gapi.analytics.ViewSelector({
                container: 'view-selector'
              });

              // Step 5: Create the timeline chart.

              var timeline = new gapi.analytics.googleCharts.DataChart({
                reportType: 'ga',
                query: {
                  'dimensions': 'ga:date',
                  'metrics': 'ga:sessions',
                  'start-date': '30daysAgo',
                  'end-date': 'yesterday',
                },
                chart: {
                  type: 'LINE',
                  container: 'timeline'
                }
              });

              // Step 6: Hook up the components to work together.

              gapi.analytics.auth.on('success', function(response) {
                viewSelector.execute();
              });

              viewSelector.on('change', function(ids) {
                var newIds = {
                  query: {
                    ids: ids
                  }
                }
                timeline.set(newIds).execute();
              });
            });
            </script>
        </div>

    </div>
     

    </div>
    
   <br>

    

           
         
</main>
@endsection
