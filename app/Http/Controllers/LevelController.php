<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Level;
use Illuminate\Support\Facades\Auth;

class LevelController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(){
    	$levels = Level::orderBy('created_at','desc')->paginate(10);
    	return view('level',['levels'=>$levels]);
    }

    public function store(Request $request){
    	$this->validate($request,[
    		'name'=>'required|max:255',
    	]);

    	
    	$level = new Level();
    	$level->name = $request['name'];

    	$message = "Ocorreu um erro. Contacte o administrador";
    	if($level->save()){
    		$massage = "Cadastro realizado com sucesso!";

    	}

    	return redirect()->route('level')->with(['message'=>$message]);
    }

    public function update(Request $request){
    	$this->validate($request,[
    			'name'=>'required|max:255',
    		]);

    	$level = Level::find($request['id']);

    	if(!Auth::user()){
    		return redirect()->back();
    	}

    	$level->name = $request['name'];
    	$level->update();

    	return redirect()->route('level')->with(['message'=>'Registro alterado com sucesso.']);
    }

    public function delete($level_id){
        $level = Level::where('id', $level_id)->first();
        if(!Auth::user()){
            return redirect()->back();
        }
        $level->delete();

        return redirect()->route('level')->with(['message'=>'Registro deletado com sucesso.']);

    }
}
