<?php

namespace App\Http\Controllers\Prescription;

use App\Models\Advice;
use App\Models\Hresource;
use App\Models\Medicine;
use App\Models\Template;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PersonalisationController extends Controller
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

    public function index()
    {

        if(check_privilege(19,1) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return redirect()->back()->with('error', 'You do not have permission. Please contact your administrator');
        }

        $medicines = Medicine::query()->where('company_id',$this->company_id)->pluck('name','id');
        return view('prescription.template-index',compact('medicines'));
    }

    public function getTableData()
    {
//        $id = 4159;
        $templates = Template::query()->where('company_id',$this->company_id)
            ->where('person_id',Auth::user()->attached)->with('medicine')
            ->with('investigation')
            ->get();


        return DataTables::of($templates)

            ->addColumn('action', function ($templates) {

                return '<div class="btn-group btn-group-sm" role="group" aria-label="Action Button">
                    <button data-remote="create/'.$templates->id.'"  type="button" class="btn btn-edit btn-xs btn-primary"><i></i>Edit</button>
                    <button data-remote="delete/' . $templates->id . '" type="button" class="btn btn-xs btn-delete btn-danger pull-center"><i></i>Del</button>
                    </div>
                    ';
            })

            ->editColumn('item_type', function($templates){

                return $templates->item_type == 'M' ? 'Medicine' : ($templates->item_type == 'C' ? 'Complain' : ($templates->item_type == 'I' ? 'Investigation' : 'Advice'));

            })

            ->editColumn('name', function($templates){

                return $templates->item_type == 'M' ? isset($templates->medicine->name) ? $templates->medicine->name : $templates->item_id : ($templates->item_type == 'I' ? $templates->investigation->name : $templates->value1);

            })


            ->rawColumns(['action','item_type','name'])
            ->make(true);
    }

    public function create(Request $request)
    {
        if(check_privilege(19,2) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return redirect()->back()->with('error', 'You do not have permission. Please contact your administrator');
        }

        $request['company_id'] = $this->company_id;
        $request['user_id'] = $this->user_id;
        $request['person_id'] = Auth::user()->attached;
//        $request['item_type'] = $request['item_type']
//        $request['item_id'] = $request['item_id'];
//        $request['value2'] = $request['duration'];
//        $request['value1'] = $request['dose'];
        $request['status'] = true;

        if($request['item_type'] == 'M' OR $request['item_type'] == 'I')
        {
            if(empty($request['item_id']))
            {
                return redirect()->back()->with('error','Please Properly Select Medicine/Investigation Name');
            }
        }

        DB::beginTransaction();

        try {


            Template::query()->create($request->all());

        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
            return redirect()->back()->with('error','Not Saved '.$error);
        }

        DB::commit();

        return redirect()->action('Prescription\PersonalisationController@index')->with('success','Successfully Saved');

    }

    public function destroy($id)
    {
        if(check_privilege(19,4) == false) //2=Add User  1=view
        {
            return response()->json(['error' => 'You have no Permission'], 404);
        }

        $data = Template::query()->where('id',$id)->delete();
        echo json_encode(array("status" => TRUE));
    }




}
