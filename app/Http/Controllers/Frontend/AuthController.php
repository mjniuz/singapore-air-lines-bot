<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Frontend\RegisterRequest;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Redirect;

class AuthController extends Controller
{
    public function loginSubmit(LoginRequest $request)
    {
        $attemps = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($attemps))
        {
            return redirect()->back()->with('success', 'Success Login');
        }

        return redirect()->back()->with('danger', 'Invalid username or password');
    }

    public function login(Request $request)
    {
        return view('frontend.auth.login');
    }

    public function register(Request $request)
    {
        return view('frontend.auth.register');
    }

    public function registerSubmit(RegisterRequest $request)
    {
        $data = [
            'full_name' => $request->input('fullname'),
            'username'  => $request->input('username'),
            'password'  => $request->input('password'),
        ];

        $user = User::create($data);

        return redirect()->route('frontend.login')->with('success', 'Success Register');
    }

    /**
     * Logout from CMS page
     * @param  \Illuminate\Http\Request                                           $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->back()->with('success', 'Success Logout');
    }
}
