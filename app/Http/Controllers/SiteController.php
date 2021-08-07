<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mylist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function welcome()
    {
        $users = User::count();
        if ($users > 0)
            $new_app = 0;
        else
            $new_app = 1;
        return view('welcome', compact('new_app'));
    }

    public function dashboard()
    {
        if (Auth::User()->type == 'admin') {
            return redirect('/admin_dashboard');
        } else if (Auth::User()->type == 'editor') {
            return redirect('/user_dashboard');
        } else {
            $lists = Mylist::with('cards')->get();
            return view('dashboard', compact('lists'));
        }
    }
}
