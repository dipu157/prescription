<?php

namespace App\Http\Controllers\Basics;

use App\Models\Department;
use App\Models\Diagnosis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class DiagnosisController extends Controller
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

    public function index(Request $request)
    {

        if(check_privilege(17,1) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return redirect()->back()->with('error', 'You do not have permission. Please contact your administrator');
        }

//        $db_ext = DB::connection('sqlsrv');
//
//        $data =  $db_ext->select("select Sub_Dept_Code, Service_Name, samplename from item_of_service where Status='A'
//        and Sub_Dept_Code in(select sub_code from department_sub where Status ='A'
//        and type in('CL','I','IS','M','OS','P','S') and len(sub_code) > 0 and len(Type) > 0)");
//
//        DB::beginTransaction();
//
//        try {
//
//            foreach ($data as $row)
//            {
//
//                $department_id = Department::query()->where('department_type','L')
//                    ->where('department_code',$row->Sub_Dept_Code)->first();
//
//                Diagnosis::firstOrCreate(['name' => $row->Service_Name],
//                    ['company_id'=>Auth::user()->company_id,
//                        'department_id' => $department_id->id,
//                        'sample'=>$row->samplename,
//                        'user_id'=>Auth::user()->id,
//                        'status'=>true
//                    ]);
//
//            }
//
//        }catch (\Exception $e)
//        {
//            DB::rollBack();
//            $error = $e->getMessage();
////            $request->session()->flash('alert-danger', $error.'Not Saved');
//            return redirect()->back()->with('error','Not Saved '.$error);
//        }
//
//        DB::commit();

//        return redirect()->route('home')->with('success','Complete');

        return view('basics.investigation-index');

    }

    public function tableData()
    {
        $investigations = Diagnosis::query()->where('company_id',$this->company_id)
            ->get();


        return DataTables::of($investigations)

            ->addColumn('action', function ($investigations) {

                return '<div class="btn-group btn-group-sm" role="group" aria-label="Action Button">
                    <button data-rowid="'. $investigations->id . '" 
                        data-name="'. $investigations->name . '" data-sample="'. $investigations->sample . '" 
                        type="button" href="#modal-edit-investigation" data-target="#modal-edit-investigation" data-toggle="modal" class="btn btn-sm btn-investigation-edit btn-info pull-center"><i></i>Edit</button>
                    </div>
                    ';
            })

            ->addColumn('status', function ($divisions) {

                return $divisions->status == true ? 'Active' : 'Disabled';
            })


            ->rawColumns(['action','status'])
            ->make(true);
    }

    public function create(Request $request)
    {
//        dd($request);

        if(check_privilege(17,2) == false) //2=show Division  1=view
        {
            return redirect()->back()->with('error', trans('message.permission'));
            die();
        }

        DB::beginTransaction();

        try {

            Diagnosis::firstOrCreate(['name' => $request['item_name']],
                    ['company_id'=>$this->company_id,
                        'department_id' => 1,
                        'sample'=>$request['sample'],
                        'user_id'=>$this->user_id,
                        'status'=>true
                    ]);

        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
//            $request->session()->flash('alert-danger', $error.'Not Saved');
            return redirect()->back()->with('error','Not Saved '.$error);
        }

        DB::commit();

        return redirect()->action('Basics\DiagnosisController@index')->with('success','Successfully Added');

    }

    public function update(Request $request)
    {
        if(check_privilege(17,3) == false) //2=show Division  1=view
        {
            return redirect()->back()->with('error', trans('message.permission'));
            die();
        }

        DB::beginTransaction();

        try {

            Diagnosis::query()->where('id',$request['row_id'])->update(['name'=>$request['edit_name'],'sample'=>$request['edit_sample']]);

        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
//            $request->session()->flash('alert-danger', $error.'Not Saved');
            return redirect()->back()->with('error','Not Saved '.$error);
        }

        DB::commit();

        return redirect()->action('Basics\DiagnosisController@index')->with('success','Successfully Updated');

    }
}
