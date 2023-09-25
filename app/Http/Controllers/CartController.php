<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addTocart(Request $request){
        $book = Book::find($request->id);
        

        if(auth()->user()->bookInCart->contains($book)){
            $newQuantity = $request->quantity + auth()->user()->bookInCart()->where('book_id' , $book->id)->first()->pivot->number_of_copies ;

            if($newQuantity > $book->number_of_copies){

                session()->flash('warinig_message' , 'لم يتم اضافه الكتاب اقصي عدد يمكنك اضاقته من الكاب هو' .$book->number_of_copies - auth()->user()->bookInCart()->where('book_id' , $book->id)->first()->pivot->number_of_copies);

                return redirect()->back();
            }else{
                auth()->user()->bookInCart()->updateExistingPivot($book->id , ['number_of_copies'=> $newQuantity]);
            }
        }else{
            auth()->user()->bookInCart()->attach($request->id ,['number_of_copies'=>$request->quantity]);
        }

        $num_of_product = auth()->user()->bookInCart()->count();
        return response()->json(['num_of_product' , $num_of_product]);
    }

    public function veiwCart(){
        $items = auth()->user()->bookInCart ;
        $title = __('عربه التسوق');
        return view('cart' , compact('items' , "title"));
    }

    public function removeOne(Book $book){
        $quntity = auth()->user()->bookInCart()->where('book_id' , $book->id)->first()->pivot->number_of_copies ;
        if($quntity > 1 ){
            auth()->user()->bookInCart()->updateExistingPivot($book->id , ['number_of_copies' => $quntity - 1]);
        }else{
            auth()->user()->bookInCart()->detach($book->id);
        }
        return redirect()->back();
        
    }

    public function removeAll(Book $book){
        
        auth()->user()->bookInCart()->detach($book->id);

    }
}
