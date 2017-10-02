<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function dashboard(Request $request)
    {
        return view('admin.site.index');
    }
}
