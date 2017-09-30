<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * this function for get all data users
     * @param  Request $request
     * @return array
     */
    public function index(Request $request)
    {
        // set data request
        $searchname     = $request->input('searchname');
        $searchaccess   = $request->input('searchaccess');
        $searchusername = $request->input('searchusername');
        $users          = User::orderBy('id', 'desc');

        // check username of user
        if (!empty($searchusername))
        {
            $users = $users->where('username', 'LIKE', '%' . $searchusername . '%');
        }

        // check name of user
        if (!empty($searchname))
        {
            $users = $users->where('full_name', 'LIKE', '%' . $searchname . '%');
        }

        // check access of user
        if (!empty($searchaccess))
        {
            $users = $users->where('access', $searchaccess);
        }

        // return paginate
        $users = $users->paginate();

        return view('admin.user.index', compact('users'));
    }
}
