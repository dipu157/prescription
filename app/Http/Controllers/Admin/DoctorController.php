<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use App\Models\Hresource;
use App\Models\Title;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    public function index()
    {

        if(check_privilege(9,1) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return redirect()->back()->with('error', 'You do not have permission. Please contact your administrator');
        }


        $db_ext = DB::connection('sqlsrv');

        $data =  $db_ext->select("select doc.Doctor_code, doc.title_id, tl.sex, tl.title,
                                doc.doctor_name, ISNULL(doc.specialisation,1) specialisation, doc.qualification
                            from doctor_main doc
                            left join title_master tl on doc.title_id = tl.title_id
                            where doc.Status = 'A' and Doctor_code <>1;");

        DB::beginTransaction();

        try {

            foreach ($data as $row)
            {

                $department = Department::query()->where('department_code',$row->specialisation)->first();

                Hresource::firstOrCreate(['external_id' => $row->Doctor_code],
                    ['company_id'=>Auth::user()->company_id,
                        'department_id'=> $department->id,
                        'login_id'=> 2,
                        'designation_id'=>1,
                        'role_id'=> 1,
                        'title'=> $row->title,
                        'name'=> $row->doctor_name,
                        'pr_address'=> 'BRB Hospitals Limited',
                        'gender'=> $row->sex,
                        'education'=> $row->qualification,
                        'user_id'=>Auth::user()->id,
                        'status'=>true
                    ]);

            }

        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
//            $request->session()->flash('alert-danger', $error.'Not Saved');
            return redirect()->back()->with('error',$row->Doctor_code.'Not Saved '.$error);
        }

        DB::commit();

        dd('complete');

        return view('admin.doctor-index');
    }
}
