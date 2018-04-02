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
    public function index(){
    	$subjects = Subject::orderBy('created_at','desc')->paginate(10);
    	return view('subject',['subjects'=>$subjects]);
    }

    public function create(Request $request){
    	$this->validate($request,[
    		'name'=>'required|max:255',
    	]);

    	
    	$subject = new Subject();
    	$subject->name = $request['name'];

    	$message = "Ocorreu um erro. Contacte o administrador";
    	if($subject->save()){
    		$massage = "Cadastro realizado com sucesso!";

    	}

    	return redirect()->route('subject')->with(['message'=>$message]);
    }

    public function update(Request $request){
    	$this->validate($request,[
    			'name'=>'required|max:255',
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
}
