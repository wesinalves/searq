<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Local;
use App\Collection;

class LocalController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(Request $request){
        $this->validate($request,[
                'search'=>'nullable|alpha|min:3'
            ]);

    	$locales = Local::orderBy('name','asc');

        $clear = 0;
        if($request->input('search') != null){
            $locales = $locales->where('name','like','%'.$request->input('search').'%');
            $request->session()->put('session_local',$request->input('search'));
            $clear = 1;
        }

        if($request->session()->get('session_local') != null){
            $locales = $locales->where('name','like','%'.$request->session()->get('session_local').'%');
            $clear = 1;
        }

        $locales = $locales->paginate(50);

    	return view('local',['locales'=>$locales,'clear'=>$clear]);
    }

    public function create(Request $request){
    	$this->validate($request,[
    		'name'=>'unique:locales|required|max:255',
    	]);

    	
    	$local = new Local();
    	$local->name = $request['name'];

    	$message = "Ocorreu um erro. Contacte o administrador";
    	if($local->save()){
    		$message = "Cadastro realizado com sucesso!";

    	}

    	return redirect()->route('local')->with(['message'=>$message]);
    }

    public function create_ajax(Request $request){
        $this->validate($request,[
            'name'=>'unique:locales|required|max:255',
        ]);

        
        $local = new Local();
        $local->name = $request['name'];
        $local->save();

        return $local->id;
    }

    public function update(Request $request){
    	$this->validate($request,[
    			'name'=>'unique:locales|required|max:255',
    		]);

    	$local = Local::find($request['id']);

    	if(!Auth::user()){
    		return redirect()->back();
    	}

    	$local->name = $request['name'];
    	$local->update();

    	return redirect()->route('local')->with(['message'=>'Registro alterado com sucesso.']);
    }


    public function delete($local_id){
    	$local = Local::where('id', $local_id)->first();
    	if(!Auth::user()){
    		return redirect()->back();
    	}
    	$local->delete();

    	return redirect()->route('local')->with(['message'=>'Registro deletado com sucesso.']);

    }

    public function delete_session(Request $request){    
        
        $request->session()->forget('session_local');

        return redirect()->route('local');
    }

    public function attach(Request $request){
        $this->validate($request,[
                'collection_id'=>'required',
            ]);

        if(!Auth::user()){
            return redirect()->back();
        }

        $collection = Collection::find($request->input('collection_id'));
        $collection->locales()->attach($request->input('local_id'));

        return null;

    }

    public function detach(Request $request){
        $this->validate($request,[
                'collection_id'=>'required',
            ]);

        if(!Auth::user()){
            return redirect()->back();
        }

        $collection = Collection::find($request->input('collection_id'));
        $collection->locales()->detach($request->input('local_id'));

        return null;

    }

    public function get_collections($local_id){
        $local = Local::where('id', $local_id)->first();
        if(!Auth::user()){
            return redirect()->back();
        }
        
        return view('local-collections',['collections'=>$local->collections()->paginate(50),'local'=>$local]);
    }
}
