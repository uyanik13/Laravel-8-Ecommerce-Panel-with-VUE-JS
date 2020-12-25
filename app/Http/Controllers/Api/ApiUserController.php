<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Resources\invoiceResource;

use App\Models\User;

use Carbon\Carbon;
use http\Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ApiUserController extends ApiController
{



  public function index(Request $request)
  {


    $user = auth()->setRequest($request)->user();
    // Get user from $request token.
    if (!$user->role == 'admin') {
      return $this->responseUnauthorized();
    }
    $collection = User::all();
    return $collection->toJson();
  }


  public function store(Request $request)
  {
    //===========================================
    // ========== GET USER FROM TOKEN ===========
    //===========================================
    $user = auth()->setRequest($request)->user();

    if ($user->role !== 'admin') {
      return $this->responseUnauthorized();
    }

    //===========================================
    // ============ VALIDATION RULES ============
    //===========================================
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'phone' => 'required|unique:users| min:10',
      'password' => 'required|string|min:6',
    ]);
    if ($validator->fails()) {
      return $this->responseUnprocessable($validator->errors());
    }

    //===========================================
    // ===========  INSERT DATABASE =============
    //===========================================
    try {
      $userData = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'email_verified_at' => Carbon::now(),
        'password' => bcrypt($request->password),
      ]);
      $userData->toArray();


      //===========================================
      // ================ RESPONSE ================
      //===========================================
      return response()->json([
        'status' => 201,
        'message' => 'User created.',
      ], 201);

    } catch (\Exception $e) {
      return $this->responseServerError('Error creating user.');
    }


  }


  public function update(Request $request, $id)
  {
    //===========================================
    // ========== GET USER FROM TOKEN ===========
    //===========================================


    $user = auth()->setRequest($request)->user();
    // Get user from $request token.
    if (!$user->role === 'admin') {
      return $this->responseUnauthorized();
    }


    //===========================================
    // ============ VALIDATION RULES ============
    //===========================================

    $validator = Validator::make($request->all(), [
      'name' => 'max:255',
      'address' => 'max:255',
      'phone' => ' Integer',
    ]);
    if ($validator->fails()) {
      return $this->responseUnprocessable($validator->errors());
    }

    $userData = User::where('id', $id)->firstOrFail();

    if ($request['old_password']) {
      if (!Hash::check($request['old_password'], Auth::user()->password)) {
        return $this->responseServerError('The old password does not match our records.');
      }
      $userData->password = request('password') ? bcrypt(request('password')) : $userData->password;
    }

    //===========================================
    // ===========  INSERT DATABASE =============
    //===========================================
    try {

      if ($userData) {
        $userData->name = request('name') ? request('name') : $userData->name;
        $userData->address = request('address') ? request('address') : $userData->address;
        $userData->email = request('email') ? request('email') : $userData->email;
        $userData->phone = request('phone') ? request('phone') : $userData->phone;
        $userData->about_data = request('about_data') ? json_encode(request('about_data')) : $userData->about_data;
        $userData->social_data = request('social_data') ? json_encode(request('social_data')) : $userData->social_data;
        $userData->user_data = request('user_data') ? json_encode(request('user_data')) : $userData->user_data;
        $userData->notification_data = request('notification_data') ? json_encode(request('notification_data')) : $userData->notification_data;

        if (request('avatar')) {
          $userData->avatar = PostImageHelper('avatar', request('avatar'), 'user');
        }


        $userData->role = request('role') ? request('role') : $userData->role;
        $userData->status = request('status') ? request('status') : $userData->status;
        $userData->save();

        return $this->responseResourceUpdated();
      } else {
        return $this->responseUnauthorized();
      }
    } catch (Exception $e) {
      return $this->responseServerError($e);
    }
  }


  public function show(Request $request, $id)
  {

    $user = auth()->setRequest($request)->user();
    // Get user from $request token.
    if (!$user) {
      return $this->responseUnauthorized();
    }

    if ($user->id === $id || $user->role === 'admin') {
      $user = User::where('id', $id)->firstOrFail();
    }


    return new invoiceResource($user);
  }


  public function destroy(Request $request, $id)
  {
    $user = auth()->setRequest($request)->user();
    // Get user from $request token.
    if (!$user->role === 'admin') {
      return $this->responseUnauthorized();
    }
    $userData = User::where('id', $id)->firstOrFail();

    try {
      $userData->delete();
      return $this->responseResourceDeleted();
    } catch (Exception $e) {
      return $this->responseServerError('Error deleting resource.');
    }
  }

  public function CurrentUser(Request $request)
  {

    $user = auth()->setRequest($request)->user();
    // Get user from $request token.
    if (!$user) {
      return $this->responseUnauthorized();
    }

    return response()->json($user);


  }






  public function follow(Request $request)
  {
    $user = auth()->setRequest($request)->user();
    // Get user from $request token.
    if (!$user->role === 'admin') {
      return $this->responseUnauthorized();
    }

    $otherUser = User::where('id', $request->id)->firstOrFail();
    $user->follow($otherUser);

    return response()->json($otherUser);


  }

  public function unFollow(Request $request)
  {
    $user = auth()->setRequest($request)->user();
    // Get user from $request token.
    if (!$user->role === 'admin') {
      return $this->responseUnauthorized();
    }

    $otherUser = User::where('id', $request->id)->firstOrFail();
    $user->unfollow($otherUser);

    return response()->json($otherUser);


  }


  public function myFollowData(Request $request)
  {
    $user = auth()->setRequest($request)->user();
    if (!$user) {
      return $this->responseUnauthorized();
    }

      $data = [
        'my_following_data' => $user->followings,
        'my_followers_data' => $user->followers,
      ];

    return $data;


  }

  public function Contacts(Request $request)
  {
    $user = auth()->setRequest($request)->user();
    if (!$user) {
      return $this->responseUnauthorized();
    }


    $combined = array_merge_recursive($user->followings->toArray(),$user->followers->toArray());
    $combined = array_unique($combined, 1);

    return response()->json($combined);



  }


}
