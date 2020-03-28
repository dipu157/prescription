<?php

namespace App\Http\Controllers\Prescription;

use App\Models\Appointment;
use App\Models\DiagnosisAdvice;
use App\Models\Prescription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PreviousController extends Controller
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
      // $details = Prescription::query()->where('company_id',$this->company_id)
      //      ->where('doctor_id',get_doctor_external_id(Auth::user()->attached))
      //      ->with('patient')->with('amedicine.medicine')->with('adiagnosis')
      //      ->where('status',false)->where('id',123)
      //       ->with('gadvice')->first();

//
//        foreach ($details->amedicine as $item)
//        {
//            dd($item->medicine->name);
//        }

//        $app_no = rand( 11111 , 99999 );

//            int_random(11111,99999,5);

//        dd($app_no);

        
        return view('prescription.previous-index');
    }

    public function previousTable()
    {

        $prescriptions = Prescription::query()->where('company_id',$this->company_id)
            ->where('doctor_id',get_doctor_external_id(Auth::user()->attached))
            // ->whereNotBetween('record_date',['2019-07-22','2019-07-23'])
            ->with('patient')->with('amedicine')->with('adiagnosis')
            ->where('status',false)
            ->with('gadvice')->get();



        return DataTables::of($prescriptions)

            ->addColumn('action', function ($prescriptions) {

                return '<div class="btn-group btn-group-sm" role="group" aria-label="Action Button">
                    <button data-remote="previousdetails/'.$prescriptions->id.'" data-toggle="modal" data-target="#previous-advices-modal"  type="button" class="btn btn-previous btn-sm btn-primary"><i></i> Details</button>
                    <button data-remote="previousprint/'.$prescriptions->id.'" type="button" class="btn btn-print btn-sm btn-secondary"><i class="fa fa-print"></i>Print</button>
                    
                    ';
            })

            ->make(true);
    }

    public function previousDetailsData($id)
    {
        $details = Prescription::query()->where('company_id',$this->company_id)
            ->where('doctor_id',get_doctor_external_id(Auth::user()->attached))
            ->with('patient')->with('amedicine.medicine')->with('adiagnosis.diagnosis')
            ->where('status',false)->where('id',$id)
            ->with('gadvice')->first();

        return json_encode($details);
    }

    public function previousPrint($id)
    {
        $prescription = Prescription::query()->where('id',$id)
            ->with('amedicine')->with('adiagnosis')
            ->with('gadvice')->with('doctor')
            ->first();

        $investigations = DiagnosisAdvice::query()
            ->join('diagnoses', 'diagnosis_advices.diagnosis_id', '=', 'diagnoses.id')
            ->select(DB::raw("group_concat(diagnoses.name SEPARATOR ', ') as invest"))
            ->groupBy('diagnosis_advices.prescription_id')
            ->where('diagnosis_advices.prescription_id',$id)->get();


        $patient = Appointment::query()->where('id',$prescription->appointment_id)->first();

        Appointment::query()->where('id',$prescription->appointment_id)->update(['status'=>false,'visit_date'=>$patient->appointment_date]);

        Prescription::query()->where('id',$id)->update(['status'=>false]);


        if(file_exists(resource_path('views/prescription/formats/'.Auth::user()->attached.'-format.blade.php')))
        {
            return view('prescription.formats.'.Auth::user()->attached.'-format',compact('prescription','patient','investigations'));
        }


        return view('prescription.preview-prescription',compact('prescription','patient','investigations'));
    }
}
