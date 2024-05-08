<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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


    public function index()
    {
        $books = Book::all();
        return view('home', compact('books'));
    }

    public function bags($lang)
    {
        if($lang == 'en'){
            return view('bags');
        }else{
            return view('bags-ar');
        }

    }

    public function book_submit(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|min:8',
        ]);
        if($validator->fails()){
            return response()->json( ['errors' => $validator->errors()]);
        }else{
            $visitor = new Visitor();
            $visitor->full_name = $request->name;
            $visitor->email = $request->email;
            $visitor->phone_number = $request->phone;
            $visitor->book_id = $request->book_id;
            $visitor->type = 'Book';
            $visitor->status = 'submitted';
            $visitor->save();
            // event(new OrderPrint($visitor->id));
            return response()->json(['success' => 'You are registered successfully!' ]);
        }
    }

    public function bag_submit(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|min:8',
            'bag_content' => 'required',
        ]);
        if($validator->fails()){
            return response()->json( ['errors' => $validator->errors()]);
        }else{
            $visitor = new Visitor();
            $visitor->full_name = $request->name;
            $visitor->email = $request->email;
            $visitor->phone_number = $request->phone;
            $visitor->type = 'Bag';
            $visitor->bag_style = $request->bag_style;
            $visitor->bag_content = $request->bag_content;
            $visitor->status = 'submitted';
            $visitor->save();
            // event(new OrderPrint($visitor->id));
            return response()->json(['success' => 'Bag registered successfully!' ]);
        }
    }
}
