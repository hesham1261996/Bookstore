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
        $authors = Author::paginate(10);
        return view('admin.authors.index' , compact('authors'));
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
        $vilidate = request()->validate([
            'name' => 'required',
            'description' => 'nullable'
        ]);

        Author::create($vilidate);
        session()->flash('flash_message' , 'تم اضافه المؤلف');
        return redirect()->route('authors.index');

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
        return view('admin.authors.edit' , compact('author'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Author $author)
    {
        $vilidate = request()->validate([
            'name' => 'required',
            'description' => 'nullable'
        ]);

        Author::update($vilidate);
        session()->flash('flash_message' , 'تم تعديل المؤلف');
        return redirect()->route('authors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Author $author)
    {
        $author->delete();
        session()->flash('flash_message' , 'تم حذف المؤلف');
        return redirect()->route('authors.index');
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
