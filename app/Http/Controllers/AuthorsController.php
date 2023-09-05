<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $author = Author::paginate(12);
        return view('admin.authors.index' , compact('author'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.authors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Author $author)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        //
    }
    public function list()
    {
        $authors = Author::all()->sortBy('name');
        $title = "المؤلفون";
        return view('authors.index', compact(['authors', 'title']));
    }
    public function result(Author $author){
        $books = $author->books()->paginate(12);
        $title = " الكتب الخاصه بالمؤلف :".$author->name ; 
        return view('gallery' , compact(['books' , 'title']));
    }
    public function search(Request $request){
        $authors = Author::where('name' ,'like' , "%$request->term%")->paginate(12) ; 
        $title = 'نتيجه البحث عن :' . $request->term ;
        return view('authors.index' , compact(['authors' , 'title']));
    }

}
