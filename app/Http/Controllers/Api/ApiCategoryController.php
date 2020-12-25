<?php

namespace App\Http\Controllers\Api;


use http\Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Category;


class ApiCategoryController extends ApiController
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

    $categories = Category::orderBy('created_at', 'desc')->get();

    return $categories;
  }


  public function store(Request $request)
  {

    if (!$this->user) {
      return $this->responseUnauthorized();
    }

    try {

        $category = Category::create($request->all());
        return response()->json($category);

      } catch (\Exception $e) {
        return $e;
      }

  }

  public function update(Request $request, $id)
  {

    if (!$this->user) {
      return $this->responseUnauthorized();
    }

        $postData = Category::where('id', $request->id)->firstOrFail();
        $postData->fill($request->all());
        $postData->save();
        return response()->json($postData);


  }


  public function destroy(Request $request, $id)
  {

    if($request->id == 1 || $request->id == 2){
        return false;
    }

    if ($this->user->role !== 'admin') {
      return $this->responseUnauthorized();
    }

    $postData = Category::where('id', $id)->first();

    try {
      $postData->delete();
      return response()->json($postData);

    } catch (Exception $e) {
      return  $e;
    }
  }






}
