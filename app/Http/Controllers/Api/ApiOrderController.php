<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Mail\OrderStatusChanged;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ApiController;
use App\Models\User;

class ApiOrderController  extends ApiController
{

    public function __construct(Request $request)
    {
        $this->user = auth()->setRequest($request)->user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $postAdmin = Order::where('status', 1)->orderBy('created_at', 'desc')->get();
         $postUser = Order::where('user_id',Auth::user()->id)->where('status', 1)->orderBy('created_at', 'desc')->get();
         $post = Auth::user()->role === 'admin' ? $postAdmin : $postUser ;


        return $post;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $order = Order::create([
        //     'user_id' => $this->user->id,
        //     'order_details' => $request->all(),
        //     'msg' => $request->payload["msg"]
        // ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      if ($this->user->role !== 'admin') {
        return $this->responseUnauthorized();
      }

        $order = Order::where('id', $id)->first();
        $orderUser = User::where('id', $order->user_id)->first();

        $order->order_status = $request->order_status;
        $order->save();

        Mail::to($orderUser)->send(new OrderStatusChanged($order));

        return response()->json($order);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
