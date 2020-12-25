<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Resources\invoiceResource;

use App\Models\Subscription;
use App\Models\User;
use App\Models\Post;
use App\Models\Token;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ApiSubscriptionController extends ApiController
{

  public function __construct(Request $request)
  {
    $this->user = auth()->setRequest($request)->user();






  }


      /**
       * Display a listing of the resource.
       *
       * @return string
       */
      public function index()
      {

        if (!$this->user) {
          return $this->responseUnauthorized();
        }

        $subscriptionsForUser = Subscription::where('user_id',$this->user->id)->orderBy('created_At','desc')->get();

        $subscriptionsForAdmin =  Subscription::orderBy('created_At','desc')->get();

        $subData = $this->user->role === 'admin' ? $subscriptionsForAdmin : $subscriptionsForUser;

        return $subData;

      }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

      if (!$this->user) {
        return $this->responseUnauthorized();
      }
      //===========================================
      // ============ VALIDATION RULES ============
      //===========================================
      $validator = Validator::make($request->all(), [
        'package_id' => 'required|max:255',
        'title' => 'required|max:255',
        'amount' => 'required|max:255',
      ]);
      if ($validator->fails()) {
        return $this->responseUnprocessable($validator->errors());
      }



      //===========================================
      // ===== DATE FORMATS & INVOICE USER ========
      //===========================================



     if($this->user->token < $request->amount){
      //return $this->responseServerError(['message' => 'Your Token is Not Enought',]);
      return $this->responseUnprocessable(['status' => 401,'message' => 'Your Token is Not Enought', ]);
     }else{

      $payment_id    = Carbon::now()->timestamp;
      $Subscription_start = Carbon::now();
      $Subscription_end   = $request->annual ?  Carbon::now()->addDays(365) : Carbon::now()->addDays(30);



      //===========================================
      // ===========  INSERT DATABASE =============
      //===========================================
      try {
        $Subscription = Subscription::create([
          'user_id' => $this->user->id,
          'payment_id' => $payment_id,
          'package_id' => $request->package_id,
          'title' => $request->title,
          'amount' => $request->amount,
          'start_at' => $Subscription_start,
          'ends_at' => $Subscription_end,
          'options' => json_encode($request->options),

        ]);

        $this->user->token = $this->user->token - ($request->amount);
        $this->user->save();

        $post= Post::where('id',$request->options['id'])->firstOrFail();
        $post->emergency = 1;
        $post->save();

        $admin= User::where('role','admin')->firstOrFail();

         Token::create([
          'title'=>$request->title,
          'from'=>$this->user->id,
          'to'=> $admin->id,
          'amount' => $request->amount,
          'status' => 'completed',
        ]);
        //===========================================
        // ====== SAVE SETTINGS AND INFORMATION ====
        //===========================================
        //Helper::InvoiceSaveHelper($user,$InvoiceUser,$request->price);

        //===========================================
        // ============= NOTIFICATION ===============
        //===========================================
        //Helper::InvoiceNotifyHelper($invoice,$InvoiceUser);

        //===========================================
        // ================ RESPONSE ================
        //===========================================
        return response()->json(['status' => 201,'message' => 'Subscription Successfull', ], 201);

      } catch (\Exception $e) {
        return $this->responseServerError($e);
      }
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $ida
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

      /**
       * Remove the specified resource from storage.
       *
       * @param  int  $id
       * @return \Illuminate\Http\Response
       */
      public function destroy($id)
      {
          //
      }

  public function create_payment(Request $request){

    $user = auth()->setRequest($request)->user();
    // Get user from $request token.
    if (!$user->role == 'store' || !$user->role == 'admin') {
      return $this->responseUnauthorized();
    }
    //===========================================
    // ============ VALIDATION RULES ============
    //===========================================
    $validator = Validator::make($request->all(), [
      'plan_name' => 'required|max:255',
      'price' => 'required|Numeric',
    ]);
    if ($validator->fails()) {
      return $this->responseUnprocessable($validator->errors());
    }
    $shopier_api = new ShopierApi();


    $productData = array(
      "name"           => $request->plan_name,
      "amount"         => number_format((double)$request->price, 2, '.', ''),
      "extraData"      => number_format((double)$request->price, 2, '.', ''),
      "paymentChannel" => "1,2,3",
    );

    $billingPhone   = '905456134513';
    $billingAddress   = 'inkılap mah';
    $billing_city   = 'istanbul';
    $billingCountry   = 'turkiye';
    $billing_postcode   = '34768';
    $order_id   =  hash('sha256', microtime());
    $amount   =  $productData['amount'];

    $userData = array(
      "id" 		        => $user->id,
      "first_name" 		=> $user->name,
      "last_name" 		=> $user->name,
      "email" 			=> $user->email,
      "order_id"      	=> $order_id,
      "amount" 	        => $amount,
      "phone" 	        => $billingPhone,
      "address" 	        => $billingAddress,
      "city" 	            => $billing_city,
      "country" 	        => $billingCountry,
      "post_code" 	    => $billing_postcode,
    );

    $shopier_api->create_payment($userData);

    $data = array(
      "user_id" 				=> $user->id,
      "user_name" 				=> $user->name,
      "plan_name" 				=> $request->plan_name,
      "price" 	=> $request->price,
      "created_at" 	=> Carbon::now(),
      "updated_at" 	=> Carbon::now(),
    );

    DB::table('temporary_payments')->insert($data);


  }

      public function shopier_payment_callback(Request $request)
      {
        $user = auth()->setRequest($request)->user();
        // Get user from $request token.
        if (!$user->role == 'store' || !$user->role == 'admin') {
          return $this->responseUnauthorized();
        }
        //===========================================
        // ============ VALIDATION RULES ============
        //===========================================
        $validator = Validator::make($request->all(), [
          'status' => 'required',
        ]);
        if ($validator->fails()) {
          return $this->responseUnprocessable($validator->errors());
        }

        $appUrl = env('APP_URL');
        $status =  $request->status;
        $Subscription_id    = Carbon::now()->timestamp;
        $Subscription_start = Carbon::now()->format('d-m-Y');
        $Subscription_end   = Carbon::now()->addDays(365)->format('d-m-Y');
        $temporaryPayment = DB::table('temporary_payments')->where('user_id', $user->id)->latest()->first();
        $userData = User::where('id', $user->id)->firstOrFail();

        if($status == 'success' && $temporaryPayment->user_id == $user->id) {
          $Subscription = Subscription::create([
            'user_id' => $user->id,
            'subscription_id' => $Subscription_id,
            'user_name' => $user->name,
            'plan_name' => $temporaryPayment->price,
            'price' => $temporaryPayment->price,
            'start_at' => $Subscription_start,
            'ends_at' => $Subscription_end
          ]);

          $userData->status = '1';
          $userData->save();

          return header("Location: $appUrl");
        }else{
          return back()->withInput();
        }

      }

}
