<?php

namespace App\Http\Controllers\Prescription;

use App\Models\Appointment;
use App\Models\Medicine;
use App\Models\Prescription;
use App\Models\Title;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class AppointmentController extends Controller
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
        if(check_privilege(20,1) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return redirect()->back()->with('error', 'You do not have permission. Please contact your administrator');
        }




        $db_ext = DB::connection('sqlsrv');

        $data = $db_ext->table('doctor_Appointment')
            ->where('appointment_date',Carbon::now()->format('Y-m-d'))
            ->where('status','A') ->whereNotNull('registration_no')
            ->where('doctor_code',get_doctor_external_id(Auth::user()->attached))
            ->get();


        $canceled = $db_ext->table('doctor_Appointment')
            ->where('appointment_date',Carbon::now()->format('Y-m-d'))
            ->where('status','I') ->whereNotNull('registration_no')
            ->where('doctor_code',get_doctor_external_id(Auth::user()->attached))
            ->get();

        $appoints = Appointment::query()->where('appointment_date',Carbon::now()->format('Y-m-d'))
            ->where('doctor_id',get_doctor_external_id(Auth::user()->attached))->get();

//        foreach ($appoints as $row)
//        {
//            if($canceled->contains('appointment_no',$row->appointment_no) AND ($row->status == 1))
//            {
//                $appoints->where('id',$row->id)->update(['active'=>'C']);
//            }
//        }

//        dd($data);

        DB::beginTransaction();

        try {

            foreach ($data as $row)
            {

                $title = Title::query()->where('id',$row->App_title_id)->first();
                $title_text = empty($title->title) ? '': $title->title;

                $from_time = Carbon::parse($row->from_time)->format('H:i:s');
                $a_date = Carbon::now()->format('Y-m-d');
                $fromtime = $a_date.' '.$from_time;

                $to_time = Carbon::parse($row->to_time)->format('H:i:s');
                $totime = $a_date.' '.$to_time;


                $data = Appointment::firstOrCreate(['appointment_no' => $row->appointment_no],
                    ['company_id'=>$this->company_id,
                        'appointment_no'=> $row->appointment_no,
                        'appointment_date'=> $row->appointment_date,
                        'appointment_type'=>$row->appointment_type,
                        'appointment_newrepeat'=> $row->appointment_newrepeat,
                        'doctor_id'=> $row->doctor_code,
                        'registration_no'=> $row->registration_no,
                        'title'=> $title_text,
                        'first_name'=> $row->first_name,
                        'middle_name'=> $row->middle_name,
                        'last_name'=> $row->last_name,
                        'name'=> $title_text.' '.$row->first_name.' '.$row->middle_name.' '.$row->last_name,
                        'father_name'=> $row->App_father_name,
                        'dob'=> $row->App_date_of_birth,
                        'age'=> $row->age,
                        'gender'=> $row->sex,
                        'address'=> $row->address1,
                        'mobile'=> $row->mobile,
                        'email'=> $row->email,
                        'from_time'=> $fromtime,
                        'to_time'=> $totime,
                        'serial_no'=>$row->appointment_no,
                        'purpose'=> $row->purpose_no,
                        'user_id'=>$this->user_id,
                        'status'=>true
                    ]);


//                $prescription = array();
//
//                $prescription['company_id'] = $this->company_id;
//                $prescription['appointment_id'] = $data->id;
//                $prescription['registration_no'] = $data->registration_no;
//                $prescription['doctor_id'] = $data->doctor_id;
//                $prescription['record_date'] = Carbon::now()->format('Y-m-d');
//                $prescription['status'] = true;
//                $prescription['user_id'] = $this->user_id;

                Prescription::firstOrCreate(['appointment_id' => $data->id],
                    [
                        'company_id' => $this->company_id,
                        'registration_no' => $data->registration_no,
                        'doctor_id' => $data->doctor_id,
                        'record_date' => Carbon::now()->format('Y-m-d'),
                        'status' => true,
                        'user_id' => $this->user_id
                    ]);
//                Prescription::query()->create($prescription);

            }

        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
//            $request->session()->flash('alert-danger', $error.'Not Saved');
            return redirect()->back()->with('error','Not Saved '.$error);
        }

        DB::commit();

        return view('prescription.appointment-index');
    }



    public function tabledata()
    {
        $appointments = Appointment::query()->where('company_id',$this->company_id)
            ->where('appointment_date',Carbon::now()->format('Y-m-d'))
            ->where('doctor_id',get_doctor_external_id(Auth::user()->attached))
            ->where('active','A')
            ->orderBy('from_time')
            ->get();


        return DataTables::of($appointments)

            ->addColumn('action', function ($appointments) {

                return '<div class="btn-group btn-group-sm" role="group" aria-label="Action Button">
                    <button data-remote="create/'.$appointments->id.'"  type="button" class="btn btn-create btn-sm btn-primary"><i></i> Create</button>
                    <button data-remote="edit/' . $appointments->id . '" data-rowid="'. $appointments->id . '" data-title="'. $appointments->title . '" 
                        data-firstname="'. $appointments->first_name . '" 
                        data-middlename="'. $appointments->middle_name . '"
                        data-lastname="'. $appointments->last_name . '"
                        data-page="'. $appointments->age . '"
                        type="button" href="#patient-update-modal" data-target="#patient-update-modal" data-toggle="modal" class="btn btn-sm btn-patient-edit btn-info pull-center"><i></i>Edit</button>
                    </div>
                    ';
            })

            ->editColumn('status', function($appointment){


                if($appointment->status == false){

                    return "<i class=\"fa fa-check-circle fa-lg\" style=\"color:red\" aria-hidden=\"true\">Visited</i>";
                }
                else
                {
                    return "<i class=\"fa fa-openid-circle fa-lg\" style=\"color:green\"></i>";
                }

            })

            ->addColumn('visit', function ($appointments) {
                return Carbon::parse($appointments->from_time)->format('H:i:s');
            })

            ->rawColumns(['visit','action','status'])
            ->make(true);
    }

    public function getRegData($id)
    {
        $db_ext = DB::connection('sqlsrv');

        $data = $db_ext->table('patient_registration')
            ->where('registration_no',$id)
            ->first();

        $title = $db_ext->table('title_master')->where('title_id',$data->title_id)->first();

        $data->ptitle = $title->title;


//        $data = $db_ext->table('doctor_Appointment')
//            ->where('appointment_date',Carbon::now()->format('Y-m-d'))
//            ->where('status','A') ->whereNotNull('registration_no')
//            ->get();

        return json_encode($data);
    }


    public function appFromRegistration(Request $request)
    {
        if(check_privilege(20,2) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return redirect()->back()->with('error', 'You do not have permission. Please contact your administrator');
        }

        $db_ext = DB::connection('sqlsrv');

        $data = $db_ext->table('patient_registration')
//            ->where('registration_date','<',Carbon::now()->format('Y-m-d'))
            ->where('registration_no',$request['btn-app-reg'])
            ->first();

        $title = $db_ext->table('title_master')->where('title_id',$data->title_id)->first();
        


        $data->ptitle = $title->title;

        $app_no = rand( 11111 , 99999 );

        DB::beginTransaction();

        try {

            $request['company_id'] = $this->company_id;
            $request['company_id'] = $this->company_id;
            $request['appointment_no'] = $app_no;
            $request['appointment_date'] = Carbon::now()->format('Y-m-d');
            $request['appointment_type'] = 'RE';
            $request['appointment_newrepeat'] = 'O';
            $request['doctor_id'] = get_doctor_external_id(Auth::user()->attached);
            $request['registration_no'] = $request['btn-app-reg'];
            $request['title'] = $title->title;
            $request['first_name'] = $data->first_name;
            $request['middle_name'] = $data->middle_name;
            $request['last_name'] = $data->family_name;
            $request['name'] = $title->title.' '.$data->first_name.' '.$data->middle_name.' '.$data->family_name;
            $request['father_name'] = $data->father_name;
            $request['dob'] = $data->date_of_birth;
            $request['age'] = $data->age;
            $request['gender'] = $data->sex;
            $request['address'] = $data->local_address1;
            $request['mobile'] = $data->mobile;
            $request['from_time'] = Carbon::now();
            $request['to_time'] = Carbon::now();
            $request['serial_no'] = $app_no;
            $request['mobile'] = 1;
            $request['user_id'] = $this->user_id;
            $request['status'] = true;

            $apps = Appointment::create($request->all());

            Prescription::firstOrCreate(['appointment_id' => $apps->id],
                [
                    'company_id' => $this->company_id,
                    'registration_no' => $apps->registration_no,
                    'doctor_id' => $apps->doctor_id,
                    'record_date' => Carbon::now()->format('Y-m-d'),
                    'status' => true,
                    'user_id' => $this->user_id
                ]);
        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
//            $request->session()->flash('alert-danger', $error.'Not Saved');
            return redirect()->back()->with('error','Not Saved '.$error);
        }

        DB::commit();


        return redirect()->action('Prescription\AppointmentController@index');
    }

    public function updatePatient(Request $request)
    {
        if(check_privilege(20,3) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return response()->json(['error' => 'You have no Permission'], 404);
        }


        Appointment::query()->where('id',$request->app_id)
            ->update(['title'=>$request->title, 'first_name'=>$request->first_name, 'middle_name'=>$request->middle_name,
                'last_name'=>$request->last_name, 'name'=> $request->title.' '.$request->first_name.' '.$request->middle_name.' '.$request->last_name,
                'age'=>$request->p_age]);

        return response()->json(['success' => 'Successfully Updated'], 200);

//        return json_encode('success');
    }


}
