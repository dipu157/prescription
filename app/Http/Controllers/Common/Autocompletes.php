<?php

namespace App\Http\Controllers\Common;

use App\Models\Diagnosis;
use App\Models\Generic;
use App\Models\Hresource;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Autocompletes extends Controller
{


    public $company_id;
    public $user_id;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $this->company_id = Auth::user()->company_id;
            $this->user_id = Auth::user()->id;

            return $next($request);
        });
    }

    public function autocompleteMedicine(Request $request)
    {
        $term = $request['query'];

        $items = Medicine::select('id','name','strength_id','medicine_type_id')
            ->where('company_id',$this->company_id)
            ->where('name', 'LIKE', '%'.$term.'%')
            ->with('strength')->with('mtype')->with('template_data')
            ->get();


//        $generics = Generic::select('id','name')
//            ->where('company_id',$this->company_id)
//            ->where('name', 'LIKE', '%'.$term.'%')
//            ->get();

//        $generics->map(function ($generic) {
//            $generic['strength_id'] = '320';
//            $generic['medicine_type_id'] = '1';
//            return $generic;
//        });


//        $final = $items->merge($generics);

        return response()->json($items);
    }


    public function autocompleteDiagnosis(Request $request)
    {
        $term = $request['query'];

        $items = Diagnosis::select('id','name')
            ->where('company_id',$this->company_id)
            ->where('name', 'LIKE', '%'.$term.'%')
            ->get();

        return response()->json($items);
    }

    public function autocompleteGenerics(Request $request)
    {
        $term = $request['query'];

        $items = Generic::select('id','name')
            ->where('company_id',$this->company_id)
            ->where('name', 'LIKE', '%'.$term.'%')
            ->get();

        return response()->json($items);
    }


    public function templateItems($id, Request $request)
    {
        $term = $request['query'];

        if($id == 'M')
        {
            $items = Medicine::select('id','name','strength_id','medicine_type_id')
                ->where('company_id',$this->company_id)
                ->where('name', 'LIKE', '%'.$term.'%')
                ->with('strength')->with('mtype')->with('template_data')
                ->get();


            $generics = Generic::select('id','name')
                ->where('company_id',$this->company_id)
                ->where('name', 'LIKE', '%'.$term.'%')
                ->get();

            $generics->map(function ($generic) {
                $generic['strength_id'] = '320';
                $generic['medicine_type_id'] = '1';
                return $generic;
            });


            $final = $items->merge($generics);
        }

        if($id == 'I')
        {
            $final = Diagnosis::select('id','name')
                ->where('company_id',$this->company_id)
                ->where('name', 'LIKE', '%'.$term.'%')
                ->get();
        }

        return response()->json($final);
    }

    public function doctors(Request $request)
    {
        $term = $request['query'];

        $items = Hresource::select('id','name')
            ->where('company_id',$this->company_id)
            ->where('status',true)
            ->where('name', 'LIKE', '%'.$term.'%')
            ->orderBy('name')
            ->get();

        return response()->json($items);
    }
}
