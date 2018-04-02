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
}
