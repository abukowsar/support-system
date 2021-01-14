<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
class AdminLoginController extends Controller
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
    // protected $redirectTo = 'admin/dashboard';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login', ['url' => route('admin.login')]);
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function login(Request $request)
    {
       $this->validate($request, [
           'email'   => 'required|email',
           'password' => 'required|min:8'
       ]);

       if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {

           return redirect()->route('admin.dashboard');
       }

       return redirect()->back()
           ->withInput($request->only('email', 'remember'))
           ->withErrors(['email' => __('auth.failed')]);
    }

    public function logout()
    {
        $this->guard()->logout();

        return redirect('/');
    }
}
