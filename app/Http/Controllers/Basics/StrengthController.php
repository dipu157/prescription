<?php

namespace App\Http\Controllers\Basics;

use App\Models\Strength;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StrengthController extends Controller
{
    public function index(Request $request)
    {
        if(check_privilege(15,1) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return redirect()->back()->with('error', 'You do not have permission. Please contact your administrator');
        }

        $db_ext = DB::connection('sqlsrv');

        $data =  $db_ext->select('select * from Strengthmaster;');

        DB::beginTransaction();

        try {

            foreach ($data as $row)
            {

                Strength::firstOrCreate(['id' => $row->ID],
                    ['company_id'=> 1,
                        'name'=>$row->Strength,
                        'user_id'=>Auth::user()->id,
                        'status'=>true
                    ]);

            }

        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
//            $request->session()->flash('alert-danger', $error.'Not Saved');
            return redirect()->back()->with('error','Not Saved '.$error);
        }

        DB::commit();

        return redirect()->route('home')->with('success','Complete');

    }
}
