<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries;
use App\Book;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user=Auth::user();
        $libraries= Libraries::where('user_id', $user->id)->get();
        $books= Book::where('user_id', $user->id)->get();
        return view('home')->with(['libraries'=> $libraries, 'books' => $books]);
    }
}
