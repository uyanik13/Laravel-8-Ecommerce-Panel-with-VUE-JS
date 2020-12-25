<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\ {
    Post, Vote
};

class VoteController extends Controller
{
    public function vote(Post $post)
    {
        $user = Auth::user();
        $vote = Vote::firstOrCreate(
            [
                'user_id' => $user->id,
                'post_id' => $post->id
            ],
            [
                'user_id' => $user->id,
                'post_id' => $post->id,
                'status' => 0
            ]
        );
        
        return $this->toggleVote($post, $vote);
    }

    private function toggleVote(Post $post, Vote $vote)
    {
        if ($vote->allowed_to_vote_from > now()) {
            
            session()->flash(
                'voteResult', [
                    'message' => 'You cannot vote right now, please try again after: ' . '<b>' . substr($vote->allowed_to_vote_from, 0, 16) . '</b>',
                    'success' => false
                ],
            );

            return back();

        }

        $nextVoteDate = now()->addDays(7);

        if ($vote->status == false) {

            $post->votes++;
            $post->save();

            $vote->status = true;

            session()->flash(
                'voteResult', [
                    'message' => 'Vote added successfully, You will be allowed to vote next time from: ' . '<b>' . substr($nextVoteDate, 0, 16) . '</b>',
                    'success' => true
                ],
            );

        } else {

            $post->votes--;
            $post->save();

            session()->flash(
                'voteResult', [
                    'message' => 'Vote removed successfully, You will be allowed to vote next time from: ' . '<b>' . substr($nextVoteDate, 0, 16) . '</b>',
                    'success' => true
                ],
            );

            $vote->status = false;

        }

        $vote->allowed_to_vote_from = $nextVoteDate;
        $vote->save();

        return back();
    }

    
}
