<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Setting;
use App\Mail\ShortEmail;
use App\Custom\ShopierApi;
use App\Mail\OrderCreated;

use Cartalyst\Stripe\Stripe;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ApiPaymentController extends Controller
{
   public function __construct(Request $request)
    {
        $this->package = jsonToObject($request->package);
        $this->setting = namedSettings(Setting::all());
        $this->shopier_api = new ShopierApi();
        $this->user = Auth::user();
        $this->admin = User::where('role', 'admin')->first();
        $this->paymentSuccess = false;
    }

    public function create_payment(Request $request)
    {

        $price = cartTotal($this->user,'user') * 8.20;
         $productData = array(
         "name" => 'shopping_cart',
         "amount" => number_format((double)$price, 2, '.', ''),
         "extraData" => number_format((double)$price, 2, '.', ''),
         "paymentChannel" => "1,2,3",
         );

         $billingPhone = '905456134513';
         $billingAddress = 'inkılap mah';
         $billing_city = 'istanbul';
         $billingCountry = 'turkiye';
         $billing_postcode = '34768';
         $order_id = hash('sha256', microtime());
         $amount = $productData['amount'];

         $userData = array(
            "id" => $this->user->id,
            "first_name" => $this->user->name,
            "last_name" => $this->user->name,
            "email" => $this->user->email,
            "order_id" => $order_id,
            "amount" => $amount,
            "phone" => $billingPhone,
            "address" => $billingAddress,
            "city" => $billing_city,
            "country" => $billingCountry,
            "post_code" => $billing_postcode,
         );

          $payment = Payment::create([
          'user_id' => $this->user->id,
          'payment_id' => Carbon::now()->timestamp,
          'payment_method' => 'shopier',
          'amount' => $price,
          'status' => 'pending',
          ]);

          session()->put('payment_id',$payment->id);

        return  $this->shopier_api->create_payment($userData);



    }


    public function shopierPaymentCallback (Request $request)
    {
                $paymentId = session()->get('payment_id');
                $payment = Payment::find($paymentId);
                $status = $request->status;
                if($status == 'success' && $payment->user_id === $this->user->id) {

                        $payment->status = 'completed';
                        $payment->save();

                        return
                        Redirect::route('page.home',Carbon::now()->timestamp)->withSuccess(trans('lang.payment_success'));
                    }else{
                         return redirect()->back()->withError(trans('lang.payment_unsuccess'));
                    }



    }




}
