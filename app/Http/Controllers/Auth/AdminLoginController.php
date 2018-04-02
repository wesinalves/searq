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
      $this->middleware('guest:admin')->except('logout');
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
        'password' => 'required|min:6'
      ]);

      $admin = new Admin();
      $admin->name = $request->name;
      $admin->email = $request->email;
      $admin->job_title = $request->job_title;
      $admin->password = bcrypt($request->password);

      $message = "Ocorreu um erro. Contacte o administrador";
      if($admin->save()){
        $massage = "Cadastro realizado com sucesso!";

      }

      return redirect()->route('admin.dashboard')->with(['message'=>$message]); // I need to change the route to something like admin.create

    }

    public function logout(Request $request){
            
      Auth::guard('admin')->logout();
      return redirect()->route( 'admin.login' );
      
    }
}