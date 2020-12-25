<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DRO\SeoAnalyzer\Http\Controllers\DroSeoAnalyzerController;

class AnalyzeResultSender extends Component
{

       public $isSent = false;
       public $success = false;
       public $email = 'your@email.com';
        protected $listeners = ['sendDataToEmail'];

       public function __construct()
       {
        $this->controller = new DroSeoAnalyzerController();
        $this->website =  session()->get('website');;

       }

    public function sendDataToEmail ()
    {
        $this->controller->sendEmail($this->email,$this->website );
        $this->turnSuccess(true);
        session()->flash('message', trans('lang.your_analyze_successfully_has_been_sent'));

    }

    public function turnIsSent($boolean= false )
    {
        $this->isSent = $boolean;

    }

    public function turnSuccess($boolean= false )
    {
        $this->success = $boolean;

    }

    public function send()
    {
       $this->turnIsSent(true);
       $this->emit('sendDataToEmail');


    }

    public function render()
    {
        return view('livewire.analyze-result-sender',[
            'isSent' => $this->isSent
        ]);
    }
}
