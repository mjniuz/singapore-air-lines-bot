<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use Auth;
use Illuminate\Http\Request;
use Redirect;

class AuthController extends Controller
{
    /**
     * Show page form login for CMS
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.auth.index');
    }

    /**
     * Process for login process
     * @param  Request                                                            $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        $attemps = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($attemps))
        {
            return redirect()->route('admin.dashboard');
        }

        $error = 'Invalid username or password';
        return redirect()->back()->with('danger', $error);
    }

    /**
     * Logout from CMS page
     * @param  \Illuminate\Http\Request                                           $request
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
