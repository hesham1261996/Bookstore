<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PhpParser\Node\Expr\FuncCall;
use App\Traits\ImageUploadTrait ;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    use ImageUploadTrait ;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('admin.books.index' , compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $authors    = Author::all();
        $publishers = Publisher::all();
        return view('admin.books.create' , compact('categories' , 'authors' , 'publishers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request , 
        [
            'title'         => 'required',
            'isbn'          => ['required' , 'alpha_num' , Rule::unique('books', 'isbn')] , 
            'cover_image'   => 'image|required' , 
            'categories'    => 'nullable' , 
            'authors'       => 'nullable' , 
            'publisher'     =>  'nullable',
            'description'   =>  'nullable' ,
            'publish_year'  => 'numeric|required',
            'number_of_pages'=> 'numeric|required',
            'number_of_capies'=> 'numeric|required',
            'price'         => 'numeric|required',
        ]
        );
        $book = new Book ; 
        $book->title = $request->title ; 
        $book->cover_image =  $this->uploadImage($request->cover_image);
        $book->isbn = $request->isbn ;
        $book->category_id = $request->categories ;
        $book->publisher_id = $request->publisher ; 
        $book->description = $request->description;
        $book->publish_year = $request->publish_year ;
        $book->number_of_pages = $request->number_of_pages;
        $book->number_of_copies = $request->number_of_capies;
        $book->price = $request->price;
        
        $book->save();
        $book->authors()->attach($request->authors)  ;

        session()->flash('flash_message' , 'تم اضافه الكتاب بناج');

        return redirect()->route('book.show' , $book);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        return view('admin.books.show',compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $categories = Category::all();
        $authors    = Author::all();
        $publishers = Publisher::all();
        return view('admin.books.edit' , compact('book','categories' , 'authors' , 'publishers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $this->validate($request , 
        [
            'title'         => 'required',
            'cover_image'   => 'image' , 
            'categories'    => 'nullable' , 
            'authors'       => 'nullable' , 
            'publisher'     =>  'nullable',
            'description'   =>  'nullable' ,
            'publish_year'  => 'numeric|required',
            'number_of_pages'=> 'numeric|required',
            'number_of_capies'=> 'numeric|required',
            'price'         => 'numeric|required',
        ]
    );
        $book->title = $request->title ; 
        if($request->has('cover_image')){
            Storage::disk('public')->delete($book->cover_image) ;
            $book->cover_image = $this->uploadImage($request->cover_image);
        }
        // $book->cover_image =  $this->uploadImage($request->cover_image);
        $book->isbn = $request->isbn ;
        $book->category_id = $request->categories ;
        $book->publisher_id = $request->publisher ; 
        $book->description = $request->description;
        $book->publish_year = $request->publish_year ;
        $book->number_of_pages = $request->number_of_pages;
        $book->number_of_copies = $request->number_of_capies;
        $book->price = $request->price;
        
        if($book->isDirty('isbn')){
            $this->validate($request , ['isbn'=> ['required' , 'alpha_num' , Rule::unique('books', 'isbn')]
            ]);
            
        }
        $book->save();

        $book->authors()->detach();
        $book->authors()->attach($request->authors)  ;

        session()->flash('flash_message' , 'تم تعديل الكتاب بنجاح');

        return redirect()->route('book.show' , $book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        Storage::disk('public')->delete($book->cover_image);
        $book->delete();

        session()->flash('flash_message' , 'تم حذف الكتاب بنجاح' );

        return redirect()->route('book.index');
    }

    public function details(Book $book){
        $title = $book->title ;
        return view('books.details' ,compact('book' , 'title'));
    }
}
