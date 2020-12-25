<?php

namespace App\Http\Livewire;

use Livewire\Component;
use DRO\SeoAnalyzer\Seo;
use DRO\SeoAnalyzer\Http\Controllers\DroSeoAnalyzerController;


class HomePageSeoAnalysis extends Component
{

    public $website ='https://www.dijitalreklam.org';
    public $email = '';
    public $isAnalyzing = false;
    public $openModal = false;
    public $analyzations;
    public $seoInfo;

    protected $listeners = ['fetchData','modalBoolean'];

    protected $rules = [
        'email' => 'required|email',
        'website' => 'required|url',
    ];

     public function __construct()
     {

        $this->controller = new DroSeoAnalyzerController();
        $this->analyzations = $this->controller->getAllAnalyzations(5)->toArray();
     }

    public function fetchData()
    {

        //$this->seoInfo = $seo->analyze($this->website);


        $seo = new Seo();
        $this->seoInfo = $seo->analyze($this->website);

        session()->put('website', $this->seoInfo);


        $this->controller->searchResults($this->seoInfo,$this->email);

        $this->controller->sendEmail($this->email,$this->seoInfo);

        $this->analyzeBoolean(false);

       return redirect()->route('page.webSiteSeoAnalysis');
      // return redirect('/analyze/'.$this->seoInfo['analyze_id']);
    }

    public function analyzeBoolean($boolean = false)
    {

        return $this->isAnalyzing = $boolean;
    }

    public function setWebsite($website)
    {
        return $this->website = $website;
    }

    public function showAlert()
    {
        $this->alert('success', trans('lang.analying_your_website_please_be_patient'), [
            'position' => 'center',
            'timer' => 15000,
            'toast' => false,
            'text' => '...',
            'showCancelButton' => false,
            'showConfirmButton' => false
        ]);



    }


    public function analyze()
    {
        $this->validate();
        $this->showAlert();
        $this->analyzeBoolean(true);
        $this->emit('fetchData');

    }

    public function render()
    {
        return view('livewire.home-page-seo-analysis',[
             'analyzations' => $this->controller->getAllAnalyzations(5)->toArray(),
             'website' => $this->website,
        ]);
    }
}
