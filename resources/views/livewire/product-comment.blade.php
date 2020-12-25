


  <div class="col-lg-12">
    @if (session()->has('message'))
            <div class="bg-indigo-900 text-center py-4 lg:px-4 my-5 rounded">
                <div class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                <span class="flex rounded-full bg-indigo-500 uppercase px-2 py-1 text-xs font-bold mr-3">{{__('lang.success')}}</span>
                <span class="font-semibold mr-2 text-left flex-auto">{{ session('message') }}</span>
                <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
                </div>
            </div>
            @endif

   @if (count($comments)>0)
        <div class="comments">
        <div class="blog-heading">

        </div>
        <ul>
        @foreach($comments as $comment)

        <li>
        <div class="comment-thumb">
            {{-- <img src="{{$comment->user->avatar}}" alt="{{$comment->user->name}} "> --}}
        </div>
        <div class="right-content">

            @if ($user)
            <div class="reply-button"><a wire:click="replyCommentAreaFunc({{$comment->id}},{{true}})"> <i class="fa fa-reply"></i></a></div>
            @endif
        <h4>{{$comment->user->name}} <span>{{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</span></h4>
            <p>{{$comment->content}}</p>
        </div>
        </li>
        @if ( $comment->replies )
        @foreach($comment->replies as $repliedMessage)
        <li style="margin-left:120px !important">
            <div class="comment-thumb">
                {{-- <img src="{{$repliedMessage->user->avatar}}" alt="{{$repliedMessage->user->name}} "> --}}
            </div>
            <div class="right-content">

                @if ($user)
                <div class="reply-button"><a wire:click="replyCommentAreaFunc({{$repliedMessage->id}},{{true}})"> <i class="fa fa-reply"></i></a></div>
                @endif
            <h4>{{$repliedMessage->user->name}} <span>{{\Carbon\Carbon::parse($repliedMessage->created_at)->diffForHumans()}}</span></h4>
                <p>{{$repliedMessage->content}}</p>
            </div>
            </li>
            @if ($replyCommentArea && $repliedMessage->id == $clickedId )
        <div class="col-lg-12 mb-5">
            <div class="leave-comment">
            <div class="row">
                <div class="col-lg-12">
                  <textarea  wire:model.debounce.500ms="content" rows="6" class="form-control"  placeholder="{{__('lang.message')}}"></textarea>
                </div>
                <div class="col-lg-12">
                  <button type="submit" wire:click="addComment" class="filled-button">{{__('lang.submit_comment')}}</button>

                </div>
              </div>
            </div>
        </div>
        @endif
        @endforeach
        @endif


        @if ($replyCommentArea && $comment->id == $clickedId )
        <div class="col-lg-12 mb-5">
            <div class="leave-comment">
            <div class="row">
                <div class="col-lg-12">
                  <textarea  wire:model.debounce.500ms="content" rows="6" class="form-control"  placeholder="{{__('lang.message')}}"></textarea>
                </div>
                <div class="col-lg-12">
                  <button type="submit" wire:click="addComment" class="filled-button">{{__('lang.submit_comment')}}</button>

                </div>
              </div>
            </div>
        </div>
        @endif
        @endforeach
     </ul>

    </div>
   @endif


<div class="col-lg-12">
    <div class="leave-comment">
    <div class="blog-heading">
        <h4>{{__('lang.submit_your_comment')}}</h4>
    </div>
   @if ($user)
    <div class="row">
        <div class="col-lg-12">
          <textarea  wire:model.debounce.500ms="content" rows="6" class="form-control"  placeholder="{{__('lang.message')}}"></textarea>
        </div>
        <div class="col-lg-12" id="writeComment">
          <button type="submit" wire:click="addComment" class="filled-button">{{__('lang.submit_comment')}}</button>

        </div>
      </div>
   @else
   <h5>{{__('lang.please_login_for_comment')}}</h5>
   <a href="/panel/login" class="btn btn-danger"> {{__('lang.login')}}</a>
   @endif
    </div>
</div>
</div>
