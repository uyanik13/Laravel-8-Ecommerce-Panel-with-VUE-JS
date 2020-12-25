<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Khsing\World\World;
use Khsing\World\Models\Continent;
use Khsing\World\Models\Country;

use Illuminate\Support\Facades\Auth;

class GeoController extends Controller
{
    public function index(Request $request)
    {


        return World::Countries();

    }



    public function show(Request $request,$code)
    {
        $country = Country::getByCode($code);
        $provinces = $country->children();
       

        return $provinces;
    }


}
