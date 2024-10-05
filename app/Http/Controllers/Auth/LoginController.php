<?php

  
namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    
    use AuthenticatesUsers;
    
    protected $redirectTo = RouteServiceProvider::HOME;
     
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public static function countUsers()
    {
        return User::count();
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
            $user = auth()->user();
            Log::info('User logged in', ['id' => $user->id, 'type' => $user->type]);
            return redirect($user->getHomeRoute());
        }else{
            return redirect()->route('login')
                ->with('error','Email-Address And Password Are Wrong.');
        }
    }
}