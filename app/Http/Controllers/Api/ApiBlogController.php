<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;

use App\Models\ {
    Post, Category
};

use Illuminate\Support\Facades\Auth;

class ApiBlogController extends ApiController
{


  public function index(Request $request)
  {
    $categories = Category::all()->keyBy('id');

    $filterData['categories'] = $request->has('categories') ?
      $request->input('categories') : $categories->keys()->all();

    $filterData['order'] = $request->has('order') ?
      $request->input('order') : ['by' => 'created_at', 'type' => 'desc'];

    $collection = [
      'posts' => Post::getFilteredPosts($request->input())->paginate(10),
      'categories' => Category::all(),
      'filterData' => $filterData
    ];
    return $collection;
  }

  public function store(Request $request)
  {
    //===========================================
    // ========== GET USER FROM TOKEN ===========
    //===========================================
    $user = auth()->setRequest($request)->user();
    // Get user from $request token.
    if (!$user->role == 'admin') {
      return $this->responseUnauthorized();
    }

    $store = UserSetting::where('user_id',$user->id)->firstOrFail();
    //===========================================
    // ============ VALIDATION RULES ============
    //===========================================
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'phone' => 'required|unique:users| min:10',
      'user_total_debt' => 'required|integer',
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

    public function show(Post $post,Request $request)
    {
      $user = auth()->setRequest($request)->user();
        if ($user) {

            $user = Auth::user();
            $votes = $user->votes->keyBy('post_id');
            $votedBefore = $votes->has($post->id);

        } else {

            $user = null;
            $votedBefore = false;

        }

      $collection = [
        'post' => $post,
        'voteStatus' => $votedBefore == true ? $votes->get($post->id)->status : false,
        'user' => $user,
        'postComments' => $post->comments()
          ->where('approved', 1)
          ->orderBy('created_at', 'desc')
          ->get()
      ];
      return $collection;

    }


}
