<?php

namespace App\Http\Controllers\Api;


use http\Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\{Gallery, Post};


class ApiPostController extends ApiController
{



    public function __construct(Request $request)
    {
        $this->user = auth()->setRequest($request)->user();
        $this->product  = new Product();
        $this->post  = new Article();
        $request->request->set('user_id', $this->user->id);

    }



  public function index(Request $request)
  {


    if (!$this->user) {
      return $this->responseUnauthorized();
    }

    $pages = Post::where('type','page')
    ->orderBy('created_at', 'desc')
    ->get();

    $posts = Post::where('type','post')
    ->orderBy('created_at', 'desc')
    ->get();

    $products = Post::where('type','product')
    ->orderBy('created_at', 'desc')
    ->get();

    $services = Post::where('type','service')
    ->orderBy('created_at', 'desc')
    ->get();

    $portfolios = Post::where('type','portfolio')
    ->orderBy('created_at', 'desc')
    ->get();


    return [
      'pages' => $pages,
      'posts' => $posts,
      'services' => $services,
      'portfolios' => $portfolios,
      'products' => $products,
    ];
  }

  public function store(Request $request)
  {

    if (!$this->user) {
      return $this->responseUnauthorized();
    }



        switch ($request->type) {
            case 'product':
                $this->createdPost = $this->product->create($request,$this->user);
                break;
            default:
                $this->createdPost = $this->post->create($request,$this->user);
                break;
        }

      return response()->json($this->createdPost);


  }

  public function update(Request $request, $id)
  {

    if (!$this->user) {
      return $this->responseUnauthorized();
    }

    switch ($request->type) {
        case 'product':
            $this->createdPost = $this->product->update($request, $id,$this->user);
            break;
        default:
            $this->createdPost = $this->post->update($request, $id,$this->user);
            break;
    }

    return response()->json($this->createdPost);

  }



  public function destroy(Request $request, $id)
  {
    if (!$this->user) {
      return $this->responseUnauthorized();
    }

    switch ($request->type) {
        case 'product':
            $this->createdPost = $this->product->delete($request, $id,$this->user);
            break;
        default:
            $this->createdPost = $this->post->delete($request, $id,$this->user);
            break;
    }

    return response()->json($this->createdPost);

  }

  public function copyPost(Request $request, $id)
  {
    if (!$this->user) {
      return $this->responseUnauthorized();
    }
    $postData = Post::find($id);

      if ($this->user->role === 'admin') {
          try {
              $new = $postData->replicate();
              $new->save();
              return response()->json($new);

          } catch (Exception $e) {
              return $this->responseServerError('Error deleting resource.');
          }
      }else{
          return $this->responseUnauthorized();
      }


  }




}


interface PostService {
    public function create(Request $request,User $user);
    public function update(Request $request, $id , User $user);
    public function show(Request $request, $id ,User $user);
    public function delete(Request $request, $id,User $user);
}


class Product implements  PostService{


    public function create(Request $request,User $user)
    {

        $allData = $request->all();
        $createdPost = Post::create($request->except(['images']));
        if(isset($allData['images'])) $allData = checkGalleryImagesTurnToImageForPost($user->id,$createdPost->id, $allData['images'],'product');
        return $createdPost;
    }

    public function update(Request $request, $id,User $user)
    {

        $postData = Post::where('id', $id)->firstOrFail();
        if ($user->id === $postData->user_id) {
            $allData = $request->all();
            $postData->fill($request->except(['images']));
            $request->has('images') ? checkGalleryImagesTurnToImageForPost($user->id,$id, $allData['images'],'product') :  $allData ;
            $postData->save();
            return response()->json($postData);
        }else{
            return response()->json([
                'status' => 401,
                'errors' => 'Un Authorized',
            ], 401);
        }
    }

    public function show(Request $request, $id,User $user)
    {

    }

    public function delete(Request $request, $id,User $user)
    {
        $postData = Post::where('id', $id)->firstOrFail();

        if ($user->id === $postData->user_id) {
            try {
                $postData->delete();
                return response()->json($postData);

            } catch (Exception $e) {
                return response()->json([
                    'status' => 500,
                    'errors' => $e,
                ], 500);
            }
        }else{
            return response()->json([
                'status' => 401,
                'errors' => 'Un Authorized',
            ], 401);
        }
    }

}

class Article implements  PostService{


    public function create(Request $request,User $user)
    {

        $createdPost = Post::create($request->except(['images']));
        //$this->createThumbnails($createdPost);
        return $createdPost;
    }

    public function update(Request $request, $id,User $user)
    {
        $postData = Post::where('id', $id)->firstOrFail();
        if ($user->id === $postData->user_id) {
            $postData->fill($request->except(['images']));
            $postData->save();
            return response()->json($postData);
        }else{
            return response()->json([
                'status' => 401,
                'errors' => 'Un Authorized',
            ], 401);
        }
    }

    public function show(Request $request, $id,User $user)
    {

    }


    public function delete(Request $request, $id,User $user)
    {
        $postData = Post::where('id', $id)->firstOrFail();

        if ($user->id === $postData->user_id) {
            try {
                $postData->delete();
                return response()->json($postData);

            } catch (Exception $e) {
                return response()->json([
                    'status' => 500,
                    'errors' => $e,
                ], 500);
            }
        }else{
            return response()->json([
                'status' => 401,
                'errors' => 'Un Authorized',
            ], 401);
        }
    }

    public function createThumbnails(Post $post)
    {

        $slug = url_image_resize($post->title, $post->thumbnail ,80);
       return $this->thumbnailSaveToGallery($post,$slug);
    }

    public function thumbnailSaveToGallery(Post $post,String $slug)
    {
       Gallery::firstOrCreate([
            'user_id' => $post->user_id,
            'post_id' => $post->id,
            'file_name' => $post->title,
            'slug' => $slug
          ]);

          return true;

    }

}
