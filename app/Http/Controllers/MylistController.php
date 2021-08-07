<?php

namespace App\Http\Controllers;
use App\Models\Mylist;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MylistController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::user()->type == 'admin' || Auth::user()->type == 'editor' ) {

            Validator::make($request->all(), [
                'title' => 'required|max:255',
            ])->validate();

            Mylist::create($request->all());

            return redirect()->back()->with('success', 'List added successfully.');
        }
        return redirect()->back()->with('errormsg', 'You do not have access to add a List.');
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->type == 'admin' || Auth::user()->type == 'editor' ) {
            $updated = Mylist::where('id', $id)->first();

            Validator::make($request->all(), [
                'title' => 'required|max:255',
            ])->validate();

            $updated->update($request->all());
            return redirect()->back()->with('success', 'List edited successfully.');
        }
        return redirect()->back()->with('errormsg', 'You do not have access to edit a List.');
    }

    
    public function destroy($id)
    {
        if (Auth::user()->type == 'admin') {
            Mylist::where('id', $id)->first()->delete();
            return redirect()->back()->with('success', 'List deleted successfully.');
        }
        return redirect()->back()->with('errormsg', 'You do not have access to delete a List.');
    }
}
