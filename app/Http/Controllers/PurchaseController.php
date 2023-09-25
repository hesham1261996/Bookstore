<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;


class PurchaseController extends Controller
{
    public function sendOrderConfirmationOrder($order , $user)
{
    Mail::to($user->email)->send(new OrderMail($order , $user));

}    public function CreditCheckout(Request $request){
        $intent = auth()->user()->createSetupIntent();

        $title = __('الدفع بالبطاقه');
        $userId = auth()->user()->id ;
        $books =  User::find($userId)->bookInCart ; 
        $total = 0 ;
        foreach($books as $book) {
            $total += $book->price * $book->pivot->number_of_copies ; 
        }

        return view('credit.checkout' , compact('total', 'intent' , 'title'));
    }

    public function purchase(Request $request){
        $user       = $request->user() ; 
        $paymentMethod = $request->input('payment_method') ;

        $userId = auth()->user()->id ;
        $books =  User::find($userId)->bookInCart ; 
        $total = 0 ;
        $this->sendOrderConfirmationOrder($books , auth()->user());
        foreach($books as $book) {
            $total += $book->price * $book->pivot->number_of_copies ; 
        }
        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $user->charge($total * 100, $paymentMethod);        
        } catch (\Exception $exception) {
            return back()->with('message', 'حدث خطأ اثناء الدفع');
        }
    

        foreach($books as $book){
            $bookPrice = $book->price ;
            $purchaseTime = Carbon::now();
            $user->bookInCart()->updateExistingPivot($book->id , ['bought' => true , 'price' => $bookPrice , "created_at" => $purchaseTime]);
            $book->save();

        }
        return redirect('/cart')->with('success', 'تم شراء المنتج بنجاح');
    }
}
