<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {

        if(check_privilege(7,1) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return redirect()->back()->with('error', 'You do not have permission. Please contact your administrator');
            die();
        }


        $db_ext = DB::connection('sqlsrv');

        $data =  $db_ext->select("select * from specialisation_master where Status = 'A'");

        $data1 =  $db_ext->table('department_sub')
            ->select('sub_code','sub_name')
        ->where('Status','A')
        ->whereIn('type',['CL','I','IS','M','OS','P','S'])
        ->whereRaw('LEN(Type) > 0')
        ->whereRaw('LEN(sub_code) > 0')->get();

//        dd($data1);


        DB::beginTransaction();

        try {

            foreach ($data as $row)
            {
// for lab department update


//                $info = Department::query()->where('company_id',Auth::user()->company_id)
//                    ->where('department_code',$row->sub_code)
//                    ->where('department_type','L')->first();
//
//                if(empty($info))
//                {
//                    Department::insert([
//                        'department_code' => $row->sub_code,
//                        'company_id'=>Auth::user()->company_id,
//                        'name'=>$row->sub_name,
//                        'department_type'=>'L',
//                        'description'=>$row->sub_name,
//                        'user_id'=>Auth::user()->id,
//                        'status'=>true
//                    ]);
//                }

// for doctor specialisation update

                $info = Department::query()->where('company_id',Auth::user()->company_id)
                    ->where('department_code',$row->Specialisation_code)
                    ->where('department_type','D')->first();

                if(empty($info))
                {
                    Department::insert([
                        'department_code' => $row->Specialisation_code,
                        'company_id'=>Auth::user()->company_id,
                        'name'=>$row->Specialisation_name,
                        'department_type'=>'D',
                        'description'=>$row->Specialisation_name,
                        'user_id'=>Auth::user()->id,
                        'status'=>true
                    ]);
                }

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
