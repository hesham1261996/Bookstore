<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $date = request()->validate([
            'name' => 'required',
            'description' => 'nullable' 
        ]);
        
        Category::create($date);

        session()->flash('flash_message' , 'تم اضافه التصنيف');

        return redirect()->route('categories.index');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show' , compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit' , compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $date = request()->validate([
            'name' => 'required',
            'description' =>'nullable'
        ]);

        if($category->update($date)){
            session()->flash('flash_message' , 'تم تعديل التصنيف');
            return redirect()->route('categories.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');

    }
    public function result(Category $category){
        $books = $category->books()->paginate(12);
        $title = " الكتب الخاصه بتصنيف :".$category->name ; 
        $category =  Category::all();
        return view('gallery' , compact(['category', 'books' , 'title']));
    }

    public function list(){
        $categories = Category::all()->sortBy('name');
        $title = "التصنيفات";
        return view('categories.index' , compact(['categories' , 'title']));
    }
    public function search(Request $request){
        $categories = Category::where('name' , 'like' , "%$request->term%")->paginate(12);
        $title = "نتائج البحث عن : ".$request->term ;
        return view('categories.index' , compact(['categories' ,'title']));
    }
}
