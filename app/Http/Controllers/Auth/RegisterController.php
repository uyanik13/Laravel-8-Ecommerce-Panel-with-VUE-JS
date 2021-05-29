<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
  //use RegistersUsers;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest');
  }


  public function register(Request $request)
  {
      $this->validator($request->all())->validate();

      event(new Registered($user = $this->create($request->all())));

      return $this->registered($request, $user)
          ?: redirect($this->redirectPath());
  }

  /**
   * The user has been registered.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\JsonResponse
   */
  protected function registered(Request $request, User $user)
  {
    if ($user instanceof MustVerifyEmail) {
      $user->sendEmailVerificationNotification();

      return response()->json(['status' => trans('verification.sent')]);
    }

    return response()->json($user);
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data)
  {
    return Validator::make($data, [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:6',
    ]);
  }


  protected function create(array $data)
  {



     $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => bcrypt($data['password'])
       ]);

       return $user;

  }

  protected function registerWithApi(Request $request)
  {



    $validator = $this->validator($request->all());


    if ($validator->fails()) {
        return $validator->errors();
      }

    event(new Registered($user = $this->create($request->all())));

    return response()->json([
        'status' => "success",
        'locale' => app()->getLocale(),
        'errors' => false,
        'data' => [
            'message' => trans('lang.registerSuccessfull'),
        ]
    ], 201);
  }


}
