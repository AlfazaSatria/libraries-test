<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries;
use Illuminate\Support\Facades\Auth;
use App\Book;
class LibrariesController extends Controller
{
    protected function create(Request $request){

        $libraries= new Libraries();
        $libraries->user_id= $request['user_id'];
        $libraries->title= $request['title'];
        $libraries->desc=$request['desc'];
        $libraries->save();

        return redirect()->back()->with('success', 'Libraries has been added');
    }

    protected function show(){
        $user=Auth::user();
        $libraries= Libraries::where('user_id', $user->id)->get();
        
        return view('home')->with(['libraries'=> $libraries]);
    }

    protected function destroy($id){
        $libraries= Libraries::findorfail($id);
        $books= Book::where('libraries_id', $libraries->id)->get();
        foreach($books as $book){
            $book=Book::firstwhere('libraries_id', $libraries->id);
            $book->delete();
        }
        $libraries->delete();
        return redirect()->back()->with('delete', 'Libraries has been delete');
    }
}
