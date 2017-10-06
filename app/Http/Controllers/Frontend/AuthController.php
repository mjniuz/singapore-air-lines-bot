<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
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
}
