


<div id="comments" class="comments-area">
    <h2 class="comments-title"> {{__('lang.comment(s)')}} ()</h2>
    @if (session()->has('message'))
    <div class="bg-indigo-900 text-center py-4 lg:px-4 my-5 rounded">
        <div class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
          <span class="flex rounded-full bg-indigo-500 uppercase px-2 py-1 text-xs font-bold mr-3">{{__('lang.success')}}</span>
          <span class="font-semibold mr-2 text-left flex-auto">{{ session('message') }}</span>
          <svg class="fill-current opacity-75 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.95 10.707l.707-.707L8 4.343 6.586 5.757 10.828 10l-4.242 4.243L8 15.657l4.95-4.95z"/></svg>
        </div>
      </div>
     @endif


    <ol class="comment-list">

        @foreach($comments as $comment)
            <li id="comment-16" class="comment-item">
                <article class="comment-wrap clearfix">
                    <div class="gravatar">
                        <img src="{{$comment->user->avatar}}" alt="{{$comment->user->name}}" class="">
                    </div>
                    <div class="comment-content">
                        <div class="comment-meta">
                            <h6 class="comment-author">{{$comment->user->name}}</h6>
                            <span class="comment-time">{{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</span>
                        <a rel="nofollow" class="comment-reply-link" wire:click="replyCommentAreaFunc({{$comment->id}},{{true}})" >{{__('lang.reply')}}</a>
                        </div>
                        <div class="comment-text">
                            <p>{{$comment->content}}</p>
                        </div>
                    </div>
                </article>
            </li>
                    @if ( $comment->replies )
                    @foreach($comment->replies as $repliedMessage)
                        <ul class="children">
                            <li id="comment-17" class="comment-item">
                                <article class="comment-wrap clearfix">
                                    <div class="gravatar">
                                        <img src="{{$repliedMessage->user->avatar}}" alt="{{$repliedMessage->user->name}}" class="">
                                    </div>
                                    <div class="comment-content">
                                        <div class="comment-meta">
                                            <h6 class="comment-author">{{$repliedMessage->user->name}}</h6>
                                            <span class="comment-time">{{\Carbon\Carbon::parse($repliedMessage->created_at)->diffForHumans()}}</span>
                                            <a rel="nofollow" class="comment-reply-link" wire:click="replyCommentAreaFunc({{$repliedMessage->id}},{{true}})" >{{__('lang.reply')}}</a>
                                        </div>
                                        <div class="comment-text">
                                            <p>{{$repliedMessage->content}}</p>
                                        </div>
                                    </div>
                                </article>
                                @if ($replyCommentArea && $repliedMessage->id == $clickedId )
                                <div id="respond" class="comment-respond">
                                    <h3 id="reply-title" class="comment-reply-title">{{__('lang.submit_your_comment')}}</h3>
                                    @if ($user)
                                    <form id="commentform" wire:submit.prevent="addComment" class="comment-form">
                                        <p class="comment-form-comment">
                                            <textarea id="comment" class="p-5" wire:model.debounce.500ms="content"  cols="45" rows="4" placeholder="{{__('lang.comment')}}*" required=""></textarea>
                                        </p>
                                        <p class="form-submit">
                                            <input name="submit" wire:click="addComment" type="submit" id="submit" class="octf-btn octf-btn-secondary" value="{{__('lang.submit')}}">
                                        </p>
                                    </form>
                                    @else
                                    <h5>{{__('lang.please_login_for_comment')}}</h5>
                                    <a href="/panel/login" class="btn btn-danger"> {{__('lang.login')}}</a>
                                    @endif
                                </div>
                                @endif
                            </li>
                        </ul>
                    @endforeach
                    @endif
        @endforeach

        @if ($replyCommentArea && $comment->id == $clickedId )
        <div id="respond" class="comment-respond">
            <h3 id="reply-title" class="comment-reply-title">{{__('lang.submit_your_comment')}}</h3>
            @if ($user)
            <form id="commentform" wire:submit.prevent="addComment" class="comment-form">
                <p class="comment-form-comment">
                    <textarea id="comment" class="p-5" wire:model.debounce.500ms="content"  cols="45" rows="4" placeholder="{{__('lang.comment')}}*" required=""></textarea>
                </p>
                <p class="form-submit">
                    <input name="submit" wire:click="addComment" type="submit" id="submit" class="octf-btn octf-btn-secondary" value="{{__('lang.submit')}}">
                </p>
            </form>
            @else
            <h5>{{__('lang.please_login_for_comment')}}</h5>
            <a href="/panel/login" class="btn btn-danger"> {{__('lang.login')}}</a>
            @endif
        </div>
        @endif

    </ol>

    <div id="respond" class="comment-respond">
        <h3 id="reply-title" class="comment-reply-title">{{__('lang.submit_your_comment')}}</h3>
        @if ($user)
        <form id="commentform" wire:submit.prevent="addComment" class="comment-form">
            <p class="comment-form-comment">
                <textarea id="comment" class="p-5" wire:model.debounce.500ms="content"  cols="45" rows="4" placeholder="{{__('lang.comment')}}*" required=""></textarea>
            </p>
            <p class="form-submit">
                <input name="submit" wire:click="addComment" type="submit" id="submit" class="octf-btn octf-btn-secondary" value="{{__('lang.submit')}}">
            </p>
        </form>
        @else
        <h5>{{__('lang.please_login_for_comment')}}</h5>
        <a href="/panel/login" class="btn btn-danger"> {{__('lang.login')}}</a>
        @endif
    </div>

</div>
