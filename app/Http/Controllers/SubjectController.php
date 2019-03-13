<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Subject;
use App\Collection;

class SubjectController extends Controller
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

        $subjects = Subject::orderBy('name','asc');

        $clear = 0;
        if($request->input('search') != null){
            $subjects = $subjects->where('name','like','%'.$request->input('search').'%');
            $request->session()->put('session_subject',$request->input('search'));
            $clear = 1;
        }

        if($request->session()->get('session_subject') != null){
            $subjects = $subjects->where('name','like','%'.$request->session()->get('session_subject').'%');
            $clear = 1;
        }



        $subjects = $subjects->paginate(50);

        return view('subject',['subjects'=>$subjects,'clear'=>$clear]);
    }

    public function create(Request $request){
    	$this->validate($request,[
    		'name'=>'unique:subjects|required|max:255',
    	]);

    	
    	$subject = new Subject();
    	$subject->name = $request['name'];

    	$message = "Ocorreu um erro. Contacte o administrador";
    	if($subject->save()){
    		$message = "Cadastro realizado com sucesso!";

    	}

    	return redirect()->route('subject')->with(['message'=>$message]);
    }

    public function create_ajax(Request $request){
        $this->validate($request,[
            'name'=>'unique:subjects|required|max:255',
        ]);

        
        $subject = new Subject();
        $subject->name = $request['name'];
        $subject->save();

        return $subject->id;
    }

    public function update(Request $request){
    	$this->validate($request,[
    			'name'=>'unique:subjects|required|max:255',
    		]);

    	$subject = Subject::find($request['id']);

    	if(!Auth::user()){
    		return redirect()->back();
    	}

    	$subject->name = $request['name'];
    	$subject->update();

    	return redirect()->route('subject')->with(['message'=>'Registro alterado com sucesso.']);
    }


    public function delete($subject_id){
    	$subject = Subject::where('id', $subject_id)->first();
    	if(!Auth::user()){
    		return redirect()->back();
    	}
    	$subject->delete();

    	return redirect()->route('subject')->with(['message'=>'Registro deletado com sucesso.']);

    }

    public function delete_session(Request $request){    
        
        $request->session()->forget('session_subject');

        return redirect()->route('subject');
    }


    public function attach(Request $request){
        $this->validate($request,[
                'collection_id'=>'required',
            ]);

        if(!Auth::user()){
            return redirect()->back();
        }

        $collection = Collection::find($request->input('collection_id'));
        $collection->subjects()->attach($request->input('subject_id'));

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
        $collection->subjects()->detach($request->input('subject_id'));

        return null;

    }

    public function get_collections($subject_id){
        $subject = Subject::where('id', $subject_id)->first();
        if(!Auth::user()){
            return redirect()->back();
        }
        
        return view('subject-collections',['collections'=>$subject->collections()->paginate(50),'subject'=>$subject]);
    }
}
