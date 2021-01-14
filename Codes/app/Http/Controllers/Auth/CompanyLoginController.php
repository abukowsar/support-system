<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
class CompanyLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'company/dashboard';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:company')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login', ['url' => route('company.login')]);
    }

    protected function guard()
    {
        return Auth::guard('company');
    }

    public function login(Request $request)
    {
       $this->validate($request, [
           'email'   => 'required|email',
           'password' => 'required|min:8'
       ]);

       if (Auth::guard('company')->attempt(['email' => $request->email, 'password' => $request->password])) {

           return redirect()->route('company.dashboard');
       }
       return back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        $this->guard()->logout();

        return redirect('/');
    }
}