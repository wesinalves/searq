<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\User;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
    	$admins = Admin::orderBy('created_at','desc')->paginate(10);
    	$users = User::orderBy('created_at','desc')->paginate(10);

    	return view('user',['admins'=>$admins,'users'=>$users]);
    }

    public function update_user(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'name'   => 'required',
        'id' => 'required',
      ]);

      $user = User::find($request->input('id'));
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->rg = $request->input('rg');
      $user->address = $request->input('address');
      $user->phone = $request->input('phone');
      $user->researcher = $request->input('researcher');

      $message = "Ocorreu um erro. Contacte o administrador";
      if($user->save()){
        $message = "Alteração realizado com sucesso!";

      }

      return redirect()->route('user')->with(['message'=>$message]); // I need to change the route to something like admin.create

    }

    public function delete_user($user_id){
       if(ctype_digit($user_id))
            $user = User::find($user_id);
        else
            return redirect()->route('admin.dashboard')->with(['message'=>'Não tente invadir o sistema. Você não vai conseguir!']);

        if(!Auth::user()){
            return redirect()->back();
        }

        $user->delete();

        return redirect()->route('user')->with(['message'=>'Registro deletado com sucesso.']);
    }

    

    public function update_password(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'password'   => 'required|min:6',
        'password_confirmation'   => 'required|same:password',
        'id' => 'required',
      ]);

      $user = User::find($request->input('id'));
      $user->password = bcrypt($request->input('password'));

      $message = "Ocorreu um erro. Contacte o administrador";
      if($user->save()){
        $massage = "Alteração realizado com sucesso!";

      }

      return redirect()->route('user.perfil',['user_id'=>$user->id])->with(['message'=>$message]); // I need to change the route to something like admin.create

    }

    
}
