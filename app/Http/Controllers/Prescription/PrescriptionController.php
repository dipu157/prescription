<?php

namespace App\Http\Controllers\Prescription;

use App\Models\Advice;
use App\Models\Appointment;
use App\Models\Diagnosis;
use App\Models\DiagnosisAdvice;
use App\Models\GeneralAdvice;
use App\Models\Generic;
use App\Models\Manufacturer;
use App\Models\Medicine;
use App\Models\MedicineAdvice;
use App\Models\MedicineType;
use App\Models\PatientHistory;
use App\Models\Prescription;
use App\Models\PresMedicineDuration;
use App\Models\Strength;
use App\Models\Template;
use Carbon\Carbon;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;
use TCPDF_FONTS;
//use PDF;

class PrescriptionController extends Controller
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

    public function index($id)
    {

        if(check_privilege(22,1) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return redirect()->back()->with('error', 'You do not have permission. Please contact your administrator');
        }

        $appointment = Appointment::query()->where('company_id',$this->company_id)
            ->where('id',$id)->first();

        $prescription = Prescription::query()->where('company_id',$this->company_id)
            ->where('appointment_id',$id)->first();

        //dd($prescription);


        $strengths = Strength::query()->where('status',true)
            ->orderBy('name')
            ->pluck('name','id');

        $manufacturers = Manufacturer::query()->where('status',true)
            ->orderBy('name')->pluck('name','id');

        $types = MedicineType::query()->where('status',true)
            ->orderBy('name')->pluck('name','id');

        $advices = Template::query()->where('company_id',$this->company_id)
            ->where('item_type','A')
            ->where('person_id',Auth::user()->attached)->get();

        $investigations = Template::query()->where('company_id',$this->company_id)
            ->where('item_type','I')->with('investigation')
            ->where('person_id',Auth::user()->attached)->get();

        $complains = Template::query()->where('company_id',$this->company_id)
            ->where('item_type','C')
            ->where('person_id',Auth::user()->attached)->pluck('value1','id');


        $previous = Prescription::query()->where('company_id',$this->company_id)
            ->where('doctor_id',get_doctor_external_id(Auth::user()->attached))
            ->where('registration_no',$prescription->registration_no)
            ->where('id','<',$prescription->id)
            ->where('status',false)
            ->with('amedicine')->with('adiagnosis')
            ->with('gadvice')->get();

//        dd($previous);

        return view('prescription.prescription-index',compact('appointment','prescription','advices','strengths','manufacturers','types','complains','investigations','previous'));
//        return view('prescription.test',compact('appointment','prescription'));
    }

    public function generalInfo(Request $request)
    {

        if(check_privilege(23,1) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return redirect()->back()->with('error', 'You do not have permission. Please contact your administrator');
        }


        DB::beginTransaction();

        try {

            Prescription::query()->where('company_id',$this->company_id)
                ->where('appointment_id',$request['btn-general'])
                ->update(['complains'=>$request['complains'],
                    'weight'=>$request['weight'],
                    'bp'=>$request['bp'],
                    'sugar'=>$request['sugar'],
                    'temperature'=>$request['temperature'],
                    'pulse'=>$request['pulse'],
                    'current_medication' => $request['c-medicine'],
                    'diagnosis'=>$request['diagnosis'],
                    'grade'=>$request['pgroup'],
                    'bsa'=>$request['bsa'],
                    'o2sat'=>$request['o2sat'],
                    'stage'=>$request['stage'],
                    'remarks'=>$request['c-remarks']]);

        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
//            $request->session()->flash('alert-danger', $error.'Not Saved');
            return redirect()->back()->with('error','Not Saved '.$error);
        }

        $appointment = Appointment::query()->where('company_id',$this->company_id)
            ->where('id',$request['btn-general'])->first();

        $prescription = Prescription::query()->where('company_id',$this->company_id)
            ->where('appointment_id',$request['btn-general'])->first();

        DB::commit();

        $advices = Advice::query()->where('company_id',$this->company_id)->limit(10)->get();

        return redirect()->action('Prescription\PrescriptionController@index',['id'=>$prescription->appointment_id]);

//        return view('prescription.prescription-index',compact('appointment','prescription','advices'));
    }

    public function medicineInfo(Request $request)
    {

        if(check_privilege(25,2) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return response()->json(['error' => 'You have no Permission'], 404);
//            return redirect()->back()->with('error', 'You do not have permission. Please contact your administrator');
        }

        $request['company_id'] = $this->company_id;
//        $request['prescription_id'] = $request['prescription_id'];
        $request['record_date'] = Carbon::now()->format('Y-m-d');
//        $request['medicine_id'] =
//        $request['type'] =
        $request['strength'] = $request['m_strength'];
        $request['dose'] = $request['m_dose'];
        $request['duration'] = $request['m_duration'];
        $request['advice'] = $request['m_instruction'];
        $request['open_mode'] = 'O';
        $request['status'] = true;
        $request['user_id'] = $this->user_id;

//        dd('here');

        DB::beginTransaction();

        try {

            $mids= MedicineAdvice::query()->create($request->all());

            $request['m_advice_id'] = $mids->id;

            PresMedicineDuration::query()->create($request->all());

        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
            echo json_encode(array("status" => FALSE));
//            $request->session()->flash('alert-danger', $error.'Not Saved');
//            return redirect()->back()->with('error','Not Saved '.$error);
        }

//        $medicines = MedicineAdvice::query()->where('prescription_id',$request['prescription_id'])->get();
//
//        $prescription = Prescription::query()->where('company_id',$this->company_id)
//            ->where('id',$request['prescription_id'])->first();
//
//        $appointment = Appointment::query()->where('company_id',$this->company_id)
//            ->where('id',$prescription->appointment_id)->first();

        DB::commit();

//        $advices = Advice::query()->where('company_id',$this->company_id)->limit(10)->get();

        echo json_encode(array("status" => TRUE));

//        return view('prescription.prescription-index',compact('appointment','prescription','medicines','advices'));

    }


    public function medicineAdviceTable($id)
    {
        $medicines = MedicineAdvice::query()->where('company_id',1)
            ->where('prescription_id',$id)->with('medicine')
            ->with('durations')
            ->get();

        return DataTables::of($medicines)

            ->addColumn('action', function ($medicines) {

                return '
                <div class="btn-group btn-group-sm" role="group" aria-label="Action Button">
                
                <button type="button" data-m-name="'.$medicines->medicine->name.'" data-ma-id="'.$medicines->id.'" class="btn btn-primary btn-extra-dose btn-sm btn-rounded"><i class="fa fa-plus"></i></button>
                <button data-remote="delete/'.$medicines->id.'"  type="button" class="btn btn-delete btn-sm btn-danger btn-rounded"><i class="fa fa-trash"></i></button>
                </div>
                
                    ';
            })

            ->addColumn('nextdose', function ($medicines) {
                return $medicines->durations->map(function($medicines) {
                    return $medicines->dose;
                })->implode('<br>');
            })

            ->addColumn('nextduration', function ($medicines) {
                return $medicines->durations->map(function($medicines) {
                    return $medicines->duration;
                })->implode('<br>');
            })

            ->addColumn('nextadvice', function ($medicines) {
                return $medicines->durations->map(function($medicines) {
                    return $medicines->advice;
                })->implode('<br>');
            })

            ->rawColumns(['nextdose','nextduration','nextadvice','action'])
            ->make(true);
    }

    public function medicineDelete($id, Request $request)
    {

        if(check_privilege(25,4) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return response()->json(['error' => 'You have no Permission'], 404);
        }

        $data = MedicineAdvice::query()->where('id',$id)->delete();
                PresMedicineDuration::query()->where('m_advice_id',$id)->delete();

        echo json_encode(array("status" => TRUE));

//        <button id="modal-add-dose-duration" data-toggle="modal" data-target="#modal-add-dose-duration'.$medicines->id.'"  type="button" class="btn btn-add btn-sm btn-info"><i class="fa fa-plus"></i></button>

    }


    public function saveextradose(Request $request)
    {

        if(check_privilege(25,2) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return response()->json(['error' => 'You have no Permission'], 404);
        }

        $request['company_id'] = $this->company_id;
        $request['m_advice_id'] = $request['ma_id'];
        $request['dose'] = $request['new_dose'];
        $request['duration'] = $request['new_duration'];
        $request['advice'] = $request['new_instruction'];
        $request['status'] = true;
        $request['user_id'] = $this->user_id;

        DB::beginTransaction();

        try {

            PresMedicineDuration::query()->create($request->all());


        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
//            $request->session()->flash('alert-danger', $error.'Not Saved');
            return redirect()->back()->with('error','Not Saved '.$error);
        }

        DB::commit();

        echo json_encode(array("status" => TRUE));
    }

    public function diagnosisInfo(Request $request)
    {
        if(check_privilege(26,2) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return response()->json(['error' => 'You have no Permission'], 404);
        }

        $request['company_id'] = $this->company_id;
//        $request['prescription_id'] = $request['prescription_id'];
        $request['record_date'] = Carbon::now()->format('Y-m-d');
//        $request['medicine_id'] =
//        $request['type'] =
//        $request['diagnosis_id'] =
        $request['remarks'] = $request['d_remarks'];
        $request['status'] = true;
        $request['user_id'] = $this->user_id;


        DB::beginTransaction();

        try {

            DiagnosisAdvice::query()->create($request->all());

        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
//            $request->session()->flash('alert-danger', $error.'Not Saved');
            return redirect()->back()->with('error','Not Saved '.$error);
        }

//        $medicines = MedicineAdvice::query()->where('prescription_id',$request['prescription_id'])->get();
//        $diagnosis = DiagnosisAdvice::query()->where('prescription_id',$request['prescription_id'])->get();
//
//        $prescription = Prescription::query()->where('company_id',$this->company_id)
//            ->where('id',$request['prescription_id'])->first();
//
//        $appointment = Appointment::query()->where('company_id',$this->company_id)
//            ->where('id',$prescription->appointment_id)->first();

        DB::commit();

//        $advices = Advice::query()->where('company_id',$this->company_id)->limit(10)->get();

        echo json_encode(array("status" => TRUE));

//        return view('prescription.prescription-index',compact('appointment','prescription','medicines','diagnosis','advices'));

    }

    public function diagnosisAdviceTable($id)
    {
        $diagnosis = DiagnosisAdvice::query()->where('company_id',1)
            ->where('prescription_id',$id)->with('diagnosis')
            ->get();

        return DataTables::of($diagnosis)

            ->addColumn('action', function ($diagnosis) {

                return '
                <div class="btn-group btn-group-sm" role="group" aria-label="Action Button">
                <button data-remote="deleteDiagnosis/'.$diagnosis->id.'"  type="button" class="btn btn-delete btn-sm btn-danger btn-rounded"><i class="fa fa-trash"></i></button>
                </div>
                    ';
            })
            ->make(true);
    }

    public function diagnosisDelete($id)
    {

        if(check_privilege(26,4) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return response()->json(['error' => 'You have no Permission'], 404);
        }

        $data = DiagnosisAdvice::query()->where('id',$id)->delete();
        echo json_encode(array("status" => TRUE));
    }

    public function saveAdviceData(Request $request)
    {

        if(check_privilege(27,2) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return response()->json(['error' => 'You have no Permission'], 404);
        }

        $request['company_id'] = $this->company_id;
        $request['record_date'] = Carbon::now()->format('Y-m-d');
        $request['status'] = true;
        $request['user_id'] = $this->user_id;

//        dd($request['advice_id']);


        DB::beginTransaction();

        try {

            foreach ($request['advice_check'] as $item) {

                $request['advice'] = $item[0];

                $ids = GeneralAdvice::query()->create($request->all());

            }


        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
            dd($error);
            return redirect()->back()->with('error','Not Saved '.$error);
        }

        DB::commit();


        return json_encode($ids);


    }

    public function printPrescription($id)
    {

        $prescription = Prescription::query()->where('id',$id)
            ->with('amedicine')->with('adiagnosis')
            ->with('gadvice')->with('doctor')
            ->first();

        $patient = Appointment::query()->where('id',$prescription->appointment_id)->first();



        $view = \View::make('prescription.pdf-print-prescription',compact('prescription','patient'));
        $html = $view->render();

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);
//                    $pdf = new TCPDF('L', PDF_UNIT, array(105,148), true, 'UTF-8', false);
//                    $pdf::setMargin(0,0,0);

        $fontname = TCPDF_FONTS::addTTFfont('font/solaiman-lipi.ttf', 'TrueTypeUnicode', '', 32);
        $pdf::SetFont($fontname, '', 14, '', false);

//        $fontname1 = TCPDF_FONTS::addTTFfont('font/solaiman-lipi.ttf', 'TrueTypeUnicode', '', 32);
//        $pdf::SetFont($fontname1, '', 8, '', false);



        $pdf::SetMargins(10, 25, 5,0);

        $pdf::AddPage();

        $pdf::writeHTML($html, true, false, true, false, '');
        $pdf::Output('prescription.pdf');

        return view('prescription.pdf-print-prescription');
    }

    public function generate_pdf($id)
    {

        $prescription = Prescription::query()->where('id',$id)
            ->with('amedicine')->with('adiagnosis')
            ->with('gadvice')->with('doctor')
            ->first();

        $patient = Appointment::query()->where('id',$prescription->appointment_id)->first();

        $pdf = PDF::loadView('prescription.test',compact('patient','prescription'));
        return $pdf->stream('document.pdf');
    }

    public function presPreview($id)
    {
        $prescription = Prescription::query()->where('id',$id)
            ->with('amedicine')->with('adiagnosis')
            ->with('gadvice')->with('doctor')
            ->first();

//        $investigations = DiagnosisAdvice::query()
//            ->select(DB::raw("group_concat(diagnosis_id SEPARATOR ',') as invest"))
//            ->groupBy('prescription_id')
//            ->where('prescription_id',$id)
//            ->get();


        $investigations = DiagnosisAdvice::query()
            ->join('diagnoses', 'diagnosis_advices.diagnosis_id', '=', 'diagnoses.id')
            ->select(DB::raw("group_concat(diagnoses.name SEPARATOR ', ') as invest"))
            ->groupBy('diagnosis_advices.prescription_id')
            ->where('diagnosis_advices.prescription_id',$id)->get();


//        dd($investigations);


        $patient = Appointment::query()->where('id',$prescription->appointment_id)->first();

        Appointment::query()->where('id',$prescription->appointment_id)->update(['status'=>false,'visit_date'=>$patient->appointment_date]);

        Prescription::query()->where('id',$id)->update(['status'=>false]);



//        dd(resource_path('views/prescription/formats/'.Auth::user()->attached.'-format.blade.php'));


        if(file_exists(resource_path('views/prescription/formats/'.Auth::user()->attached.'-format.blade.php')))
        {
            return view('prescription.formats.'.Auth::user()->attached.'-format',compact('prescription','patient','investigations'));
        }


        return view('prescription.preview-prescription',compact('prescription','patient','investigations'));

//        return view('prescription.print-prescription-html',compact('prescription','patient'));
    }

    public function createHistory(Request $request)
    {

        if(check_privilege(24,2) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return response()->json(['error' => 'You have no Permission'], 404);
        }

        $request['company_id'] = $this->company_id;
        $request['record_date'] = Carbon::now()->format('Y-m-d');
        $request['status'] = true;
        $request['user_id'] = $this->user_id;

//        $request['chk_food_allergies'] = $request->filled('chk_food_allergies') ? true : false;



        DB::beginTransaction();

        try {


            $ids = PatientHistory::query()->updateOrCreate(['prescription_id'=>$request['prescription_id']],
                [
                   'company_id'=>$this->company_id,
                    'record_date'=>Carbon::now()->format('Y-m-d'),
                    'food_allergies'=>$request['food_allergies'],
                    'chk_food_allergies'=>$request['chk_food_allergies'],
                    'tendency_bleed' =>$request['tendency_bleed'],
                    'chk_tendency_bleed'=>$request['chk_tendency_bleed'],
                    'heart_disease'=>$request['heart_disease'],
                    'chk_heart_disease'=>$request['chk_heart_disease'],
                    'hbp'=>$request['hbp'],
                    'chk_hbp'=>$request['chk_hbp'],
                    'diabetic'=>$request['diabetic'],
                    'chk_diabetic'=>$request['chk_diabetic'],
                    'surgery'=>$request['surgery'],
                    'chk_surgery'=>$request['chk_surgery'],
                    'accident'=>$request['accident'],
                    'chk_accident'=>$request['chk_accident'],
                    'others'=>$request['others'],
                    'chk_others'=>$request['chk_others'],
                    'fmh'=>$request['fmh'],
                    'chk_fmh'=>$request['chk_fmh'],
                    'current_medication'=>$request['current_medication'],
                    'chk_current_medication'=>$request['chk_current_medication'],
                    'female_pregnancy'=>$request['female_pregnancy'],
                    'chk_female_pregnancy'=>$request['chk_female_pregnancy'],
                    'breast_feeding'=>$request['breast_feeding'],
                    'chk_breast_feeding'=>$request['chk_breast_feeding'],
                    'status'=>$request['status'],
                    'user_id'=>$request['user_id']
                ]);

        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
            return redirect()->back()->with('error','Not Saved '.$error);
        }

        DB::commit();


        return json_encode($ids);
    }

    public function viewHistory($id)
    {
        $data = Prescription::query()->where('id',$id)
            ->with('history')->first();

        return json_encode($data);

    }

    public function getGeneralAdviceData($id)
    {
        $data = GeneralAdvice::query()->where('prescription_id',$id)->get();

        return json_encode($data);
    }

    public function createNewMedicine(Request $request)
    {
        $request['company_id'] = $this->company_id;
        $request['status'] = true;
        $request['user_id'] = $this->user_id;
        $request['strength_id'] = $request['new_strength_id'];
        $request['medicine_type_id'] = $request['new_type_id'];
        $request['doctor_id'] = Auth::user()->attached;
        $request['is_group'] = false;
        $request['name'] = $request['new_medicine_name'];

        DB::beginTransaction();

        try {

            $new_m = Medicine::query()->create($request->all());

            $request['person_id'] = Auth::user()->attached;
            $request['item_type'] = 'M';
            $request['item_id'] = $new_m->id;
            $request['value1'] = $request['new_medicine_dose'];
            $request['value2'] = $request['new_medicine_duration'];
            $request['value3'] = $request['new_medicine_instruction'];

            Template::query()->create($request->all());
        }


        catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
            return redirect()->back()->with('error','Not Saved '.$error);
        }

        DB::commit();


        return json_encode('Success');


    }

    public function createNewGeneric(Request $request)
    {
        $request['company_id'] = $this->company_id;
        $request['status'] = true;
        $request['user_id'] = $this->user_id;
        $request['name'] = $request['new_generic_name'];
        $request['description'] = $request['new_generic_description'];

        DB::beginTransaction();

        try {

            $new_m = Generic::query()->create($request->all());

        }


        catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
            return redirect()->back()->with('error','Not Saved '.$error);
        }

        DB::commit();


        return json_encode('Success');
    }


    public function saveInvestigationData(Request $request)
    {


        if(check_privilege(26,2) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return response()->json(['error' => 'You have no Permission'], 404);
        }

        $request['company_id'] = $this->company_id;
        $request['record_date'] = Carbon::now()->format('Y-m-d');
//        $request['remarks'] = $request['d_remarks'];
        $request['status'] = true;
        $request['user_id'] = $this->user_id;


//        dd($request['investigation_id']);


        DB::beginTransaction();

        try {


//            DiagnosisAdvice::query()->where('prescription_id',$request['prescription_id'])->delete();

            foreach($request['investigation_id'] as $i=>$item) {

//                $request['diagnosis_id'] = $item;

                $data = Template::query()->where('id',$item)->first();

//                dd($item);
//
                $request['diagnosis_id'] = $data->item_id;
                $request['remarks'] = $data->value3;

//                $request['advice'] = $data->value1;

//                dd($request);
                $count = DiagnosisAdvice::query()->where('company_id',$this->company_id)
                    ->where('diagnosis_id', $data->item_id)
                    ->where('prescription_id', $request['prescription_id'])
                    ->count();

                if(empty($count))
                {
                    DiagnosisAdvice::query()->create($request->all());
                }

            }


        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
            return redirect()->back()->with('error','Not Saved '.$error);
        }

        DB::commit();


        return json_encode('Investigation Added');
    }


    public function photoupdate(Request $request)
    {


        DB::beginTransaction();

        try {

            $prescription = Prescription::query()->where('appointment_id',$request['buttonvalue'])->first();

            if($request->hasfile('imagefilename'))
                {
                    $file = $request->file('imagefilename');
                    $name = $prescription->id.'.jpg';
                    $file->move(public_path().'/photo/', $name);


                    Prescription::query()->where('id',$prescription->id)->update(['image'=>'photo/'.$name]);
                }

        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
            return redirect()->back()->with('error','Not Saved '.$error);
        }

        DB::commit();


        return redirect()->action('Prescription\PrescriptionController@index',['id'=>$request['buttonvalue']]);
    }


    public function generalAdvicesTable($id)
    {
        $gadvicess = GeneralAdvice::query()->where('company_id',1)
            ->where('prescription_id',$id)->get();

        return DataTables::of($gadvicess)

            ->addColumn('action', function ($gadvicess) {

                return '
                <div class="btn-group btn-group-sm" role="group" aria-label="Action Button">
                <button data-remote="deleteGAdvices/'.$gadvicess->id.'"  type="button" class="btn btn-delete btn-sm btn-danger btn-rounded"><i class="fa fa-trash"></i></button>
                </div>
                    ';
            })
            ->make(true);

    }

    public function advicesDelete($id)
    {
        if(check_privilege(27,4) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return response()->json(['error' => 'You have no Permission'], 404);
        }

        $data = GeneralAdvice::query()->where('id',$id)->delete();
        echo json_encode(array("status" => TRUE));
    }

    public function singleAdvicesSave(Request $request)
    {
        if(check_privilege(27,2) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return response()->json(['error' => 'You have no Permission'], 404);
        }

        $request['company_id'] = $this->company_id;
        $request['record_date'] = Carbon::now()->format('Y-m-d');
        $request['status'] = true;
        $request['user_id'] = $this->user_id;

//        dd($request['advice_id']);


        DB::beginTransaction();

        try {


                $request['advice'] = $request['new_advice'];

                $ids = GeneralAdvice::query()->create($request->all());



        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
            dd($error);
            return redirect()->back()->with('error','Not Saved '.$error);
        }

        DB::commit();


        return json_encode($ids);
    }


    public function copyPrevious(Request $request)
    {
        if(check_privilege(25,2) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return response()->json(['error' => 'You have no Permission'], 404);
//            return redirect()->back()->with('error', 'You do not have permission. Please contact your administrator');
        }

        $request['company_id'] = $this->company_id;
        $request['prescription_id'] = $request['current_id'];
        $request['record_date'] = Carbon::now()->format('Y-m-d');
        $request['status'] = true;
        $request['user_id'] = $this->user_id;


        $medicine = MedicineAdvice::query()->where('company_id',$this->company_id)
            ->where('prescription_id',$request['prev_id'])
            ->with('durations')
            ->get();

//        dd($medicine);

        $pr_prescription = Prescription::query()->where('company_id',$this->company_id)
            ->where('id',$request['prev_id'])->first();


        DB::beginTransaction();

        try {

            Prescription::query()->where('id',$request['prescription_id'])->update(['diagnosis'=>$pr_prescription->diagnosis,'complains'=>$pr_prescription->complains]);

            foreach ($medicine as $row)
            {
                $request['medicine_id'] = $row->medicine_id;
                $request['type'] = $row->type;
                $request['strength'] = $row->strength;
                $request['dose'] = $row->dose;
                $request['duration'] = $row->duration;
                $request['advice'] = $row->advice;
                $request['open_mode'] = 'O';

                $mids= MedicineAdvice::query()->create($request->all());

                $request['m_advice_id'] = $mids->id;

                foreach ($row->durations as $ndose)
                {
                    $request['dose'] = $ndose->dose;
                    $request['duration'] = $ndose->duration;
                    $request['advice'] = $ndose->advice;
                    $request['duration'] = $ndose->duration;

                    PresMedicineDuration::query()->create($request->all());
                }
            }

            $post_data = array('complaints' => $pr_prescription->complains,
                'diagnosis' => $pr_prescription->diagnosis);

        }catch (\Exception $e)
        {
            DB::rollBack();
            $error = $e->getMessage();
            echo json_encode(array("status" => FALSE, $error));
        }

        DB::commit();

        echo json_encode(array("status" => TRUE, "data" => $post_data));
    }
}
