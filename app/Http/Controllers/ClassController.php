<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classes;

class ClassController extends Controller
{
    public function index()
    {
        $class = Classes::all();
        return response()->json([
                'class' => $class,
                'code' => 200,
                'message' => 'Successfully'
        ]);
    }

    public function select_id($classes)
    {
        $cls = Classes::where('idclass',$classes)->get();
        return response()->json([
            'class' => $cls,
            'code' => 200,
            'message' => 'Succesfull'
        ]);
    }

    // use authentication
    public function index_auth()
    {
        $class = Classes::all();
        return response()->json([
                'class' => $class,
                'code' => 200,
                'message' => 'Successfully'
        ]);
    }

    public function select_id_auth($classes)
    {
        $cls = Classes::where('idclass',$classes)->get();
        return response()->json([
            'class' => $cls,
            'code' => 200,
            'message' => 'Succesfull'
        ]);
    }

    public function classdetail($classes)
    {
        $classdetail = Classes::with([
                            'subclass' => function($sub){
                                $sub->with('materies');
                            }
                        ])
                        ->where('idclass',$class)
                        ->first();
        
        return response()->json([
            'classdetail' => $classdetail,
            'code' => 200,
            'message' => 'ok'
        ]);

    }
}
