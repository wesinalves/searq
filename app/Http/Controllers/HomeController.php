<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
use App\Collection;
use App\Subject;
use App\Type;
use App\Producer;
use App\Local;
use App\Level;
use App\Idiom;
use Illuminate\Support\Facades\DB;
use App\Download;
use App\Object;
use Illuminate\Support\Facades\Storage;





class HomeController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('search');
    }

    
    public function search()
    {
        return view('search');
    }

    public function background(){
        $collections = Collection::where([
              ['hierarchy','background'],
              ['published',1]

            ])->get();

        return view('background',['collections'=>$collections]);
    } 

    public function background_view($collection_id){
        
        if(ctype_digit($collection_id))
            $collection = Collection::find($collection_id);
        else
            return redirect()->route('admin.dashboard')->with(['message'=>'Não tente invadir o sistema. Você não vai conseguir!']);


        $producers = Producer::orderBy('name','asc')->get();
        $levels = Level::orderBy('name','asc')->get();
        $idioms = Idiom::orderBy('name','asc')->get();
        $types = Type::orderBy('name','asc')->get();
        $subjects = Subject::orderBy('name','asc')->get();
        $locales = Local::orderBy('name','asc')->get();
        
        return view('background_view',['collection'=>$collection,'producers'=>$producers,'levels'=>$levels,'idioms'=>$idioms,'types'=>$types,'subjects'=>$subjects,'locales'=>$locales]);

    }

    public function advanced_search()
    {
        $fields = "subjects types producers locales";
        $fields = explode(" ", $fields);
        $descriptions = "Assunto Tipologia Produtor Local";
        $descriptions = explode(" ",$descriptions);
        $access = ['restricted','private','public'];
        $access_labels = ['restrito','privado','publico'];
        $levels = Level::all();

        return view('advanced_search',['fields'=>$fields,'descriptions'=>$descriptions,'access'=>$access,'access_labels'=>$access_labels,'levels'=>$levels]);

    }

    public function search_by($descritor, $letter=null){
        
        switch ($descritor) {
          case 'subject':
            $data_provider = Subject::orderBy('name','asc')->get();
            $name_descritor = "Assunto";
            $class = "App\Subject";
            break;
          case 'type':
            $data_provider = Type::orderBy('name','asc')->get();
            $name_descritor = "Tipologia documental";
            $class = "App\Type";
            break;
          case 'producer':
            $data_provider = Producer::orderBy('name','asc')->get();
            $name_descritor = "Produtor";
            $class = "App\Producer";
            break;
          case 'local':
            $data_provider = Local::orderBy('name','asc')->get();
            $name_descritor = "Local";
            $class = "App\Local";
            break;
        }

        $letters = explode(" ", "A B C D E F G H I J L M N O P Q R S T U V X Z");

        if($letter != null){
          $data_provider = $class::where('name','LIKE', $letter.'%')->get();                   
        }

        

        return view('search_descritors',['descritor'=>$descritor, 'data_provider'=>$data_provider,'name_descritor'=>$name_descritor, 'letters'=>$letters]);

    }




    public function perfil($user_id){

      if(ctype_digit($user_id))
          $user = User::find($user_id);
      else
          return redirect()->route('/')->with(['message'=>'Não tente invadir o sistema. Você não vai conseguir!']);

      if(Auth::user() != $user){
            return redirect()->back();
        }

      
      return view('perfil_user',['user'=>$user]);

    }

    public function results(Request $request){
        $this->validate($request,[
            'content'=>'required|max:255|min:3',

        ]);

        if(!Auth::user()){
            return redirect()->back();
        }

        $params = [['content', 'like', '%'.$request->input('content').'%'],
                    ['published',1],
                  ];

        $collections = Collection::where($params)
                       ->orderBy('title', 'desc')
                       ->paginate(10);

        return view('results',['collections'=>$collections, 'content'=>$request->input('content')]);
    }

    public function advanced_results(Request $request){

      $request->validate([
        'criteria.*' => 'required|min:3',
        'inputCriteria.*' => 'required|min:3',
        'level' => 'nullable|numeric',
        'access' => 'nullable|min:3',
        'start_date' => 'nullable|digits:4',
        'end_date' => 'nullable|digits:4',

        ]);


      $collections = Collection::whereHas($request->input('criteria')[0], function ($query) use ($request) {
              $query->where('name', 'like', "%".$request->input('inputCriteria')[0]."%");
        });

      

      for($i = 1; $i < count($request->input('criteria')); $i++){
          switch ($request->input('slcCriteria')[$i - 1]) {
            case 'and':
              $collections = $collections->whereHas($request->input('criteria')[$i], function ($query) use ($request,$i) {
                      $query->where('name', 'like', "%".$request->input('inputCriteria')[$i]."%");     
              });              
              break;
            case 'or':
              $collections = $collections->orWhereHas($request->input('criteria')[$i], function ($query) use ($request,$i) {
                      $query->where('name', 'like', "%".$request->input('inputCriteria')[$i]."%");     
              });
              break;
            case 'not':
              $collections = $collections->whereHas($request->input('criteria')[$i], function ($query) use ($request,$i) {
                      $query->where('name', '<>', "%".$request->input('inputCriteria')[$i]."%");     
              });
              break;
            
          }

      }

     if($request->input('level') !== null)
        $collections = $collections->where('level_id', $request->input('level'));

      if($request->input('access') !== null)
        $collections = $collections->where('access', $request->input('access'));


      if($request->input('start_date') !== null)
        $collections = $collections->where('start_date', '>=',$request->input('start_date'));

      if($request->input('end_date') !== null)
        $collections = $collections->where('end_date', '<=',$request->input('end_date'));

      
      $collections = $collections->where('published',1)->paginate(10);


      
      return view('results',['collections'=>$collections, 'criteria'=>$request->input('criteria'), 
                            'inputCriteria'=>$request->input('inputCriteria'),
                            'level'=>$request->input('level'),
                            'access'=>$request->input('access'),
                            'start_date'=>$request->input('start_date'),
                            'end_date'=>$request->input('end_date')
        ]);

    }

     public function results_by(Request $request){
        $this->validate($request,[
            'slc_terms'=>'required',

        ]);

        if(!Auth::user()){
            return redirect()->back();
        }

        switch ($request->input('descritor')) {
          case 'subject':
            $collections = Collection::whereHas('subjects', function ($query) use ($request){
                             $query->whereIn('id',$request->input('slc_terms'));
                        });
            break;
          case 'type':
            $collections = Collection::whereHas('types', function ($query) use ($request){
                             $query->whereIn('id',$request->input('slc_terms'));
              });
            break;
          case 'producer':
            $collections = Collection::whereHas('producers', function ($query) use ($request){
                             $query->whereIn('id',$request->input('slc_terms'));
                });

            break;
          case 'local':
            $collections = Collection::whereHas('locales', function ($query) use ($request){
                             $query->whereIn('id',$request->input('slc_terms'));
              });
              
            break;
        }

        $collections = $collections->where('published',1)->paginate(10);
  

        return view('results',['collections'=>$collections, 'descritor'=>$request->input('descritor'), 'terms'=>$request->input('slc_terms')]);
              

    }


    public function quick_results(Request $request){
        $this->validate($request,[
            'letter'=>'required',

        ]);

        if(!Auth::user()){
            return redirect()->back();
        }

        switch ($request->input('descritor')) {
          case 'subject':
            $collections = Collection::whereHas('subjects', function ($query) use ($request){
                             $query->where('name', 'like', $request->input('letter')."%");
              });
            break;
          case 'type':
            $collections = Collection::whereHas('types', function ($query) use ($request){
                            $query->where('name', 'like', $request->input('letter')."%");
              });
              
            break;
          case 'producer':
            $collections = Collection::whereHas('producers', function ($query) use ($request){
                             $query->where('name', 'like', $request->input('letter')."%");
                });
            break;
          case 'local':
            $collections = Collection::whereHas('locales', function ($query) use ($request){
                             $query->where('name', 'like', $request->input('letter')."%");
              });
            break;
        }

        $collections = $collections->where('published',1)->paginate(10);

        return view('results',['collections'=>$collections,'letter'=>$request->input('letter'),'descritor'=>$request->input('descritor')]);
              

    }


    public function results_by_name(Request $request){


        $this->validate($request,[
            'position'=>'required',
            'txt_name' => 'required'

        ]);

        if(!Auth::user()){
            return redirect()->back();
        }

        if($request->input('position') == "start"){
          switch ($request->input('descritor')) {
          case 'subject':
            $collections = Collection::whereHas('subjects', function ($query) use ($request){
                             $query->where('name', 'like', $request->input('txt_name')."%");
              });
            break;
          case 'type':
            $collections = Collection::whereHas('types', function ($query) use ($request){
                            $query->where('name', 'like', $request->input('txt_name')."%");
              });
            break;
          case 'producer':
            $collections = Collection::whereHas('producers', function ($query) use ($request){
                             $query->where('name', 'like', $request->input('txt_name')."%");
                });
            break;
          case 'local':
            $collections = Collection::whereHas('locales', function ($query) use ($request){
                             $query->where('name', 'like', $request->input('txt_name')."%");
              });
            break;
          }

        }elseif($request->input('position') == "middle"){
          switch ($request->input('descritor')) {
          case 'subject':
            $collections = Collection::whereHas('subjects', function ($query) use ($request){
                             $query->where('name', 'like', "%".$request->input('txt_name')."%");
              });
            break;
          case 'type':
            $collections = Collection::whereHas('types', function ($query) use ($request){
                            $query->where('name', 'like', "%".$request->input('txt_name')."%");
              });
            break;
          case 'producer':
            $collections = Collection::whereHas('producers', function ($query) use ($request){
                             $query->where('name', 'like', "%".$request->input('txt_name')."%");
                });
            break;
          case 'local':
            $collections = Collection::whereHas('locales', function ($query) use ($request){
                             $query->where('name', 'like', "%".$request->input('txt_name')."%");
              });
            break;
          }
        }
  
        $collections = $collections->where('published',1)->paginate(10);

        return view('results',['collections'=>$collections,'name'=>$request->input('txt_name'), 'descritor'=>$request->input('descritor'), 'position'=>$request->input('position')]);
              

    }

    public function download($object_id){

       if(!ctype_digit($object_id))
          return redirect()->route('search')->with(['message'=>'Não tente invadir o sistema. Você não vai conseguir!']);

      $object = Object::find($object_id);


      $download = new Download();
      $download->path = $object->path;
      $download->file_size = round(Storage::size($object->path)/(1024*1024),2);
      $download->user_id = Auth::user()->id;

      if($download->save()){
        return Storage::download($object->path);
      }

      return redirect()->route('search')->with(['message'=>'Algo deu errado na tentative de download. Entre em contato com o administrador do sistema']);
    }

    public function change_password(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'password'   => 'required|min:6',
        'password_confirmation'   => 'required|same:password',
        'id' => 'required',
      ]);

      $user = User::find($request->input('id'));
      $user->password = bcrypt($request->input('password'));

      $message = "Ocorreu um erro. Contacte o administrador";
      if($user->save()){
        $massage = "Alteração realizado com sucesso!";

      }

      return redirect()->route('user.perfil',['user_id'=>$user->id])->with(['message'=>$message]); // I need to change the route to something like admin.create

    }
    
}
