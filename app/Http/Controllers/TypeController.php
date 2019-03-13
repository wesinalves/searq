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
    
    public function index(Request $request){
        $this->validate($request,[
                'search'=>'nullable|alpha|min:3'
            ]);

    	$types = Type::orderBy('name','asc');
        
        $clear = 0;
        if($request->input('search') != null){
            $types = $types->where('name','like','%'.$request->input('search').'%');
            $request->session()->put('session_type',$request->input('search'));
            $clear = 1;
        }

        if($request->session()->get('session_type') != null){
            $types = $types->where('name','like','%'.$request->session()->get('session_type').'%');
            $clear = 1;
        }

        $types = $types->paginate(50);

    	return view('type',['types'=>$types,'clear'=>$clear]);
    }

    public function create(Request $request){
    	$this->validate($request,[
    		'name'=>'unique:types|required|max:255',
    	]);

    	
    	$type = new Type();
    	$type->name = $request['name'];

    	$message = "Ocorreu um erro. Contacte o administrador";
    	if($type->save()){
    		$message = "Cadastro realizado com sucesso!";

    	}

    	return redirect()->route('type')->with(['message'=>$message]);
    }

    public function create_ajax(Request $request){
        $this->validate($request,[
            'name'=>'unique:types|required|max:255',
        ]);

        
        $type = new Type();
        $type->name = $request['name'];
        $type->save();

        return $type->id;
    }

    public function update(Request $request){
    	$this->validate($request,[
    			'name'=>'unique:types|required|max:255',
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

    public function delete_session(Request $request){    
        
        $request->session()->forget('session_type');

        return redirect()->route('type');
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

    public function get_collections($type_id){
        $type = Type::where('id', $type_id)->first();
        if(!Auth::user()){
            return redirect()->back();
        }
        
        return view('type-collections',['collections'=>$type->collections()->paginate(50),'type'=>$type]);
    }

    
}
