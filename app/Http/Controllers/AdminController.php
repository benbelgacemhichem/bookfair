<?php

namespace App\Http\Controllers;

use App\DataTables\BooksDataTable;
use App\Models\Book;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(BooksDataTable $dataTable)
    {
        return $dataTable->render('admin.dashboard');
    }
    
    public function newBook()
    {
        return view('admin.new_book');
    }

    public function orders()
    {
        return view('admin.orders');
    }
    
    public function addBook(Request $request)
    {
        $request->validate([
            'name' => 'required|min:6',
            'author' => 'required|min:6',
            'description' => 'required',
            'image' => 'required'
        ]);

        $book = new Book();
        $book->name =  $request->name;
        $book->author =  $request->author;
        $book->description =  $request->description;

        if ($request->image) {
            $book->image = $this->uploadFile($request->image, '/images/books/');
        }

        $book->save();
        return redirect()->route('admin.home')->with('success', 'Book added successfully');

    }

    public function uploadFile($file, $dist)
    {
        $originalFileName = $file->getClientOriginalName();
        $filename = md5(time()) . '_' . $originalFileName;
        $file->move(public_path($dist), $filename);
        $path = $dist . $filename;
        return $path;
    }
}
