<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Mylist;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (Auth::User()->type == 'admin') {
            $lists = Mylist::all();
            $users = User::where('type', '!=', 'admin')->get();
            return view('admin.dashboard', compact('lists','users'));
        } else {
            redirect('/');
        }
    }

    public function users()
    {
        if (Auth::User()->type == 'admin') {
            $users = User::where('type', '!=', 'admin')->get();
            return view('admin.users', compact('users'));
        } else {
            redirect('/');
        }
    }

    public function lists()
    {
        if (Auth::User()->type == 'admin') {
            $lists = Mylist::all();
            return view('admin.lists', compact('lists'));
        } else {
            redirect('/');
        }
    }

    public function add_user(Request $request)
    {
        if (Auth::user()->type == 'admin') {

            Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'type' => 'required|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => ['required', Rules\Password::defaults()],    
            ])->validate();

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'type' => $request->type,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->back()->with('success', 'User added successfully.');
        }
        return redirect()->back()->with('errormsg', 'You do not have access to add a User.');
    }

    public function delete_user($id)
    {
        if (Auth::user()->type == 'admin') {
            User::where('id', $id)->first()->delete();
            return redirect()->back()->with('success', 'User deleted successfully.');
        }
        return redirect()->back()->with('errormsg', 'You do not have access to delete a User.');
    }
}
