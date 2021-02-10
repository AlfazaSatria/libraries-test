<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries;
use App\Book;
use Illuminate\Support\Facades\Auth;
class BookController extends Controller
{
    protected function create(Request $request){
        $user=Auth::user();
        $libraries = Libraries::where('user_id', $user->id)->get();

        $book= new Book();
        $book->user_id=$request['user_id'];
        $book->libraries_id= $request['libraries_id'];
        $book->title= $request['title'];
        $book->save();

        return redirect()->back()->with(['libraries'=> $libraries]);
    }

    protected function show(){
        $user=Auth::user();
        $libraries= Libraries::where('user_id', $user->id)->get();
        $books= Book::where('user_id', $user->id)->get();
        return view('home')->with(['libraries'=> $libraries, 'books' => $books]);
    }
}
