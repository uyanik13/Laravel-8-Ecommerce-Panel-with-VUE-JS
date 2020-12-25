<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostSearch extends Component
{

    public $search = null;
    public $isEmpty = false;


    public function getSearchPosts($search){
        if( $search === null || $search == "") {
            $this->results = null;
            $this->isEmpty = false;
            return false;
        };

        $results =  Post::where('title','LIKE','%'.$search.'%')
                        ->where('type','post')
                        ->orWhere('content','LIKE','%'.$search.'%')
                        ->where('type','post')
                        ->orWhere('options','LIKE','%'.$search.'%')
                        ->where('type','post')->limit(5)->get();
      count($results) > 0 ? $this->isEmpty = false : $this->isEmpty = true;
                      return  $results;
    }


    public function render()
    {

        return view('livewire.post-search',[
            'results' =>  $this->getSearchPosts($this->search)
        ]);



    }
}


