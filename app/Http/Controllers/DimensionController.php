<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Dimension;
use App\Collection;
use Illuminate\Validation\Rule;

class DimensionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function attach(Request $request){
    	$this->validate($request,[
    		'collection_id'=>'required|integer',
    		'size' => 'required|integer',
    		'name' => ['required', Rule::in(['textual','iconografico','cartografico','tridimensional'])],
    		'type' => ['required', Rule::in(['documents','pages','sheets','items'])],
    	]);

    	if(!Auth::user()){
    		return redirect()->back();
    	}

    	$dimension = new Dimension();
    	$dimension->name = $request->input('name');
    	$dimension->size = $request->input('size');
    	$dimension->type = $request->input('type');

    	$collection = Collection::find($request->input('collection_id'));

        $message = "Ocorreu um erro. Contacte o administrador";
    	if($collection->dimensions()->save($dimension)){
    		$message = "Cadastro realizado com sucesso!";
    	}

    	return redirect()->route('collection.view',['collection_id'=>$collection->id])->with(['message'=>$message]);;
    	
    }

    public function detach(Request $request){
    	$this->validate($request,[
    		'collection_id'=>'required|integer',
    		'dimension_id'=>'required|integer',    		
    	]);

    	$dimension = Dimension::find($request->input('dimension_id'));

    	if(!Auth::user()){
    		return redirect()->back();
    	}
    	$dimension->delete();

    	return null;
    }
}
