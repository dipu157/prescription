<?php

namespace App\Http\Controllers\Investigation;

use App\Models\Hresource;
use Carbon\Carbon;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ViewInvestigationController extends Controller
{
    public function index(Request $request)
    {

        if(check_privilege(51,1) == false) //2=Add User  1=view
        {
//            session()->flash('danger', 'You do not have permission');
            return redirect()->back()->with('error', 'You do not have permission. Please contact your administrator');
        }

        $results = null;
        $img = null;
        $lab_regs = null;

        $db_ext = DB::connection('sqlsrv');


        $doctor = get_doctor_external_id(Auth::user()->attached);

        $patients = $db_ext->select("select ad.admission_date, ad.encounter_no, ad.registration_no, pr.first_name, pr.middle_name, pr.family_name, ad.current_bed_no 
                from admission_main ad
                join patient_registration pr on pr.registration_no =  ad.registration_no
                where ad.consulting_doctor = '$doctor' and ad.PATAD_TYPE in('A','T')");

//        dd($patients);
//


        if(!empty($request['registration_no']))
        {
            $p_type = $request['opd_ipd'];



            switch($p_type)
            {
                case 'OP':


                    $patient = $db_ext->table('patient_registration')->where('registration_no',$request['registration_no'])->first();
                    $title = $db_ext->table('title_master')->where('title_id',$patient->title_id)->first();

                    $max_lab_id = $db_ext->table('investigation_sample_op')
                        ->where('registration_no',$request['registration_no'])->max('lab_regno');

                    $departments = $db_ext->table('department_sub')->where('Status','A')->get();

                    $results = $db_ext->table('investigation_normal_result_op as r')
                        ->select('r.encoded_date','r.service_code','s.Service_Name','r.sub_department_code','sd.sub_name',
                            'r.result','r.Unit_code', 'u.Unit_name','r.min_value',
                            'r.max_value','r.symbol','r.lab_regno','s.Profile')
                        ->join('item_of_service as s','r.service_code','=','s.Service_code')
                        ->join('department_sub as sd', 'r.sub_department_code', '=','sd.sub_code')
                        ->join('Unit_Lab_Master  as u','r.Unit_code', '=','u.unit_code')
                        ->join('investigation_normal_reading1 as t','t.id','=','r.id')
                        ->where('r.lab_regno',$max_lab_id)->get();

                    $ipNo = $request['registration_no'];



                    $img = count($results) > 0 ? 1 : 0;

                    $uniqueItems = null;

//                    $typical = collect();

                    $typical = $db_ext->table('investigation_typical_result_op as r')
                        ->select('r.encoded_date','r.service_code','s.Service_Name','r.sub_department_code','sd.sub_name',
                            'r.FORMATHTML','r.lab_regno')
                        ->join('item_of_service as s','r.service_code','=','s.Service_code')
                        ->join('department_sub as sd', 'r.sub_department_code', '=','sd.sub_code')
                        ->where('r.lab_regno',$max_lab_id)->get();


//                    foreach ($lab_regs as $reg)
//                    {
//
//                        $data1 = $db_ext->table('investigation_typical_result_op as r')
//                            ->select('r.encoded_date','r.service_code','s.Service_Name','r.sub_department_code','sd.sub_name',
//                                'r.FORMATHTML','r.lab_regno')
//                            ->join('item_of_service as s','r.service_code','=','s.Service_code')
//                            ->join('department_sub as sd', 'r.sub_department_code', '=','sd.sub_code')
//                            ->where('r.lab_regno',$max_lab_id)->get();
//
//                        if(!is_null($data1))
//                        {
//                            $typical = $typical->merge($data1);
//                        }
//                    }


//

                    return view('investigation.view-investigation-index',compact('patient','title','results','departments','img','uniqueItems','ipNo','typical'));

                break;

                case 'IP':


                    $reg_no = $db_ext->table('admission_main')
                        ->where('encounter_no',$request['registration_no'])->first();

                    $departments = $db_ext->table('department_sub')->where('Status','A')->get();
                    $patient = $db_ext->table('patient_registration')->where('registration_no',$reg_no->registration_no)->first();
                    $title = $db_ext->table('title_master')->where('title_id',$patient->title_id)->first();

                    $lab_regs = $db_ext->table('investigation_sample')
                        ->where('encounter_no',$request['registration_no'])
                        ->distinct()
                        ->get(['lab_regno','sample_collect_date']);

//                    dd($lab_regs);

//                    dd($lab_regs);



                    $ipNo = $request['registration_no'];
                    $unique_lab_reg = null;


//                    $services = $db_ext->table('item_of_service i')
//                        ->join('investigation_normal_result r','i.service_code','=','r.Service_code')
//                        ->where('Status','A')
//                        ->where('r.lab_regno',$reg->lab_regno)
//                        ->get();

//                    dd($lab_regs);




                    $results = collect();

                    foreach ($lab_regs as $reg)
                    {

                        $data = $db_ext->table('investigation_normal_result as r')
                            ->select('r.encoded_date','r.service_code','s.Service_Name','r.sub_department_code','sd.sub_name',
                                'r.result','r.Unit_code', 'u.Unit_name','r.min_value', 't.sub_name as final_name', 'r.id',
                                'r.max_value','r.symbol','r.lab_regno','s.Profile','r.sample_collect_date','r.result_date')
                            ->join('item_of_service as s','r.service_code','=','s.Service_code')
                            ->join('department_sub as sd', 'r.sub_department_code', '=','sd.sub_code')
                            ->join('Unit_Lab_Master  as u','r.Unit_code', '=','u.unit_code')
                            ->join('investigation_normal_reading1 as t','t.id','=','r.id')
                            ->where('r.lab_regno',$reg->lab_regno)
                            ->orderBy('r.lab_regno')
                            ->get();

                        if(count($data) > 0)
                        {
                            $results = $results->merge($data);
                        }
                    }


                    $img = count($results) > 0 ? 1 : 0;

                    $uniqueItems = $results->unique('service_code');

//                    dd($results);


                    $typical = collect();

                    foreach ($lab_regs as $reg)
                    {

                        $data1 = $db_ext->table('investigation_typical_result as r')
                            ->select('r.encoded_date','r.service_code','s.Service_Name','r.sub_department_code','sd.sub_name',
                                'r.FORMATHTML','r.lab_regno','r.sample_collect_date','r.result_date')
                            ->join('item_of_service as s','r.service_code','=','s.Service_code')
                            ->join('department_sub as sd', 'r.sub_department_code', '=','sd.sub_code')
                            ->where('r.lab_regno',$reg->lab_regno)->get();

                        $data1->map(function ($data1) {
                            $data1->FORMATHTML = str_replace('\t\t:', 'Blank', $data1->FORMATHTML);

                        return $data1;
                    });


                        if(!is_null($data1))
                        {
                            $typical = $typical->merge($data1);
                        }
                    }

                    return view('investigation.view-investigation-index',compact('patient','title','results','departments','img','uniqueItems','ipNo','typical','lab_regs'));

                break;

            }
        }

        return view('investigation.view-investigation-index',compact('results','img','patients'));
    }


    public function viewResult($id)
    {






        $db_ext = DB::connection('sqlsrv');


        $reg_no = $db_ext->table('admission_main')
            ->where('registration_no',$id)->whereIn('PATAD_TYPE',['A','T'])->first();

        $departments = $db_ext->table('department_sub')->where('Status','A')->get();
        $patient = $db_ext->table('patient_registration')->where('registration_no',$id)->first();
        $title = $db_ext->table('title_master')->where('title_id',$patient->title_id)->first();

        $lab_regs = $db_ext->table('investigation_sample')
            ->where('encounter_no',$reg_no->encounter_no)
            ->distinct()
            ->get(['lab_regno','sample_collect_date']);

        $ipNo = $reg_no->encounter_no;
        $unique_lab_reg = null;


        $results = collect();

        foreach ($lab_regs as $reg)
        {

            $data = $db_ext->table('investigation_normal_result as r')
                ->select('r.encoded_date','r.service_code','s.Service_Name','r.sub_department_code','sd.sub_name',
                    'r.result','r.Unit_code', 'u.Unit_name','r.min_value', 't.sub_name as final_name', 'r.id',
                    'r.max_value','r.symbol','r.lab_regno','s.Profile','r.sample_collect_date','r.result_date')
                ->join('item_of_service as s','r.service_code','=','s.Service_code')
                ->join('department_sub as sd', 'r.sub_department_code', '=','sd.sub_code')
                ->join('Unit_Lab_Master  as u','r.Unit_code', '=','u.unit_code')
                ->join('investigation_normal_reading1 as t','t.id','=','r.id')
                ->where('r.lab_regno',$reg->lab_regno)
                ->orderBy('r.lab_regno')
                ->get();

            if(count($data) > 0)
            {
                $results = $results->merge($data);
            }
        }


        $img = count($results) > 0 ? 1 : 0;

        $uniqueItems = $results->unique('service_code');

//                    dd($results);


        $typical = collect();

        foreach ($lab_regs as $reg)
        {

            $data1 = $db_ext->table('investigation_typical_result as r')
                ->select('r.encoded_date','r.service_code','s.Service_Name','r.sub_department_code','sd.sub_name',
                    'r.FORMATHTML','r.lab_regno','r.sample_collect_date','r.result_date')
                ->join('item_of_service as s','r.service_code','=','s.Service_code')
                ->join('department_sub as sd', 'r.sub_department_code', '=','sd.sub_code')
                ->where('r.lab_regno',$reg->lab_regno)->get();

            $data1->map(function ($data1) {
                $data1->FORMATHTML = str_replace('\t\t:', 'Blank', $data1->FORMATHTML);

                return $data1;
            });


            if(!is_null($data1))
            {
                $typical = $typical->merge($data1);
            }
        }



        //GET CBC REPORT

        $db_ext_ora = DB::connection('oracle');

        $cbc_array = $db_ext_ora->select("select BI.V_PAT_ID, BI.N_RPT_ID, BI.D_BILL_DT, BI.V_SMPL_NO, BI.V_LAB_NO,
                    ER.V_RPT_PAR, ER.V_MACHINE_PAR, ER.V_RESULT, ER.V_MACHINE_RESULT, ER.V_MU, ER.V_REF_VAL, 
                    EPG.N_PAR_GRP_ID, EPG.V_PAR_GRP, EPG.N_PAR_GRP_SL, ER.N_PAR_SL from BILL_INFO BI
                    inner join EXAM_RESULT ER on ER.N_RPT_ID = BI.N_RPT_ID and ER.N_SHOW_FLAG=1
                    inner join EXAM_PAR_GRP EPG on EPG.N_PAR_GRP_ID = ER.N_PAR_GRP_ID and BI.V_MACHINE_NAME=EPG.V_MACHINE_NAME
                    WHERE BI.V_PAT_ID= ?
                    ORDER BY EPG.N_PAR_GRP_SL, ER.N_PAR_SL ASC",[$ipNo]);


        $cbc_result = collect($cbc_array);


        $lab_dates = $cbc_result->unique('n_rpt_id');

        // END CBC REPORT



        return view('investigation.view-investigation-result',compact('patient','title','results','departments','img','uniqueItems','ipNo','typical','lab_regs','cbc_result','lab_dates'));

    }


    public function viewResultByIP(Request $request)
    {

        if($request->filled('ip_no'))
        {
            $db_ext = DB::connection('sqlsrv');


            $reg_no = $db_ext->table('admission_main')
                ->where('encounter_no',$request['ip_no'])->first();

            $departments = $db_ext->table('department_sub')->where('Status','A')->get();
            $patient = $db_ext->table('patient_registration')->where('registration_no',$reg_no->registration_no)->first();
            $title = $db_ext->table('title_master')->where('title_id',$patient->title_id)->first();

            $lab_regs = $db_ext->table('investigation_sample')
                ->where('encounter_no',$reg_no->encounter_no)
                ->distinct()
                ->get(['lab_regno','sample_collect_date']);

            $ipNo = $reg_no->encounter_no;
            $unique_lab_reg = null;


            $results = collect();

            foreach ($lab_regs as $reg)
            {

                $data = $db_ext->table('investigation_normal_result as r')
                    ->select('r.encoded_date','r.service_code','s.Service_Name','r.sub_department_code','sd.sub_name',
                        'r.result','r.Unit_code', 'u.Unit_name','r.min_value', 't.sub_name as final_name', 'r.id',
                        'r.max_value','r.symbol','r.lab_regno','s.Profile','r.sample_collect_date','r.result_date')
                    ->join('item_of_service as s','r.service_code','=','s.Service_code')
                    ->join('department_sub as sd', 'r.sub_department_code', '=','sd.sub_code')
                    ->join('Unit_Lab_Master  as u','r.Unit_code', '=','u.unit_code')
                    ->join('investigation_normal_reading1 as t','t.id','=','r.id')
                    ->where('r.lab_regno',$reg->lab_regno)
                    ->orderBy('r.lab_regno')
                    ->get();

                if(count($data) > 0)
                {
                    $results = $results->merge($data);
                }
            }


            $img = count($results) > 0 ? 1 : 0;

            $uniqueItems = $results->unique('service_code');

//                    dd($results);


            $typical = collect();

            foreach ($lab_regs as $reg)
            {

                $data1 = $db_ext->table('investigation_typical_result as r')
                    ->select('r.encoded_date','r.service_code','s.Service_Name','r.sub_department_code','sd.sub_name',
                        'r.FORMATHTML','r.lab_regno','r.sample_collect_date','r.result_date')
                    ->join('item_of_service as s','r.service_code','=','s.Service_code')
                    ->join('department_sub as sd', 'r.sub_department_code', '=','sd.sub_code')
                    ->where('r.lab_regno',$reg->lab_regno)->get();

                $data1->map(function ($data1) {
                    $data1->FORMATHTML = str_replace('\t\t:', 'Blank', $data1->FORMATHTML);

                    return $data1;
                });


                if(!is_null($data1))
                {
                    $typical = $typical->merge($data1);
                }
            }

            return view('investigation.view-investigation-result',compact('patient','title','results','departments','img','uniqueItems','ipNo','typical','lab_regs'));

        }

        return true;

    }


    public function summary(Request $request)
    {

        $ipd = null;
        $opd = null;

        if(!empty($request['doctor_id']))
        {
            $doctor_id = Hresource::query()->where('id',$request['doctor_id'])->first();
            $fromDate = Carbon::createFromFormat('d-m-Y H:i:s',$request['from_date'].' 00:00:01')->format('Y-m-d H:i:s');
            $toDate = Carbon::createFromFormat('d-m-Y H:i:s',$request['to_date'].' 23:59:59')->format('Y-m-d H:i:s');

//            $doctor_id = get_doctor_external_id($request['doctor_id']));

            $db_ext = DB::connection('sqlsrv');

            $ipd =  $db_ext->select("select s.consultant_code, s.service_code, p.Service_Name, count(s.service_code) count_no
                        from investigation_sample s
                        inner join item_of_service p on p.Service_code = s.service_code
                        where s.consultant_code = '$doctor_id->external_id' and s.encoded_date between '$fromDate' and '$toDate' and s.status = 'A'
                        group by s.consultant_code, s.service_code, p.Service_Name
                        order by p.Service_Name;");


//            $opd =  $db_ext->select("select s.consultant_code, s.service_code, p.Service_Name, count(s.service_code) count_no
//                        from investigation_sample_op s
//                        inner join item_of_service p on p.Service_code = s.service_code
//                        where s.consultant_code = '$doctor_id->external_id' and s.encoded_date between '$fromDate' and '$toDate' and s.status = 'A'
//                        group by s.consultant_code, s.service_code, p.Service_Name
//                        order by p.Service_Name;");

            $data = $db_ext->select("select bm.consultant_code, p.Sub_Dept_Code, sd.sub_name, bd.service_code, p.Service_Name, sum(bd.no_of_test) count_no, sum(bd.amount_payableby_patient) payable  
                        from opd_bill_detail bd
                        join OPD_Bill_Main bm on bm.Bill_ID = bd.Bill_ID
                        join item_of_service p on p.Service_code = bd.service_code
                        join department_sub sd on sd.sub_code = p.Sub_Dept_Code
                        where bd.encoded_date between '$fromDate' and '$toDate' and bd.status = 'A'
                        and bm.consultant_code = '$doctor_id->external_id' and p.Sub_Dept_Code not in(298,10,248,283,43,25,277)
                        group by bm.consultant_code, p.Sub_Dept_Code, sd.sub_name, bd.service_code, p.Service_Name
                        order by sd.sub_name, p.Service_Name;");

            $opd = collect();

            foreach ($data as $row)
            {
                $opd->push($row) ;
            }


            $sub_dpt = $opd->unique('Sub_Dept_Code');



//            $results = Collect();
//
//            foreach ($ipd as $ip)
//            {
//                foreach ($opd as $op)
//                {
//                    if($ip->service_code == $op->service_code)
//                    {
//                        $item['service_code'] = $ip->service_code;
//                        $item['service_name'] = $ip->Service_Name;
//                        $item['count_no'] = $ip->count_no;
//                        $request->save($item);
//
//                    }
//                }
//            }

//            $data = $opd;

            switch ($request['action'])
            {
                case 'preview':

                    return view('investigation.view-summary-report',compact('ipd','opd'));
                    break;

                case 'print':

                    $view = \View::make('investigation.print.doctor-investigation-summary', compact('ipd','opd','fromDate','toDate','sub_dpt','doctor_id'));
                    $html = $view->render();

                    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A4', true, 'UTF-8', false);

                    $pdf::SetMargins(20, 5, 5,0);

                    $pdf::AddPage();

                    $pdf::writeHTML($html, true, false, true, false, '');
                    $pdf::Output('invest.pdf');

                    break;
            }
        }


        return view('investigation.view-summary-report',compact('ipd','opd'));
    }
}
