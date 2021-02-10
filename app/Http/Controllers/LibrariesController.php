<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries;
use Illuminate\Support\Facades\Auth;
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

    protected function show(Request $request){
        $user=Auth::user();
        $libraries= Libraries::where('user_id', $user->id)->get();
        
        return view('home')->with(['libraries'=> $libraries]);
    }
}
