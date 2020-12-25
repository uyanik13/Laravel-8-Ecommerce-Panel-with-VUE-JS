<?php

namespace App\Http\Controllers\Api;

use Exception;
use Illuminate\Http\Request;

use App\Http\Controllers\ApiController;
use App\Models\Package;



class ApiPackageController extends ApiController
{

  public function __construct(Request $request)
  {
    $this->user = auth()->setRequest($request)->user();

  }



  public function index(Request $request)
  {


    if (!$this->user) {
      return $this->responseUnauthorized();
    }
    $packages = Package::all();


    return $packages;
  }

  public function store(Request $request)
  {
    //===========================================
    // ========== GET USER FROM TOKEN ===========
    //===========================================
    $user = auth()->setRequest($request)->user();
    // Get user from $request token.
    if ($user->role !== 'admin') {
      return $this->responseUnauthorized();
    }




    try {

     $package= Package::create($request->all());
      return response()->json($package);

    } catch (Exception $e) {
      return $e;
    }


  }

  public function update(Request $request, $id)
  {
    //===========================================
    // ========== GET USER FROM TOKEN ===========
    //===========================================

    $user = auth()->setRequest($request)->user();
    // Get user from $request token.
    if (!$user->role == 'admin') {
      return $this->responseUnauthorized();
    }


    //===========================================
    // ===========  INSERT DATABASE =============
    //===========================================

    try {
      $packageData = Package::where('id', $id)->firstOrFail();
      $packageData->fill($request->all());
      $packageData->save();
      return response()->json($packageData);

    } catch (Exception $e) {
      return $e;
    }

  }

  public function show(Request $request)
  {


  }

  public function destroy(Request $request, $id)
  {
    $user = auth()->setRequest($request)->user();
    // Get user from $request token.
    if (!$user->role === 'admin') {
      return $this->responseUnauthorized();
    }
    $packageData = Package::where('id', $id)->firstOrFail();

    try {
      $packageData->delete();
      return response()->json($packageData);

    } catch (Exception $e) {
      return $this->responseServerError('Error deleting resource.');
    }
  }


//   public function myActivePackages(Request $request)
//   {


//     $packages =  Subscription::where('user_id', $this->user->id)
//         ->where('status', 'completed')->get();

//       $upgradePackage=  Subscription::where('user_id', $this->user->id)
//         ->where('type', 'upgrade_profile')
//         ->where('status', 'active')
//         ->first();

//         $profileDopingPackage=  Subscription::where('user_id', $this->user->id)
//         ->where('type', 'profile')
//         ->where('status', 'active')
//         ->first();

//         $newsDopingPackage=  Subscription::where('user_id', $this->user->id)
//         ->where('type', 'news')
//         ->where('status', 'active')
//         ->first();

//         $serviceDopingPackage=  Subscription::where('user_id', $this->user->id)
//         ->where('type', 'service')
//         ->where('status', 'active')
//         ->first();

//       // dd($profileDopingPackage);
// $upgradePackage_remaining_days = Helper::remainedSubscriptonDate($upgradePackage);
// $profileDopingPackage_remaining_days = Helper::remainedSubscriptonDate($profileDopingPackage);
// $newsDopingPackage_remaining_days = Helper::remainedSubscriptonDate($newsDopingPackage);
// $serviceDopingPackage_remaining_days = Helper::remainedSubscriptonDate($serviceDopingPackage);




//     $data = [
//       'allPackages' => $packages,
//       'upgradePackage_remaining_days' => $upgradePackage_remaining_days,
//       'profileDopingPackage_remaining_days' => $profileDopingPackage_remaining_days,
//       'newsDopingPackage_remaining_days' => $newsDopingPackage_remaining_days,
//       'serviceDopingPackage_remaining_days' => $serviceDopingPackage_remaining_days,
//     ];

//     return $data;
//   }



}
