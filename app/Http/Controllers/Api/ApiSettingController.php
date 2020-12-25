<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Models\Setting;

use Illuminate\Http\Request;

class ApiSettingController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $settings = Setting::all();
      return $settings->toArray();

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
      // Get user from $request token.
      if (!$user->role == 'admin') {
        return $this->responseUnauthorized();
      }


      try {
        if (is_array($request->all())) {
          foreach ($request->all() as $name => $value) {
            //$type = $name == 'type' ? $value : '';
            if($name == 'logo' ){
              $image = strlen($value) > 255 ? PostImageHelper('logo',$value,'setting') : $value;
              $setting = Setting::firstOrCreate(['name' => $name]);
              $setting->value = $image;
              $setting->save();
            }else{
              $setting = Setting::firstOrCreate(['name' => $name]);
              if($name === $setting->name ){
                $setting->value = $value;
                $setting->save();
              }else{
                Setting::create([
                  'name' =>$name,
                  'value' => $value,
                ]);
              }
            }


          }
          return true;
        }

        return response()->json([
          'status' => 201,
          'message' => 'Setting created.',
        ], 201);

      } catch (\Exception $e) {
        return $this->responseServerError($e);
      }





    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
