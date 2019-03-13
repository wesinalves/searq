<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Producer;
use App\Collection;

class ProducerController extends Controller
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

    	$producers = Producer::orderBy('name','asc');
    	
        $clear = 0;
        if($request->input('search') != null){
            $producers = $producers->where('name','like','%'.$request->input('search').'%');
            $request->session()->put('session_producer',$request->input('search'));
            $clear = 1;
        }

        if($request->session()->get('session_producer') != null){
            $producers = $producers->where('name','like','%'.$request->session()->get('session_producer').'%');
            $clear = 1;
        }

        $producers = $producers->paginate(50);

        return view('producer',['producers'=>$producers,'clear'=>$clear]);
    }

    public function create(Request $request){
    	$this->validate($request,[
    		'name'=>'unique:producers|required|max:255',
    	]);

    	
    	$producer = new Producer();
    	$producer->name = $request['name'];

    	$message = "Ocorreu um erro. Contacte o administrador";
    	if($producer->save()){
    		$message = "Cadastro realizado com sucesso!";

    	}

    	return redirect()->route('producer')->with(['message'=>$message]);
    }

    public function create_ajax(Request $request){
        $this->validate($request,[
            'name'=>'unique:producers|required|max:255',
        ]);

        
        $producer = new Producer();
        $producer->name = $request['name'];
        $producer->save();

        return $producer->id;
    }

    public function update(Request $request){
    	$this->validate($request,[
    			'name'=>'unique:producers|required|max:255',
    		]);

    	$producer = Producer::find($request['id']);

    	if(!Auth::user()){
    		return redirect()->back();
    	}

    	$producer->name = $request['name'];
    	$producer->update();

    	return redirect()->route('producer')->with(['message'=>'Registro alterado com sucesso.']);
    }


    public function delete($producer_id){
    	$producer = Producer::where('id', $producer_id)->first();
    	if(!Auth::user()){
    		return redirect()->back();
    	}
    	$producer->delete();

    	return redirect()->route('producer')->with(['message'=>'Registro deletado com sucesso.']);

    }

    public function delete_session(Request $request){    
        
        $request->session()->forget('session_producer');

        return redirect()->route('producer');
    }

    public function attach(Request $request){
        $this->validate($request,[
                'collection_id'=>'required',
            ]);

        if(!Auth::user()){
            return redirect()->back();
        }

        $collection = Collection::find($request->input('collection_id'));
        $collection->producers()->attach($request->input('producer_id'));

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
        $collection->producers()->detach($request->input('producer_id'));

        return null;

    }

    public function get_collections($producer_id){
        $producer = Producer::where('id', $producer_id)->first();
        if(!Auth::user()){
            return redirect()->back();
        }
        
        return view('producer-collections',['collections'=>$producer->collections()->paginate(50),'producer'=>$producer]);
    }
}
