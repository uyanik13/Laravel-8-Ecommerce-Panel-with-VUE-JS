<?php

namespace App\Http\Controllers\Api;

use http\Exception;
use App\Models\Gallery;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\ApiController;


class ApiGalleryController extends ApiController
{

    public function __construct(Request $request)
    {
      $this->user = auth()->setRequest($request)->user();


    }

  public function index()
  {
    $settings = Gallery::where('user_id',$this->user->id)
    ->where('user_id',$this->user->id)
    ->orderBy('created_at', 'desc')->paginate(24);
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
    if (!$user) {
      return $this->responseUnauthorized();
    }



    if (is_array($request->all())) {
      foreach ($request->file('files') as  $image) {

        $type = $image->extension();
        $FileName = explode('.',$image->getClientOriginalName())[0];
        $fileNameForSaving = time().'-'.Str::slug($FileName).'.'.$type;
        $destinationPath = public_path('/images/file-manager/'.$user->id);

        $img = Image::make($image->getRealPath());
        File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);
        $img->resize(800, 800, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$fileNameForSaving);

        $image->move($destinationPath, $fileNameForSaving);

        $slug = '/images/file-manager/'.$user->id.'/'.$fileNameForSaving;

        $Gallery = Gallery::firstOrCreate([
          'user_id' => $user->id,
          'file_name' => $fileNameForSaving,
          'slug' => $slug,
          'type' => $type,
        ]);
        $Gallery->save();
      }

      return response()->json($slug);

    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Gallery $gallery
   * @return \Illuminate\Http\Response
   */
  public function show(Gallery $gallery)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Gallery $gallery
   * @return \Illuminate\Http\Response
   */
  public function edit(Gallery $gallery)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Gallery $gallery
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Gallery $gallery)
  {
    $gallery = Gallery::where('id', $request->id)->firstOrFail();

    try {
        $gallery->alt_text = $gallery->alt_text === request('alt_text') ? $gallery->alt_text : request('alt_text');
        $gallery->save();

        return response()->json($gallery);

    } catch (\Exception $e) {
      return $this->responseServerError($e);
    }

  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Gallery $gallery
   * @return \Illuminate\Http\JsonResponse
   */
  public function destroy(Request $request, $id)
  {
    $user = auth()->setRequest($request)->user();
    // Get user from $request token.
    if (!$user->role === 'admin') {
      return $this->responseUnauthorized();
    }
    $gallery = Gallery::where('id', $id)->firstOrFail();

    try {

      if(file_exists(public_path($gallery->slug))){
        unlink(public_path($gallery->slug));
        $gallery->delete();
      }else{
        $gallery->delete();
        return $this->responseResourceDeleted();

      }
      return $this->responseResourceDeleted();
    } catch (Exception $e) {
      return $this->responseServerError('Error deleting resource.');
    }
  }



public function mediaSearch (Request $request,$search_text) {


    if ($search_text === NULL || $search_text === 'show-all-media') {
      $searchData= Gallery::where('user_id',$this->user->id)
      ->where('user_id',$this->user->id)
      ->orderBy('created_at', 'desc')->paginate(24);
  } else {
      $searchData =Gallery::where('user_id',$this->user->id)
      ->where('file_name','LIKE','%'.$search_text.'%')
      ->orWhere('alt_text','LIKE','%'.$search_text.'%')
      ->where('user_id',$this->user->id)
      ->orderBy('created_at', 'desc')->paginate(24);
  }


  return  response()->json($searchData);
}


public function textEdiorFileUpload(Request $request)
{

  $user = auth()->setRequest($request)->user();
  if (!$user) {
    return $this->responseUnauthorized();
  }


  if (is_array($request->all())) {
    foreach ($request->all() as  $image) {
      $type = $image->extension();
      $FileName = explode('.',$image->getClientOriginalName())[0];
      $fileNameForSaving = time().'-'.Str::slug($FileName).'.'.$type;
      $destinationPath = public_path('/images/file-manager/'.$user->id);

      $img = Image::make($image->getRealPath());
      File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);
      $img->resize(800, 800, function ($constraint) {
          $constraint->aspectRatio();
      })->save($destinationPath.'/'.$fileNameForSaving);

      $image->move($destinationPath, $fileNameForSaving);

      $slug = '/images/file-manager/'.$user->id.'/'.$fileNameForSaving;

      $Gallery = Gallery::firstOrCreate([
        'user_id' => $user->id,
        'file_name' => $fileNameForSaving,
        'slug' => $slug,
        'type' => $type,
      ]);
      $Gallery->save();
      return ['link' => $slug];
    }



  }
}

}
