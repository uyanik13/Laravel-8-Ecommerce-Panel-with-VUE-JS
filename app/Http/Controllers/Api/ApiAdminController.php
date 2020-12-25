<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Setting;
use App\Mail\ShortEmail;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Validator;


class ApiAdminController extends ApiController
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
      public function index(Request $request)
    {

      if ($this->user->role !== 'admin') {
        return $this->responseUnauthorized();
      }

      $orders = Order::orderBy('created_at','desc')->get();




      $staff = User::where('role','staff')->orderBy('created_at','desc')->get();

      $payments = Payment::orderBy('created_at','desc')->where('status','completed')->get();

    //   $recurringPayments = [];

    //   foreach ($payments as $key => $payment) {
    //     $recurringPayments[$payment->user->id] = [
    //         'payment_count' =>  Payment::where('user_id',  $payment->user_id)->count(),
    //         'user_id' =>  $payment->user->id,
    //         'user_email' =>  $payment->user->email,
    //         'user_phone' =>  $payment->user->phone,
    //         'user_name' =>  $payment->user->name,
    //         'paymentsAmount' =>  number_format(Payment::where('user_id',  $payment->user_id)->sum('amount'),2)
    //     ];
    //  }



      $paymentsPaginated = Payment::orderBy('created_at','desc')->where('status','completed')->paginate(15);

      $lastYearPayments = Payment::whereDate('created_at','>', Carbon::now()->addYears(-1))->where('status','completed')->get();

      $lastWeekPayments = Payment::whereDate('created_at','>', Carbon::now()->addWeek(-1))->where('status','completed')->get();

      $lastMonthPayments = Payment::whereDate('created_at','>', Carbon::now()->addMonth(-1))->where('status','completed')->get();

      $thisMonthPayments = Payment::orderBy('created_at', 'DESC')->whereDate('created_at','>', Carbon::now()->subMonth())->where('status','completed')->get();

         $countries =[];

        foreach ($payments as $key => $payment) {
            $countries[$payment->payment_country] =  Payment::where('payment_country', '=', $payment->payment_country)->count();
        }




      $averageWeeklySalesRevenue = Payment::whereDate('created_at','>', Carbon::now()->addWeek(-1))->avg('amount');

      $data = [

          'staff' => $staff,
          'orders' => $orders,
          'payments' => $payments,
          //'recurringPayments' => $recurringPayments,
          'paymentsPaginated' => $paymentsPaginated,
          'lastYearPayments' => $lastYearPayments,
          'lastWeekPayments' => $lastWeekPayments,
          'lastMonthPayments' => $lastMonthPayments,
          'thisMonthPayments' => $thisMonthPayments,
          'countries' => $countries,
          'averageWeeklySalesRevenue' => $averageWeeklySalesRevenue,
      ];

      return $data;
    }


      public function staff(Request $request)
    {

      if ($this->user->role !== 'staff' && $this->user->role !== 'admin') {
        return $this->responseUnauthorized();
      }



      $activeUsers = User::where('isHere',1)->orderBy('created_at','desc')->get();



      $data = [
          'activeUsers' => $activeUsers,
      ];

      return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

      }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

  /**
   * Remove the specified resource from storage.
   *
   * @param Request $request
   * @param $id
   * @return \Illuminate\Http\JsonResponse
   */
    public function destroy(Request $request, $id)
    {

    }
}
