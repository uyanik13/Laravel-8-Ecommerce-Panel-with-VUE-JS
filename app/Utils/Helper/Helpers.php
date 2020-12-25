<?php

use App\Models\Post;
use App\Models\Custom;
use App\Models\Comment;
use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Storage;

  if (! function_exists('checkGalleryImagesTurnToImageForPost')) {
        function checkGalleryImagesTurnToImageForPost($userId,$postId,$Images,$type)
        {
            if(is_array($Images)){
                $galleryImages = Gallery::where('post_id',$postId)->get();
                $data =   arrayDifference($Images,$galleryImages->toArray());
                          deleteGalleryArrayDataFromDB($data);
                foreach ($Images as $index => $image) {
                    $fileName = Str::slug($image['alt_text']);
                      if($image['alt_text'] !== null){
                          $gallery = Gallery::where('slug',$image['slug'])->first();
                          if($gallery){
                              $gallery->alt_text = $image['alt_text'];
                              $gallery->save();
                          }else{
                              $slug = PostImageHelper($fileName, $image['slug'], $type);
                              Gallery::firstOrCreate([
                                  'user_id' => $userId,
                                  'post_id' => $postId,
                                  'file_name' => $fileName,
                                  'alt_text' => $image['alt_text'],
                                  'slug' => $slug,
                                  'type' => $type,
                                ]);
                          }
                      }

                    }
                }
              return true;

        }
    }


    if (! function_exists('PostImageHelper')) {
        function PostImageHelper($url, $image, $path)
        {
            if (strlen($image) < 255) {
                return $image;
              }


              $extension = explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];   // .jpg .png .pdf
              $replace = substr($image, 0, strpos($image, ',') + 1);
              $imageConvert = str_replace($replace, '', $image);
              $imageConvert = str_replace(' ', '+', $imageConvert);

              $imageName = $url . '_' . time() . '.' . $extension;

              Storage::disk('public')->put('/images/' . $path . '/' . $imageName, base64_decode($imageConvert));


              $imageUrl =  '/images/' . $path . '/' . $imageName;



              return $imageUrl;

        }
    }



  if (! function_exists('arrayDifference')) {
        function arrayDifference(array $array1, array $array2, array $keysToCompare = null)
        {
            $serialize = function (&$item, $idx, $keysToCompare) {
                if (is_array($item) && $keysToCompare) {
                    $a = array();
                    foreach ($keysToCompare as $k) {
                        if (array_key_exists($k, $item)) {
                            $a[$k] = $item[$k];
                        }
                    }
                    $item = $a;
                }
                $item = serialize($item);
            };

            $deserialize = function (&$item) {
                $item = unserialize($item);
            };

            array_walk($array1, $serialize, $keysToCompare);
            array_walk($array2, $serialize, $keysToCompare);

            $deletions = array_diff($array1, $array2);
            $insertions = array_diff($array2, $array1);

            array_walk($insertions, $deserialize);
            array_walk($deletions, $deserialize);

            return array('insertions' => $insertions, 'deletions' => $deletions);
        }
    }

  if (! function_exists('deleteGalleryArrayDataFromDB')) {
        function deleteGalleryArrayDataFromDB($data)
        {
            foreach ($data['insertions'] as $key => $value) {
                $image = Gallery::where('id', $value['id'])->first();
                $image->delete();
            }

            return true;
        }
    }


  if (! function_exists('namedSettings')) {
        function namedSettings($settings)
        {
            $named_settings = [];
            foreach ($settings as $setting) {

            $named_settings[$setting->name] = $setting;
            }
            return $named_settings;
        }
    }


  if (! function_exists('findPost')) {
        function findProduct($id)
        {
            $product = Post::find($id);
            return $product;
        }
    }

  if (! function_exists('findPage')) {
        function findPage($slug)
        {
            $page = Post::where('slug','LIKE','%'.$slug.'%')->first();
            return $page;
        }
    }

  if (! function_exists('getPostComments')) {
        function getPostComments($id)
        {
             return Comment::where('post_id', $id)->get();
        }
    }

  if (! function_exists('getPosts')) {
        function getPosts($type)
        {
             return Post::where('type', $type)->active()->get();
        }
    }

  if (! function_exists('jsonToArray')) {
        function jsonToArray($data)
        {
            return json_decode($data, true);
        }
    }

  if (! function_exists('jsonToObject')) {
        function jsonToObject($data)
        {
            return   (object)json_decode($data, true);
        }
    }

  if (! function_exists('guestShoppingCartControl')) {
        function guestShoppingCartControl($sessionID,$id,$qty)
        {
            $qty = $qty === null ? 1 : $qty;
        $is_exist = ShoppingCart::where('session_id',$sessionID)
        ->where('post_id',$id)
        ->where('sold',false)->where('type','product')->first();
        if($is_exist){
            $is_exist->quantity = $is_exist->quantity + $qty;
            $is_exist->save();
            return cart($sessionID,'guest');
        }else {
            $data = new ShoppingCart();
            $data->session_id = $sessionID;
            $data->post_id = $id;
            $data->save();
            return  cart($sessionID,'guest');
      }

            return  cart($sessionID,'guest');
        }
    }


    if (! function_exists('userShoppingCartControl')) {
        function userShoppingCartControl($user,$id,$qty)
        {
            $qty = $qty === null ? 1 : $qty;

        $is_exist = ShoppingCart::where('user_id',$user->id)
        ->where('post_id',$id)
        ->where('sold',false)->where('type','product')->first();
        if($is_exist){
            $is_exist->quantity = $is_exist->quantity + $qty;
            $is_exist->save();
            return cart($user,'user');
        }else {
            $data = new ShoppingCart();
            $data->user_id = $user->id;
            $data->post_id = $id;
            $data->save();
            return cart($user,'user');
      }

      return cart($user,'user');
        }
    }



    if (! function_exists('cart')) {
        function cart($user,$type)
        {
            if($type === 'user'){
                $cart = ShoppingCart::where('user_id',$user->id)
                ->where('sold',false)
                ->where('type','product')
                ->get();
                return $cart;
            }else if ($type === 'guest'){
                $cart = ShoppingCart::whereNotNull('session_id')
                ->where('session_id',$user)
                ->where('sold',false)
                ->where('type','product')
                ->get();
                return $cart;

            }
            return null;
        }
    }

    if (! function_exists('cartTotal')) {
        function cartTotal($user,$type)
        {
            $totalAmount = 0;
            $price = 0;
            if($type === 'user'){
                $cart = ShoppingCart::where('user_id',$user->id)->where('sold',false)->where('type','product')->get();
                if($cart){
                    foreach ($cart as $key => $product) {
                        if(isset($product->post->discounted_price)){
                            $price = $product->post->discounted_price;
                        }else{
                            $price = $product->post->price;
                        }
                        $totalAmount += $price * $product['quantity'];
                    }
                }

            }else{
                $cart = ShoppingCart::where('session_id',$user)->where('sold',false)->where('type','product')->get();
                if($cart){
                    foreach ($cart as $key => $product) {
                        if(isset($product->post->discounted_price)){
                            $price = $product->post->discounted_price;
                        }else{
                            $price = $product->post->price;
                        }
                        $totalAmount += $price * $product['quantity'];
                    }
                }

            }

            return $totalAmount;
        }
    }





    if (! function_exists('deleteFromCart')) {
        function deleteFromCart($id,$user,$type)
        {
            if($type === 'user'){
                $data = ShoppingCart::where('user_id',$user->id)->where('post_id',$id)->first();
                $data->delete();
                return true;
            }else if ($type === 'guest'){
                $data = ShoppingCart::where('session_id',$user)->where('post_id',$id)->first();
                if($data) $data->delete();
                return true;

            }

            return false;
        }
    }


    if (! function_exists('toEmptyCart')) {
        function toEmptyCart()
        {
            $user = Auth::user();
            $cart = '';
            if($user){
                $cart = ShoppingCart::where('user_id',$user->id)->where('sold',false)->where('type','product')->get();
                foreach ($cart as $key => $item) {
                    $item->sold = true;
                    $item->save();
                }
            }else{
                $cart = session()->remove('cart');
            }

            return $cart;
        }
    }


    if (! function_exists('findCustomData')) {
        function findCustomData($type)
        {
            $dataUsingOnBlade = '';
            $data = Custom::where('type', $type)->first();

            if($data === null){
                return null;
            }else{
                $dataUsingOnBlade =  json_decode($data->JsonData, true);
                $dataUsingOnBlade = $dataUsingOnBlade[$type];
            }
            return $dataUsingOnBlade ;
        }
    }


    if (! function_exists('getCategoryPosts')) {
        function getCategoryPosts($id,$type='post')
        {
            return Post::where('type',$type)->where('category_id', $id)->get();
        }
    }

    if (! function_exists('getChildCategories')) {
        function getChildCategories($type='post')
        {
            $item = Category::where('slug','LIKE','%'.$type.'%')->first();
            $allChildCategories = Category::where('parent_id',$item->id)->get();
            return $allChildCategories;
        }
    }

    if (! function_exists('createTemporaryPage')) {
        function createTemporaryPage(Array $data)
        {
            $page = (object)[
                'title' => $data['title'],
                'slug' =>   $data['slug'],
                'seo_title' =>$data['seo_title'],
                'seo_description' => $data['seo_description'],
                'thumbnail' => 'https://via.placeholder.com/500.png',
            ];

            return $page;
        }
    }

    if (! function_exists('base64_image_resize')) {
        function base64_image_resize($fileName,$image)
        {
            $extension = explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];   // .jpg .png .pdf
            $replace = substr($image, 0, strpos($image, ',') + 1);
            $imageConvert = str_replace($replace, '', $image);
            $imageConvert = str_replace(' ', '+', $imageConvert);
            $destinationPath = public_path('/images/file-manager/'.auth()->user()->id);
            $img = Image::make(base64_decode($imageConvert));
            File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);
            $img->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$fileName);
            $image->move($destinationPath, $fileName);
            $slug = '/images/file-manager/'.auth()->user()->id.'/'.$fileName;
            return $slug;
        }
    }

    if (! function_exists('url_image_resize')) {
        function url_image_resize($fileName,$imageUrl,$x=1280,$y=null)
        {
            $destinationPath = public_path('/images/file-manager/'.auth()->user()->id);
            $image = (string) Image::make($imageUrl)->encode('data-url');
            $extension = explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $fileNameForSaving = $fileName.$x.$y.'.'.$extension;
            File::exists($destinationPath) or File::makeDirectory($destinationPath, 0777, true, true);
            $thumbImage = Image::make($image)->resize($x, $y, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$fileNameForSaving);
            $slug = '/images/file-manager/'.auth()->user()->id.'/'.$fileNameForSaving;
            return $slug;
        }
    }


     if (! function_exists('post_to_each_langauge')) {
     function post_to_each_langauge($post)
     {


        $postEN = (object)[
            'title'=>$post->toArray()['title']['en'],
            'slug'=>$post->toArray()['slug']['en'],
            'created_at'=>$post->created_at,
            'category'=>$post->category ? $post->category->toArray()['slug']['en'] : null,
            ];
        $postTR = (object)[
            'title'=>$post->toArray()['title']['tr'],
            'slug'=>$post->toArray()['slug']['tr'],
            'created_at'=>$post->created_at,
            'category'=>$post->category ? $post->category->toArray()['slug']['tr'] : null,
            ];

            $post = (object)[
                $postEN,
                $postTR,

            ];

             return $post;


     }
    }
