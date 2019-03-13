<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Collection;
use App\Level;
use App\Producer;
use App\Idiom;
use App\Type;
use App\Subject;
use App\Local;
use App\Note;
use App\Field;
use Illuminate\Support\Facades\Storage;
use App\Download;
use App\Object;
class CollectionController extends Controller
{
    //
    //
    protected $attributes = ['code','title','start_date','end_date','biography','history','origin','content',
                        'incorporation','level_system','access','reproduction','features','tools','evaluate',
                        'origin_localization','copy_localization','unit_description','rules','description_date',
                        'publish_note','conservation_note','general_note','professional_note','producers',
                        'types','subjects','locales','idioms'];

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function view($collection_id){
        
        if(ctype_digit($collection_id))
            $collection = Collection::find($collection_id);
        else
            return redirect()->route('admin.dashboard')->with(['message'=>'Não tente invadir o sistema. Você não vai conseguir!']);


        $producers = Producer::orderBy('name','asc')->get();
        $levels = Level::orderBy('name','asc')->get();
        $idioms = Idiom::orderBy('name','asc')->get();
        $types = Type::orderBy('name','asc')->get();
        $subjects = Subject::orderBy('name','asc')->get();
        $locales = Local::orderBy('name','asc')->get();
        
        return view('collection_view',['collection'=>$collection,'producers'=>$producers,'levels'=>$levels,'idioms'=>$idioms,'types'=>$types,'subjects'=>$subjects,'locales'=>$locales]);

    }
    
    public function create_collection(){
        $producers = Producer::orderBy('name','asc')->get();
        $levels = Level::orderBy('name','asc')->get();
        $idioms = Idiom::orderBy('name','asc')->get();
        $types = Type::orderBy('name','asc')->get();
        $subjects = Subject::orderBy('name','asc')->get();
        $locales = Local::orderBy('name','asc')->get();

        
    	return view('collection', ['producers'=>$producers,'levels'=>$levels,'idioms'=>$idioms,'types'=>$types,'subjects'=>$subjects,'locales'=>$locales]);
    }

    public function form_level(Request $request){
        $this->validate($request,[
                'collection_id' => 'required|integer',
                'level_id' => 'required|integer',
            ]);

        

        $collection = Collection::find($request->input('collection_id'));
        $level = Level::find($request->input('level_id'));

        $producers = Producer::orderBy('name','asc')->get();
        $levels = Level::orderBy('name','asc')->get();
        $idioms = Idiom::orderBy('name','asc')->get();
        $types = Type::orderBy('name','asc')->get();
        $subjects = Subject::orderBy('name','asc')->get();
        $locales = Local::orderBy('name','asc')->get();
        $fields = Field::orderBy('description','asc')->get();

        switch ($level->name) {
            case 'grupo':
            case 'subgrupo':
            case 'serie':
            case 'subserie':
                return view('collection_group', ['collection'=>$collection,'producers'=>$producers,'levels'=>$levels,'idioms'=>$idioms,'types'=>$types,'subjects'=>$subjects,'locales'=>$locales,'fields'=>$fields, 'level_id'=>$level->id]);
                break;
            
            case 'item':
            case 'dossie':
                return view('collection_item', ['collection'=>$collection,'producers'=>$producers,'levels'=>$levels,'idioms'=>$idioms,'types'=>$types,'subjects'=>$subjects,'locales'=>$locales,'fields'=>$fields, 'level_id'=>$level->id]);
                break;
            case 'fundo':
                return redirect()->route('collection.view',['id'=>$collection->id])->with(['error'=>'Não é possivel cadastrar um fundo como subnível. Tente outro item']);
                break;
        }
        
        
    }

    public function create(Request $request){
    	$this->validate($request,[
    		'code'=>'required|max:255',
    		'title'=>'required|max:255',
    		'level'=>'required',
            'start_date'=>'nullable|digits:4',
            'end_date'=>'nullable|digits:4',

    	]);

        #var_dump($request->all());
        #exit;
        if($request->input('btn_create_session')){
            $this->create_session($request);
            return redirect()->route('collection.form');
        }
    	
        $collection = new Collection();
    	$collection->code = $request->input('code');
    	$collection->title = $request->input('title');
    	$collection->start_date = $request->input('start_date');
    	$collection->end_date = $request->input('end_date');

    	//$collection->producers = $request->input('producers');
    	$collection->biography = $request->input('biography');
    	$collection->history = $request->input('history');
    	$collection->origin = $request->input('origin');
    	$collection->content = $request->input('content');
    	$collection->incorporation = $request->input('incorporation');
    	$collection->level_system = $request->input('level_system');
    	$collection->access = $request->input('access');
    	$collection->reproduction = $request->input('reproduction');
    	//$collection->idiom = $request->input('idiom');
    	$collection->features = $request->input('features');
        $collection->tools = $request->input('tools');
    	$collection->evaluate = $request->input('evaluate');
    	$collection->origin_localization = $request->input('origin_localization');
    	$collection->copy_localization = $request->input('copy_localization');
    	$collection->unit_description = $request->input('unit_description');
    	
    	$collection->rules = $request->input('rules');
    	$collection->description_date = $request->input('description_date');
    	
        $collection->published = 0;
        $collection->hierarchy = 'background';
        
        $collection->level_id = $request->input('level');
        
            

        $note_type = ['publish','conservation','general','professional'];
        $note_variables = ['publish_note','conservation_note','general_note','professional_note'];
        $note_name = ['notas de publicação','notas de conservação','notas gerais','notas do arquivista'];
    

        $message = "Ocorreu um erro. Contacte o administrador";
        if($collection->save()){
         

            if(count($request->input('producers')) > 0)
                $collection->producers()->attach($request->input('producers'));
            
            if(count($request->input('idioms')) > 0)
                $collection->idioms()->attach($request->input('idioms'));

            if(count($request->input('subjects')) > 0)
                $collection->subjects()->attach($request->input('subjects'));

            if(count($request->input('locales')) > 0)
                $collection->locales()->attach($request->input('locales'));

            if(count($request->input('types')) > 0)
                $collection->types()->attach($request->input('types'));                  


            $i = 0;
            foreach($note_type as $note){

                if( $request->input($note_variables[$i]) !== null ){
                    $nt = new Note(['name'=>$note_name[$i],'type'=>$note, 'description' => $request->input($note_variables[$i]) ]);
                    $collection->notes()->save($nt);
                }
                
                $i++;
            }

            $message = "Cadastro realizado com sucesso!";

        }

        foreach($this->attributes as $attribute)
            $request->session()->forget($attribute);

        if($request->input('btn_create'))
            return redirect()->route('collection.view',['id'=>$collection->id])->with(['message'=>$message]);
        elseif($request->input('btn_create_and_new'))
 	  	   return redirect()->route('collection.form')->with(['message'=>$message]);

    }

    public function create_session($request){

        foreach($this->attributes as $attribute)
            $request->session()->put($attribute,$request->input($attribute));              

    }

    public function create_child(Request $request){
        $this->validate($request,[
            'code'=>'required|max:255',
            'title'=>'required|max:255',
            'level'=>'required|integer',
            'collection_id'=>'required|integer',
            'start_date'=>'nullable|digits:4',
            'end_date'=>'nullable|digits:4',

        ]);



        $collection = new Collection();
        $collection->code = $request->input('code');
        $collection->title = $request->input('title');
        $collection->start_date = $request->input('start_date');
        $collection->end_date = $request->input('end_date');
        $collection->biography = $request->input('biography');
        $collection->history = $request->input('history');
        $collection->origin = $request->input('origin');
        $collection->content = $request->input('content');
        $collection->incorporation = $request->input('incorporation');
        $collection->level_system = $request->input('level_system');
        $collection->access = $request->input('access');
        $collection->reproduction = $request->input('reproduction');
        $collection->features = $request->input('features');
        $collection->tools = $request->input('tools');
        $collection->evaluate = $request->input('evaluate');
        $collection->origin_localization = $request->input('origin_localization');
        $collection->copy_localization = $request->input('copy_localization');
        $collection->unit_description = $request->input('unit_description');
        
        $collection->rules = $request->input('rules');
        $collection->description_date = $request->input('description_date');
        
        $collection->published = 0;
                
        $collection->level_id = $request->input('level');

        $collection->collection_id = $request->input('collection_id');

        $level = Level::find($request->input('level'));

        switch ($level->name) {
            case 'grupo':
            case 'subgrupo':
            case 'serie':
            case 'subserie':
                $collection->hierarchy = 'groups';
                break;
            
            case 'item':
            case 'dossie':
                $collection->hierarchy = 'items';
                break;
        }
        
            

        
        $message = "Ocorreu um erro. Contacte o administrador";
        if($collection->save()){

            if(count($request->input('producers')) > 0)
                $collection->producers()->attach($request->input('producers'));
            
            if(count($request->input('idioms')) > 0)
                $collection->idioms()->attach($request->input('idioms'));

            if(count($request->input('subjects')) > 0)
                $collection->subjects()->attach($request->input('subjects'));

            if(count($request->input('locales')) > 0)
                $collection->locales()->attach($request->input('locales'));

            if(count($request->input('types')) > 0)
                $collection->types()->attach($request->input('types'));

            $message = "Cadastro realizado com sucesso!";
        }


        if($request->input('btn_create'))
            return redirect()->route('collection.view',['id'=>$collection->id])->with(['message'=>$message]);
        elseif($request->input('btn_create_and_new'))
            return redirect()->route('collection.form_level',['collection_id'=>$request->input('collection_id'),'level_id'=>$collection->level_id])->with(['message'=>$message]);
        

    }

  

    public function edit($collection_id){
        if(ctype_digit($collection_id))
            $collection = Collection::find($collection_id);
        else
            return redirect()->route('admin.dashboard')->with(['message'=>'Não tente invadir o sistema. Você não vai conseguir!']);


        $producers = Producer::orderBy('name','asc')->get();
        $levels = Level::orderBy('name','asc')->get();
        $idioms = Idiom::orderBy('name','asc')->get();
        $types = Type::orderBy('name','asc')->get();
        $subjects = Subject::orderBy('name','asc')->get();
        $locales = Local::orderBy('name','asc')->get();
        
        return view('collection_edit',['collection'=>$collection,'producers'=>$producers,'levels'=>$levels,'idioms'=>$idioms,'types'=>$types,'subjects'=>$subjects,'locales'=>$locales]);

    }

    public function update(Request $request){
        $this->validate($request,[
            'code'=>'required|max:255',
            'title'=>'required|max:255',
            'level'=>'required',

        ]);

        $collection = Collection::find($request->input('collection_id'));
        $collection->code = $request->input('code');
        $collection->title = $request->input('title');
        $collection->start_date = $request->input('start_date');
        $collection->end_date = $request->input('end_date');

        //$collection->producers = $request->input('producers');
        $collection->biography = $request->input('biography');
        $collection->history = $request->input('history');
        $collection->origin = $request->input('origin');
        $collection->content = $request->input('content');
        $collection->incorporation = $request->input('incorporation');
        $collection->level_system = $request->input('level_system');
        $collection->access = $request->input('access');
        $collection->reproduction = $request->input('reproduction');
        //$collection->idiom = $request->input('idiom');
        $collection->features = $request->input('features');
        $collection->tools = $request->input('tools');
        $collection->evaluate = $request->input('evaluate');
        $collection->origin_localization = $request->input('origin_localization');
        $collection->copy_localization = $request->input('copy_localization');
        $collection->unit_description = $request->input('unit_description');
        
        $collection->rules = $request->input('rules');
        $collection->description_date = $request->input('description_date');
        
        $collection->level_id = $request->input('level');                

        $note_type = ['publish','conservation','general','professional'];
        $note_variables = ['publish_note','conservation_note','general_note','professional_note'];
        $note_name = ['notas de publicação','notas de conservação','notas gerais','notas do arquivista'];
    

        $message = "Ocorreu um erro. Contacte o administrador";
        if($collection->save()){

            // deleting previous data
            $collection->producers()->detach();
            $collection->idioms()->detach();
            $collection->subjects()->detach();
            $collection->locales()->detach();
            $collection->types()->detach();
        

            if(count($request->input('producers')) > 0)
                $collection->producers()->attach($request->input('producers'));
            
            if(count($request->input('idioms')) > 0)
                $collection->idioms()->attach($request->input('idioms'));

            if(count($request->input('subjects')) > 0)
                $collection->subjects()->attach($request->input('subjects'));

            if(count($request->input('locales')) > 0)
                $collection->locales()->attach($request->input('locales'));

            if(count($request->input('types')) > 0)
                $collection->types()->attach($request->input('types'));                  


            $i = 0;

            foreach($note_type as $note){

                if( $request->input($note_variables[$i]) !== null ){
                    if( count($collection->notes()->where('type',$note)->get()) ){ //note alredy exist
                        $nt = $collection->notes()->where('type',$note)->first();
                        $nt->description = $request->input($note_variables[$i]);
                    }else{ //note doesn't exist
                        $nt = new Note(['name'=>$note_name[$i],'type'=>$note, 'description' => $request->input($note_variables[$i]) ]);
                    }

                    $collection->notes()->save($nt);
                }
                
                $i++;
            }

            $message = "Alteração realizada com sucesso!";

        }

        return redirect()->route('collection.view',['collection_id'=>$collection->id])->with(['message'=>$message]);

    }

    public function publish($collection_id){
        if(ctype_digit($collection_id))
            $collection = Collection::find($collection_id);
        else
            return redirect()->route('admin.dashboard')->with(['message'=>'Não tente invadir o sistema. Você não vai conseguir!']);

        $collection->published = ($collection->published)?0:1;

        $collection->save();

        return redirect()->route('collection.view',['collection_id'=>$collection_id])->with(['message'=>'registro alterado com sucesso.']);

    }

    public function publish_hierarchy($collection_id){
        if(ctype_digit($collection_id))
            $collection = Collection::find($collection_id);
        else
            return redirect()->route('admin.dashboard')->with(['message'=>'Não tente invadir o sistema. Você não vai conseguir!']);

        $collection->published = ($collection->published)?0:1;
        $collection->save();

        $this->recursive_publish($collection->collections,$collection->published);

        return redirect()->route('collection.view',['collection_id'=>$collection_id])->with(['message'=>'registro alterado com sucesso.']);

    }

    public function recursive_publish($collections,$status){
        foreach($collections as $collection){
            $collection->published = $status;
            $collection->save();
            $this->recursive_publish($collection->collections, $status);
        }

    }

    public function delete($collection_id){
        if(ctype_digit($collection_id))
            $collection = Collection::find($collection_id);
        else
            return redirect()->route('admin.dashboard')->with(['message'=>'Não tente invadir o sistema. Você não vai conseguir!']);

        if(!Auth::user()){
            return redirect()->back();
        }
        $collection->delete();

        return redirect()->route('admin.dashboard')->with(['message'=>'Registro deletado com sucesso.']);

    }

    public function delete_session(Request $request){    
        
        foreach($this->attributes as $attribute)
            $request->session()->forget($attribute);

        return redirect()->route('collection.form');
    }

    public function report(){

        $numbers['collections'] = [Collection::count(), 'acervos'];
        $numbers['downloads'] = [Download::count(),'downloads'];
        
        $downloads = Download::all();
        $numbers['downloads_size'] = 0;

        for($i = 0; $i < count($downloads); $i++){
            $numbers['downloads_size'] = $numbers['downloads_size'] + $downloads[$i]->file_size; 
        }


        $numbers['downloads_size'] = [$numbers['downloads_size'],'downloads em MB'];

        $numbers['idioms'] = [Idiom::count(),'idiomas'];
        $numbers['locales'] = [Local::count(),'locais'];
        $numbers['objects'] = [Object::count(),'objetos'];
        $numbers['notes'] = [Note::count(),'notas'];
        $numbers['subjects'] = [Subject::count(),'assuntos'];
        $numbers['type'] = [Type::count(),'tipologias'];

        

        

        $labels = ['acervos','downloads','downloads em MB', 'idiomas', 'locais', 'objetos', 'notas', 'assuntos', 'tipologias'];
        
        return view('report',['numbers'=>$numbers, 'labels'=> $labels]);
    }
}
