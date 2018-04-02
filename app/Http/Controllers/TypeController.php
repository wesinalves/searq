<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Type;
use App\Collection;
use Illuminate\Support\Facades\Auth;

class TypeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(){
    	$types = Type::orderBy('created_at','desc')->paginate(10);
    	return view('type',['types'=>$types]);
    }

    public function create(Request $request){
    	$this->validate($request,[
    		'name'=>'required|max:255',
    	]);

    	
    	$type = new Type();
    	$type->name = $request['name'];

    	$message = "Ocorreu um erro. Contacte o administrador";
    	if($type->save()){
    		$massage = "Cadastro realizado com sucesso!";

    	}

    	return redirect()->route('type')->with(['message'=>$message]);
    }

    public function update(Request $request){
    	$this->validate($request,[
    			'name'=>'required|max:255',
    		]);

    	$type = Type::find($request['id']);

    	if(!Auth::user()){
    		return redirect()->back();
    	}

    	$type->name = $request['name'];
    	$type->update();

    	return redirect()->route('type')->with(['message'=>'Registro alterado com sucesso.']);
    }


    public function delete($type_id){
    	$type = Type::where('id', $type_id)->first();
    	if(!Auth::user()){
    		return redirect()->back();
    	}
    	$type->delete();

    	return redirect()->route('type')->with(['message'=>'Registro deletado com sucesso.']);

    }

    public function attach(Request $request){
        $this->validate($request,[
                'collection_id'=>'required',
            ]);

        if(!Auth::user()){
            return redirect()->back();
        }

        $collection = Collection::find($request->input('collection_id'));
        $collection->types()->attach($request->input('type_id'));

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
        $collection->types()->detach($request->input('type_id'));

        return null;

    }

    
}
