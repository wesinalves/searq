<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Note;
use App\Collection;
use Illuminate\Validation\Rule;

class NoteController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function detach($note_id){
    	
        if(ctype_digit($note_id))
            $note = Note::find($note_id);
        else
            return redirect()->route('admin.dashboard')->with(['message'=>'Não tente invadir o sistema. Você não vai conseguir!']);

    	
    	if(!Auth::user()){
    		return redirect()->back();
    	}
    	$note->delete();

    	return redirect()->route('collection.view',['collection_id'=>$note->collection->id])->with(['message'=>'registro alterado com sucesso']);
    }
}
