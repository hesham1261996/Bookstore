<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublishersConrller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publishers = Publisher::all();
        return view('admin.publishers.index',compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.publishers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = request()->validate([
            'name' => 'required' ,
            'address' => 'nullable'
        ]);
        Publisher::create($validate);
        session()->flash('flash_message' , 'تم اضافه الناشر');
        return redirect()->route('publishers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publisher $publisher)
    {
        return view('admin.publishers.edit' , compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publisher $publisher)
    {
        $validate = request()->validate([
            'name' => 'required' ,
            'address' => 'nullable'
        ]);
        $publisher->update($validate);
        session()->flash('flash_message' , 'تم تعديل الناشر');
        return redirect()->route('publishers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Publisher $publisher)
    {
        $publisher->delete();
        session()->flash('flash_message' , 'تم حذف الناشر');
        return redirect()->route('publishers.index');
    }

    public function list(){
        $publishers = Publisher::all()->sortBy('name');
        $title = "الناشرون";
        return view('publishers.index' , compact(['publishers' , 'title']));
    }

    public function result(Publisher $publisher){
        $books = $publisher->books()->paginate(12);
        $title = " الكتب الخاصه بالناشر :".$publisher->name ; 
        return view('gallery' , compact(['books' , 'title']));

    }
    public function search(Request $request){
        $publishers = Publisher::where('name' ,'like' , "%$request->term%")->paginate(12) ; 
        $title = 'نتيجه البحث عن :' . $request->term ;
        return view('publishers.index' , compact(['publishers' , 'title']));

    }
}
