<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Idiom;
use App\Collection;

class IdiomController extends Controller
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

        $idioms = Idiom::orderBy('name','asc');
        
        $clear = 0;
        if($request->input('search') != null){
            $idioms = $idioms->where('name','like','%'.$request->input('search').'%');
            $request->session()->put('session_idiom',$request->input('search'));
            $clear = 1;
        }

        if($request->session()->get('session_idiom') != null){
            $idioms = $idioms->where('name','like','%'.$request->session()->get('session_idiom').'%');
            $clear = 1;
        }

        $idioms = $idioms->paginate(50);

        return view('idiom',['idioms'=>$idioms,'clear'=>$clear]);
    }

    public function create(Request $request){
        $this->validate($request,[
                'name'=>'unique:idioms|required|max:255',
                'initials' => 'required|max:5'
            ]);

        $idiom = new Idiom();
        $idiom->name = $request->input('name');
        $idiom->initials = $request->input('initials');

        $message = "Ocorreu um erro. Contacte o administrador";
        if($idiom->save())
            $message = "Cadastro realizado com sucesso!";

        return redirect()->route('idiom')->with(['message'=>$message]);
    }

    public function update(Request $request){
        $this->validate($request,[
                'name'=>'unique:idioms|required|max:255',
                'initials' => 'required|max:5'
            ]);

        $idiom = Idiom::find($request['id']);

        if(!Auth::user()){
            return redirect()->back();
        }

        $idiom->name = $request['name'];
        $idiom->initials = $request['initials'];
        $idiom->update();

        return redirect()->route('idiom')->with(['message'=>'Registro alterado com sucesso.']);
    }

    public function delete($idiom_id){
        $idiom = Idiom::where('id', $idiom_id)->first();
        if(!Auth::user()){
            return redirect()->back();
        }
        $idiom->delete();

        return redirect()->route('idiom')->with(['message'=>'Registro deletado com sucesso.']);

    }

    public function delete_session(Request $request){    
        
        $request->session()->forget('session_idiom');

        return redirect()->route('idiom');
    }

    public function attach(Request $request){
        $this->validate($request,[
                'collection_id'=>'required',
            ]);

        if(!Auth::user()){
    		return redirect()->back();
    	}

        $collection = Collection::find($request->input('collection_id'));
        $collection->idioms()->attach($request->input('idiom_id'));

        return null;

    }

    public function detach(Request $request){
        $this->validate($request,[
                'collection_id'=>'required',
            ]);

        $collection = Collection::find($request->input('collection_id'));
        $collection->idioms()->detach($request->input('idiom_id'));

        return null;

    }

    public function create_ajax(Request $request){
        $this->validate($request,[
            'name'=>'unique:idioms|required|max:255',
            'initials'=>'required|max:5',
        ]);

        
        $idiom = new Idiom();
        $idiom->name = $request['name'];
        $idiom->initials = $request['initials'];
        $idiom->save();

        return $idiom->id;
    }

    public function get_collections($idiom_id){
        $idiom = Idiom::where('id', $idiom_id)->first();
        if(!Auth::user()){
            return redirect()->back();
        }
        
        return view('idiom-collections',['collections'=>$idiom->collections()->paginate(50),'idiom'=>$idiom]);
    }
}
