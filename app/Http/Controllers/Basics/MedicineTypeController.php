<?php

namespace App\Http\Controllers\Basics;

use App\Models\MedicineType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class MedicineTypeController extends Controller
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
        if(check_privilege(14,1) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return redirect()->back()->with('error', 'You do not have permission. Please contact your administrator');
        }

        return view('basics.medicine-type-index');

        $db_ext = DB::connection('sqlsrv');

        $data =  $db_ext->select('select * from Group_Master where category_code in(28,35);');

        DB::beginTransaction();

        try {

            foreach ($data as $row)
            {

                MedicineType::firstOrCreate(['type_code' => $row->group_code],
                    ['company_id'=> 1,
                        'name'=>$row->group_name,
                        'short_name'=>$row->Short_name,
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

    public function mtypesTableData()
    {
        $mtypes = MedicineType::query()->where('company_id',$this->company_id)->get();


        return DataTables::of($mtypes)

            ->addColumn('action', function ($mtypes) {

                return '<div class="btn-group btn-group-sm" role="group" aria-label="Action Button">
                    <button data-rowid="'. $mtypes->id . '"
                        data-name="'. $mtypes->name . '" data-shortname="'. $mtypes->short_name . '"
                        data-status="'. $mtypes->status . '"
                        type="button" href="#modal-edit-mtype" data-target="#modal-edit-mtype" data-toggle="modal" class="btn btn-sm btn-mtype-edit btn-info pull-center"><i></i>Edit</button>
                    </div>
                    ';
            })

            ->addColumn('status', function ($mtypes) {

                return $mtypes->status == true ? 'Active' : 'Disabled';
            })


            ->rawColumns(['action','status'])
            ->make(true);
    }
}
