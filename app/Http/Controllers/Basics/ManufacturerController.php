<?php

namespace App\Http\Controllers\Basics;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class ManufacturerController extends Controller
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

        if(check_privilege(13,1) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return redirect()->back()->with('error', 'You do not have permission. Please contact your administrator');
        }


        return view('basics.manufacturer-index');


//        $db_ext = DB::connection('sqlsrv');
//
//        $data =  $db_ext->select('select * from Supplier_Master where Store_Code = 1140;');
//
//        DB::beginTransaction();
//
//        try {
//
//            foreach ($data as $row)
//            {
//
//                Manufacturer::firstOrCreate(['manu_code' => $row->sup_code],
//                    ['company_id'=> 1,
//                        'name'=>$row->sup_name,
//                        'description'=>$row->sup_name,
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
//
//        return redirect()->route('home')->with('success','Complete');

    }

    public function manufacturerTabledata()
    {
        $manufacturers = Manufacturer::query()->where('company_id',$this->company_id)->get();


        return DataTables::of($manufacturers)

            ->addColumn('action', function ($manufacturers) {

                return '<div class="btn-group btn-group-sm" role="group" aria-label="Action Button">
                    <button data-rowid="'. $manufacturers->id . '"
                        data-name="'. $manufacturers->name . '" data-description="'. $manufacturers->description . '"
                        data-status="'. $manufacturers->status . '"
                        type="button" href="#modal-edit-manufacturer" data-target="#modal-edit-manufacturer" data-toggle="modal" class="btn btn-sm btn-manufacturer-edit btn-info pull-center"><i></i>Edit</button>
                    </div>
                    ';
            })

            ->addColumn('status', function ($manufacturers) {

                return $manufacturers->status == true ? 'Active' : 'Disabled';
            })


            ->rawColumns(['action','status'])
            ->make(true);
    }
    public function create(Request $request)
    {
        if(check_privilege(13,2) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return redirect()->back()->with('error', 'You do not have permission. Please contact your administrator');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:generics',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $request['company_id'] = $this->company_id;
        $request['status'] = true;
        $request['user_id'] = Auth::id();


        DB::beginTransaction();

        try {

            Manufacturer::create($request->all());

        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
//            $request->session()->flash('alert-danger', $error.'Not Saved');
            return redirect()->back()->with('error','Not Saved '.$error);
        }

        DB::commit();


        return back()->with('success','Item created successfully!');
    }

    public function update(Request $request)
    {

        if(check_privilege(13,3) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return redirect()->back()->with('error', 'You do not have permission. Please contact your administrator');
        }

        $status = $request['status'] == 1 ? true : false;

        DB::beginTransaction();

        try {

            Manufacturer::query()->where('id',$request['id'])->update(['name'=>$request['name'],'description'=>$request['description'], 'status'=>$status]);

        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
//            $request->session()->flash('alert-danger', $error.'Not Saved');
            return redirect()->back()->with('error','Not Updated '.$error);
        }

        DB::commit();

//        return redirect()->action('Basics\GenericsController@index')->with('success','Successfully Updated');
//        return json_encode('success','Successfully Updated');
        return response()->json(['success' => 'Successfully Updated'], 200);

    }

}
