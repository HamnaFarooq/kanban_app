<?php

namespace App\Http\Controllers;

use App\Models\Cards;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

class CardsController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::user()->type == 'editor') {

            Validator::make($request->all(), [
                'title' => 'required|max:255',
                'description' => 'required|max:255',
                'attachment' => 'required'
            ])->validate();

            $img_path = $request->file()['attachment'];

            $img_data = file_get_contents($img_path);
            $type = pathinfo($img_path, PATHINFO_EXTENSION);
            $base64 = base64_encode($img_data);

            Cards::create([
                'title' => $request->title,
                'description' => $request->description,
                'mylist_id' => $request->mylist_id,
                'attachment' =>  'data:image/' . $type . ';base64,' . $base64,
                'completed' =>  0,
            ]);

            return redirect()->back()->with('success', 'Card added successfully.');
        }
        return redirect()->back()->with('errormsg', 'You do not have access to add a Card.');
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->type == 'editor') {
            $updated = Cards::where('id', $id)->first();

            Validator::make($request->all(), [
                'title' => 'required|max:255',
                'description' => 'required|max:255',
            ])->validate();

            // dd(empty($request->file()));

            $updated->update($request->all());
            return redirect()->back()->with('success', 'Card edited successfully.');
        }
        return redirect()->back()->with('errormsg', 'You do not have access to edit a Card.');
    }

    public function add_attachment(Request $request, $id){
        if (Auth::user()->type == 'editor' && !empty($request->file())) {

            $img_path = $request->file()['attachment'];

            $img_data = file_get_contents($img_path);
            $type = pathinfo($img_path, PATHINFO_EXTENSION);
            $base64 = base64_encode($img_data);

            $card = Cards::where('id', $id)->first();
            $card->attachment = 'data:image/' . $type . ';base64,' . $base64;
            $card->save();
            return redirect()->back()->with('success', 'Attachment Added successfully.');
        }
        return redirect()->back()->with('errormsg', 'You do not have access to add a Attachment.');
    }

    public function destroy($id)
    {
        if (Auth::user()->type == 'editor') {
            Cards::where('id', $id)->first()->delete();
            return redirect()->back()->with('success', 'Card deleted successfully.');
        }
        return redirect()->back()->with('errormsg', 'You do not have access to delete a Card.');
    }

    public function destroy_attachment($id)
    {
        if (Auth::user()->type == 'editor') {
            $card = Cards::where('id', $id)->first();
            $card->attachment = "";
            $card->save();
            return redirect()->back()->with('success', 'Attachment Removed successfully.');
        }
        return redirect()->back()->with('errormsg', 'You do not have access to remove a Attachment.');
    }

    public function complete_card($id)
    {
        if (Auth::user()->type == 'editor') {
            $card = Cards::where('id', $id)->first();
            $card->completed = "1";
            $card->save();
            return redirect()->back()->with('success', 'Marked Complete.');
        }
        return redirect()->back()->with('errormsg', 'You do not have access to do that.');
    }

    public function incomplete_card($id)
    {
        if (Auth::user()->type == 'editor') {
            $card = Cards::where('id', $id)->first();
            $card->completed = "0";
            $card->save();
            return redirect()->back()->with('success', 'Marked Incomplete.');
        }
        return redirect()->back()->with('errormsg', 'You do not have access to do that.');
    }
}
