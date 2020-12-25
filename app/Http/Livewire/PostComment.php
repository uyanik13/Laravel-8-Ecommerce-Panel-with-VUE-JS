<?php

namespace App\Http\Livewire;


use Livewire\Request;
use App\Models\Comment;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;


class PostComment extends Component
{

    use WithPagination;

    public $post;
    public $user;
    public $content = '';
    public $clickedId = '';
    public $replyCommentArea = false;
    public $replyComment = false;


    public function __construct()
    {
        $this->user = Auth::user();
    }

    //protected $listeners = ['replyCommentArea' => 'replyCommentArea'];

    public function replyCommentAreaFunc($clickedId,$value)
    {

        $this->clickedId = $clickedId;
        $this->replyCommentArea = $value;

    }

    public function addComment()
    {


        $create_comment = Comment::create([
            'content' => $this->content,
            'post_id' => $this->post->id,
            'reply_to' => $this->clickedId ? $this->clickedId : null,
            'user_id' => $this->user->id,
        ]);

         $this->content = '';
         $this->clickedId ? $this->replyCommentArea = false : null;

          return session()->flash('message', trans('lang.your_comment_has_been_sent'));
    }




    public function mount($post)
        {
            $this->post = $post;
        }


    public function render()
    {

        return view('livewire.post-comment',[
            'comments' => Comment::where('post_id', $this->post->id)
            ->orderBy('created_at','desc')
            ->where('approved',1)
            ->where('reply_to',null)->get(),
            'commentsCount' => Comment::where('post_id', $this->post->id)->where('approved',1)->count(),
        ]);
    }
}
