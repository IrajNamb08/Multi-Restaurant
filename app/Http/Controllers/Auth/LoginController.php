<?php

  
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
class LoginController extends Controller
{
    
    use AuthenticatesUsers;
    
    protected $redirectTo = RouteServiceProvider::HOME;
     
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request): RedirectResponse
    {   
        $input = $request->all();
     
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
        {
            if (auth()->user()->type == 'restoAdmin') {
                return redirect()->route('restoAdmin');
            }else if (auth()->user()->type == 'manager') {
                return redirect()->route('manager');
            }else if(auth()->user()->type == 'cuisinier'){
                return redirect()->route('cuisinier');
            }
            else{
                return redirect()->route('admin');
            }
        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
    }
}