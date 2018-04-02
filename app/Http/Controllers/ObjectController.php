<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Object;
use App\Collection;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ObjectController extends Controller
{
    //

     //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function attach(Request $request){
    	$this->validate($request,[
    		'collection_id'=>'required|integer',
    		'path' => 'required',
    		'type' => ['required', Rule::in(['pdf','jpeg'])],
    	]);

    	if(!Auth::user()){
    		return redirect()->back();
    	}

    	$object = new Object();
        if($request->input('type')=='jpeg')
    	   $object->path = $request->file('path')->store('images');
        elseif($reques->input('type')=='pdf')
           $object->path = $request->file('path')->store('pdfs');

    	$object->type = $request->input('type');

    	$collection = Collection::find($request->input('collection_id'));

        $message = "Ocorreu um erro. Contacte o administrador";
    	if($collection->objects()->save($object)){
    		$message = "Cadastro realizado com sucesso!";
    	}

    	return redirect()->route('collection.view',['collection_id'=>$collection->id])->with(['message'=>$message]);;
    	
    }

    public function detach(Request $request){
    	$this->validate($request,[
    		'collection_id'=>'required|integer',
    		'object_id'=>'required|integer',    		
    	]);

    	$object = Object::find($request->input('object_id'));

    	if(!Auth::user()){
    		return redirect()->back();
    	}

        Storage::delete($object->path);
    	$object->delete();

    	return null;
    }
}
