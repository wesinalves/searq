<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    public function __construct()
    {
      $this->middleware('auth:admin')->except(['showLoginForm','login']);
    }
    public function showLoginForm()
    {
      return view('auth.admin-login');
    }
    public function showRegistrationForm()
    {
      return view('auth.register-admin');
    }
    public function login(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required|min:6'
      ]);
      // Attempt to log the user in
      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
        return redirect()->intended(route('admin.dashboard'));
      }
      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function register(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'name'   => 'required',
        'job_title'   => 'required',
        'password' => 'required|min:6',
        'password_confirmation'   => 'required|same:password',
      ]);

      $admin = new Admin();
      $admin->name = $request->name;
      $admin->email = $request->email;
      $admin->job_title = $request->job_title;
      $admin->password = bcrypt($request->password);

      $message = "Ocorreu um erro. Contacte o administrador";
      if($admin->save()){
        $message = "Cadastro realizado com sucesso!";

      }

      return redirect()->route('user')->with(['message'=>$message]); // I need to change the route to something like admin.create

    }

    public function update(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'email'   => 'required|email',
        'name'   => 'required',
        'job_title'   => 'required',
        'id' => 'required',
      ]);

      $admin = Admin::find($request->input('id'));
      $admin->name = $request->input('name');
      $admin->email = $request->input('email');
      $admin->job_title = $request->input('job_title');

      $message = "Ocorreu um erro. Contacte o administrador";
      if($admin->save()){
        $message = "Alteração realizado com sucesso!";

      }

      return redirect()->route('user')->with(['message'=>$message]); // I need to change the route to something like admin.create

    }

    public function delete($admin_id){
       if(ctype_digit($admin_id))
            $admin = Admin::find($admin_id);
        else
            return redirect()->route('admin.dashboard')->with(['message'=>'Não tente invadir o sistema. Você não vai conseguir!']);

        if(!Auth::user()){
            return redirect()->back();
        }

        $admin->delete();

        return redirect()->route('user')->with(['message'=>'Registro deletado com sucesso.']);
    }

    public function logout(Request $request){
            
      Auth::guard('admin')->logout();
      return redirect()->route( 'admin.login' );
      
    }

    public function perfil($admin_id){
      if(ctype_digit($admin_id))
          $admin = Admin::find($admin_id);
      else
          return redirect()->route('admin.dashboard')->with(['message'=>'Não tente invadir o sistema. Você não vai conseguir!']);

      if(Auth::user() != $admin){
            return redirect()->back();
        }


      return view('perfil_admin',['admin'=>$admin]);
      
    }

    public function update_password(Request $request)
    {
      // Validate the form data
      $this->validate($request, [
        'password'   => 'required|min:6',
        'password_confirmation'   => 'required|same:password',
        'id' => 'required',
      ]);

      $admin = Admin::find($request->input('id'));
      $admin->password = bcrypt($request->input('password'));

      $message = "Ocorreu um erro. Contacte o administrador";
      if($admin->save()){
        $message = "Alteração realizado com sucesso!";

      }

      return redirect()->route('admin.perfil',['admin_id'=>$admin->id])->with(['message'=>$message]); // I need to change the route to something like admin.create

    }
  
}