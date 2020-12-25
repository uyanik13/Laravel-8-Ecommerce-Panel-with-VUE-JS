<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;


class LocaleFileController extends ApiController
{
    public $lang = '';
    public $file= 'lang';
    public $key;
    public $value;
    public $path;
    public $arrayLang = array();

//------------------------------------------------------------------------------
// Add or modify lang files content
//------------------------------------------------------------------------------

    public function changeLang(Request $request)
    {

        $this->lang = '';
        $this->file = 'shop';
        $this->key = 'productGroup';
        $this->value = 'whatever';
        $this->changeLangFileContent();
        //$this->deleteLangFileContent();

        return $this->read();
    }

//------------------------------------------------------------------------------
// Add or modify lang files content
//------------------------------------------------------------------------------

    public function changeLangFileContent(Request $request)
    {
        $arrayLang = $this->read($request);
        $arrayLang[$this->key] = $this->value;
        $this->frontSideRead($request);
    }

//------------------------------------------------------------------------------
// Delete from lang files
//------------------------------------------------------------------------------

    public function deleteKey(Request $request)
    {   $key= $request->key ? $request->key : 'test';
        $this->frontSideRead($request);
        unset($this->arrayLang[$key]);
        $this->frontSideRead($request);
    }

//------------------------------------------------------------------------------
// Read lang file content
//------------------------------------------------------------------------------

    public function frontSideRead(Request $request)
    {

            $this->lang = $request->language ? $request->language : App::getLocale();
            app()->setLocale($this->lang);
            $this->file = $request->file ? $request->file : 'lang';
            $this->path = base_path().'/resources/lang/'.$this->lang.'/'.$this->file.'.php';
            $this->arrayLang  = Lang::get($this->file);

            if (gettype($this->arrayLang) == 'string') $this->arrayLang = array();




        return $this->arrayLang;

    }

//------------------------------------------------------------------------------
// Save lang file content
//------------------------------------------------------------------------------

    public function frontSideWrite(Request $request)
    {
        $content = "<?php\n\nreturn\n[\n";
        $lang = $request->language ? $request->language : 'en';
        $file = $request->file ? $request->file : 'lang';
        $data = $request->data;

          if ($lang == '') $lang  = App::getLocale();

          $this->path = base_path().'/resources/lang/'.$lang.'/'.$file.'.php';

        foreach ($data as $this->key => $this->value)
        {
            $this->key = str_replace("'", "\'", $this->key );
            $this->value = str_replace("'", "\'", $this->value);
            $content .= "\t'".$this->key."' => '".$this->value."',\n";
        }

        $content .= "];";

        file_put_contents($this->path, $content);
    }




    public function backSideRead(Request $request)
    {

            $this->lang = $request->language ? $request->language : App::getLocale();
            app()->setLocale($this->lang);
            $this->file = $request->file ? $request->file : 'lang';
            $this->path = base_path().'/resources/js/src/i18n/'.$this->lang.'.json';
            $this->arrayLang  = file_get_contents($this->path);
             return $this->arrayLang;

    }

//------------------------------------------------------------------------------
// Save lang file content
//------------------------------------------------------------------------------

    public function backSideWrite(Request $request)
    {
        $content = "{";
        $this->lang = $request->language ? $request->language : 'en';
        $data = $request->data;
        $this->path = base_path().'/resources/js/src/i18n/'.$this->lang.'.json';

        foreach ($data as $this->key => $this->value)
        {
            $this->key = str_replace("'", "\'", $this->key );
            $this->value = str_replace("'", "\'", $this->value);
            $content .= '"'.$this->key.'":' .'"'.$this->value.'",';
        }
        $content = substr($content,0,-1);
        $content .= "}";


        file_put_contents($this->path, $content);
    }


}
