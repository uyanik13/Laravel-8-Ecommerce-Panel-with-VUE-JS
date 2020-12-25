<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ {
    Post, Category
};

use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index(Request $request)
    {

        $categories = Category::all()->keyBy('id');

        $filterData['categories'] = $request->has('categories') ?
            $request->input('categories') : $categories->keys()->all();

        $filterData['order'] = $request->has('order') ?
            $request->input('order') : ['by' => 'created_at', 'type' => 'desc'];

        return view('blog', [
            'posts' => Post::getFilteredPosts($request->input())->paginate(10),
            'categories' => Category::all(),
            'filterData' => $filterData
        ]);
    }



    public function show(Post $post)
    {
        if (Auth::check()) {

            $user = Auth::user();
            $votes = $user->votes->keyBy('post_id');
            $votedBefore = $votes->has($post->id);

        } else {

            $user = null;
            $votedBefore = false;

        }

        return view('post', [
            'post' => $post,
            'voteStatus' => $votedBefore == true ? $votes->get($post->id)->status : false,
            'user' => $user,
            'postComments' => $post->comments()
                ->where('approved', 1)
                ->orderBy('created_at', 'desc')
                ->get()
        ]);
    }
}
