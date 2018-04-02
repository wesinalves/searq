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
    
    public function index(){
    	$producers = Producer::orderBy('created_at','desc')->paginate(10);
    	return view('producer',['producers'=>$producers]);
    }

    public function create(Request $request){
    	$this->validate($request,[
    		'name'=>'required|max:255',
    	]);

    	
    	$producer = new Producer();
    	$producer->name = $request['name'];

    	$message = "Ocorreu um erro. Contacte o administrador";
    	if($producer->save()){
    		$massage = "Cadastro realizado com sucesso!";

    	}

    	return redirect()->route('producer')->with(['message'=>$message]);
    }

    public function update(Request $request){
    	$this->validate($request,[
    			'name'=>'required|max:255',
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
}
