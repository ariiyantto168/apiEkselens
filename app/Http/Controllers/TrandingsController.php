<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Populers;
use App\Models\Newclass;
use App\Models\Discounts;
use App\Models\Careers;
use App\Models\Testimonies;
use Image;
use File;

class TrandingsController extends Controller
{
    public function index_populers()
    {
        $pop = Populers::all();
        return response()->json([
            'classPopulers' => $pop,
            'code' => 200,
            'message' => 'Succesfull'
        ]);   
    }

    public function select_populers($populers)
    {   
        $pop = Populers::where('idpopulers',$populers)->get();
        return response()->json([
            'classPopulers' => $pop,
            'code' => 200,
            'message' => 'Succesfull'
        ]); 
    }

    public function index_newclass()
    {
        $ncls = Newclass::all();
        return response()->json([
            'newClass' => $ncls,
            'code' => 200,
            'message' => 'Succesfull'
        ]);       
    }

    public function select_newclass($newclass)
    {   
        $ncls = Newclass::where('idnewclass',$newclass)->get();
        return response()->json([
            'newClass' => $ncls,
            'code' => 200,
            'message' => 'Succesfull'
        ]);
    }

    public function index_careers()
    {
        $car = Careers::all();
        return response()->json([
            'careerReady' => $car,
            'code' => 200,
            'message' => 'Succesfull'
        ]);     
    }

    public function select_careers($careers)
    {   
        $car = Careers::where('idcareers',$careers)->get();
        return response()->json([
            'careerReady' => $car,
            'code' => 200,
            'message' => 'Succesfull'
        ]);
    }

    public function index_testimonies()
    {
        $test = Testimonies::all();
        return response()->json([
            'testimoniUsers' => $test,
            'code' => 200,
            'message' => 'Succesfull'
        ]);       
    }

    public function select_testimonies($testimonies)
    {
        $test = Testimonies::where('idtestimonies', $testimonies)->get();
        return response()->json([
            'testimoniUser' => $test,
            'code' => 200,
            'message' => 'Succesfull'
        ]);
    }

    public function index_discounts()
    {
        $dis = Discounts::all();
        return response()->json([
            'discounts' => $dis,
            'code' => 200,
            'message' => 'Succesfull'
        ]);    
    }

    public function select_discounts($discounts)
    {   
        $dis = Discounts::where('iddiscounts',$discounts)->get();
        return response()->json([
            'discounts' => $dis,
            'code' => 200,
            'message' => 'Succesfull'
        ]);    
        
    }
}
