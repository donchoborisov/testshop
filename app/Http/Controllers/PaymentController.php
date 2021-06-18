<?php

namespace App\Http\Controllers;
use Stripe;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Auth;
use App\Mail\WelcomeMail;
use App\Mail\PaymentConfirmation;
use App\Product;
use App\Jobs\ChargeCustomer;
use App\Jobs\SecondEmailJob;

class PaymentController extends Controller
{
    public function payment(Request $request){
        $this->validate($request,[
            'email' => 'required|email'
        ]);

        $email = $request->email;
       
        $pid = $request->pid;
     
        $product = Product::where('id',$pid)->first();

        if(!Auth::user()){

            return redirect()->route('login')->with("Status","Please login");    
           

        }elseif(Auth::user()->email != $email) {
            
            return redirect()->back()->with("status","This email is not registered!");  
           
        }else {
            return view('stripe',compact('product','email')); 
        }
       
       

    }


    public function StripeCharge(Request $request) {

        $product_name = $request->product_name;
        $product_price = $request->product_price / 2 ;

    //     Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    //    $mailInfo = Stripe\Charge::create ([
    //             "amount" => $product_price * 100,
    //             "currency" => "gbp",
    //             "source" => $request->stripeToken,
    //             "description" => $product_name 
    //     ]);

    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = \Stripe\Customer::create(array(
            "email" => $email = Auth::user()->email,
            "source" => $request->stripeToken
        ));

        $mailInfo = \Stripe\Charge::create(array(
             "amount" => $product_price * 100,
             "currency" => "gbp",
             "customer" => $customer->id,
             "description" => "Deposit" . "-" . $product_name 
        ));

        $customerId = $customer->id;
        $amount = $product_price;
        


             
  
        $email = Auth::user()->email;
            
          Mail::to($email)->send(new WelcomeMail($mailInfo));

        
        

           dispatch(New ChargeCustomer( $customerId,$amount) )->delay(now()->addMinutes(5));

            dispatch(New SecondEmailJob($email))->delay(now()->addMinutes(5));
          
         
         
        

        
          
        return view('confirmation');

    }



    public function confirmation(){

        return view('confirmation');
    }
}
