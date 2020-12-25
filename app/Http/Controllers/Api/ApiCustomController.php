<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Models\Custom;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ApiController;
use App\Http\Resources\invoiceResource;

class ApiCustomController extends ApiController
{
    public  $api_payment_controller;
    public function __construct(ApiPaymentController $api_payment_controller)
    {
        $this->api_payment_controller= $api_payment_controller;
    }

    /**
     * Display a listing of the resource.
     *
     * @return string
     */

    public function index(Request $request)
    {
      $user = auth()->setRequest($request)->user();
      // Get user from $request token.
      if (!$user->role == 'admin') {
        return $this->responseUnauthorized();
      }
      $collection = Custom::all();
      return $collection->toJson();
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
      $user = auth()->setRequest($request)->user();

      if ($user->role !== 'admin') {
        return $this->responseUnauthorized();
      }

       $customData = '';



       //$image = Helper::siteSettingsImageUpload();

        $customData = Custom::where('type',$request->type)->first();
        if($customData){
            $customData = Custom::where('type',$request->type)->firstOrFail();
            $requestData = $request->all();
            if(isset($requestData[$request->type][0]['image'])){
               foreach ($requestData[$request->type] as $index => $data) {
                   if($data['image']){
                     $fileName = 'image-'.time();
                     $requestData[$request->type][$index]['image'] = PostImageHelper(Str::slug($fileName), $data['image'], 'site-settings');
                     }
                   }
               }
            $customData->JsonData = json_encode($requestData);
            $customData->save();
        }else{


             $requestData = $request->all();
             if(isset($requestData[$request->type][0]['image'])){
                foreach ($requestData[$request->type] as $index => $data) {
                    if($data['image']){
                      $fileName = 'image-'.time();
                      $requestData[$request->type][$index]['image'] = PostImageHelper(Str::slug($fileName), $data['image'], 'site-settings');
                      }
                    }
                }

             $customData = Custom::create([
                'user_id' => $user->id,
                'JsonData' => json_encode($requestData),
                'type' => $request->type,
              ]);
        }

        return response()->json($customData);

    }

  public function show(Request $request, $id)
  {

    $user = auth()->setRequest($request)->user();
    // Get user from $request token.
    if (!$user->role === 'admin') {
      return $this->responseUnauthorized();
    }


      $Custom = Custom::where('id', $id)->firstOrFail();



    return new invoiceResource($Custom);
  }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Custom  $custom
     * @return \Illuminate\Http\Response
     */
    public function edit(Custom $custom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Custom  $custom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Custom $custom)
    {
        //
    }

    public function destroy(Request $request, $id)
    {
      $user = auth()->setRequest($request)->user();
      // Get user from $request token.
      if (!$user->role === 'admin') {
        return $this->responseUnauthorized();
      }
      $userData = Custom::where('id', $id)->firstOrFail();

      try {
        $userData->delete();
        return $this->responseResourceDeleted();
      } catch (Exception $e) {
        return $this->responseServerError('Error deleting resource.');
      }
    }


    public  function create_session(Request $request){

        $data = [
            "name"=>$request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password),
            "address" =>json_encode($request->bill_address),
            "bill_address" =>json_encode($request->bill_address),
            "phone" =>$request->phone,
            ];

            dd($data['bill_address']);
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                "address" =>json_encode($request->bill_address),
                'bill_address' => $data['bill_address'],
                'phone' => $data['phone'],
                'password' => $data['password'],
            ]);

          session()->put('user', $user);

          return response()->json($user);

        $this->api_payment_controller->create_payment();
    }


}
