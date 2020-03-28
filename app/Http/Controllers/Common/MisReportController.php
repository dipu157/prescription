<?php

namespace App\Http\Controllers\Common;

use App\Models\TempReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MisReportController extends Controller
{
    public function index()
    {

        $db_ext = DB::connection('sqlsrv');

        $data =  $db_ext->select("select * from
                                (select hs.specialisation, hs.Specialisation_name, hs.Doctor_code, hs.doctor_name,  hs.department_code, hs.department_name, (hs.amount+ isnull(ot.amount,0)) total
                                    from
                                (select dc.specialisation, sp.Specialisation_name, dc.doctor_code, dc.doctor_name,  dpt.department_code, dpt.department_name,
                                    sum(cdh.patient_collectable) amount
                                from admission_main ad
                                join doctor_main dc on dc.Doctor_code = ad.consulting_doctor
                                join specialisation_master sp on sp.Specialisation_code = dc.specialisation
                                join ip_Chargeslip_main_History chm on (ad.encounter_no = chm.encounter_no)
                                join ip_Chargeslip_detail_History cdh on chm.charge_slip_no = cdh.charge_slip_no
                                join department_main dpt on dpt.department_code = cdh.dept_code
                                join INVOICE inv on inv.invoiceid=chm.invoiceid  
                                where cdh.status = 'A'
                                and CONVERT(VARCHAR, Inv.invoice_date,111) between '2019/04/01'  and '2019/04/30'
                                and chm.status = 'A'
                                group by dc.specialisation, sp.Specialisation_name, dc.doctor_code, dc.doctor_name, dpt.department_code, dpt.department_name) hs
                                full outer join
                                (select dc.specialisation, sp.Specialisation_name, dc.doctor_code, dc.doctor_name, dpt.department_code, dpt.department_name,
                                    sum(cdh.patient_collectable) amount
                                from admission_main ad
                                join doctor_main dc on dc.Doctor_code = ad.consulting_doctor
                                join specialisation_master sp on sp.Specialisation_code = dc.specialisation
                                join ip_Chargeslip_main chm on ad.encounter_no = chm.encounter_no
                                join ip_Chargeslip_detail cdh on chm.charge_slip_no = cdh.charge_slip_no
                                join department_main dpt on dpt.department_code = cdh.dept_code
                                join INVOICE inv on inv.invoiceid=chm.invoiceid
                                where cdh.status = 'A'
                                and CONVERT(VARCHAR, Inv.invoice_date,111) between '2019/04/01'  and '2019/04/30' and chm.status = 'A'
                                group by dc.specialisation, sp.Specialisation_name, dc.doctor_code, dc.doctor_name, dpt.department_code, dpt.department_name) ot
                                on hs.specialisation = ot.specialisation and hs.department_code = ot.department_code and hs.doctor_code = ot.Doctor_code
                                union all
                                select specialisation, Specialisation_name, Doctor_code, doctor_name, department_code, department_name, sum(amount) amount  from
                                (
                                select dc.specialisation, sp.Specialisation_name, dc.Doctor_code, dc.doctor_name,  1120 department_code, 'PHARMACY' department_name,
                                    sum(case when chm.Type = 'R' then chm.Net_Amt*(-1) else chm.Net_Amt end) amount
                                from admission_main ad
                                join doctor_main dc on dc.Doctor_code = ad.consulting_doctor
                                join specialisation_master sp on sp.Specialisation_code = dc.specialisation
                                join Issue_In_Patient_P chm on ad.encounter_no = chm.encounter_no
                                join INVOICE inv on inv.encounter_no=chm.Encounter_No
                                and CONVERT(VARCHAR, Inv.invoice_date,111) between '2019/04/01'  and '2019/04/30'
                                group by dc.specialisation, sp.Specialisation_name, dc.doctor_code, dc.doctor_name, department_code
                                union all
                                select dc.specialisation, sp.Specialisation_name, dc.Doctor_code, dc.doctor_name,  1120 department_code, 'PHARMACY' department_name,
                                    sum(case when chm.Type = 'R' then chm.Net_Amt*(-1) else chm.Net_Amt end) amount
                                from admission_main ad
                                join doctor_main dc on dc.Doctor_code = ad.consulting_doctor
                                join specialisation_master sp on sp.Specialisation_code = dc.specialisation
                                join Issue_In_Patient_P_History chm on (ad.encounter_no = chm.encounter_no)
                                join INVOICE inv on inv.encounter_no=chm.Encounter_No
                                and CONVERT(VARCHAR, Inv.invoice_date,111) between '2019/04/01'  and '2019/04/30'
                                group by dc.specialisation, sp.Specialisation_name, dc.Doctor_code, dc.doctor_name, department_code) ph
                                group by specialisation, Specialisation_name, Doctor_code, doctor_name, department_code, department_name) final
                                where specialisation is not null
                                order by Specialisation_name, doctor_name");


        foreach ($data as $row)
        {
            DB::Table('temp_reports')->insert([
                'dt_col1'=>'2019-04-30',
                'v_col1'=>'IPD',
                'v_col2'=>$row->Specialisation_name,
                'v_col3'=>$row->doctor_name,
                'v_col4'=>$row->department_name,
                'n_co1'=>$row->specialisation,
                'n_co2'=>$row->Doctor_code,
                'n_co3'=>$row->department_code,
                'n_co4'=>$row->total,
            ]);
        }




        $opd =  $db_ext->select("select dc.specialisation, sp.Specialisation_name, m.consultant_code, dc.doctor_name, md.department_code, md.department_name,
                        sum(d.amount_payableby_patient) amount  
                    from opd_bill_detail d 
                    join OPD_Bill_Main m on m.Bill_ID = d.Bill_ID
                    join department_sub sd on sd.sub_code = d.sub_department_code
                    join department_main md on md.department_code = sd.department_code
                    join doctor_main dc on dc.Doctor_code = m.consultant_code
                    join specialisation_master sp on sp.Specialisation_code = dc.specialisation
                    where CONVERT(VARCHAR, m.bill_date,111) between '2019/04/01'  and '2019/04/30'  
                    and d.status = 'A' and m.consultant_code is not null
                    group by dc.specialisation,sp.Specialisation_name, m.consultant_code, dc.doctor_name, md.department_code, md.department_name");



        foreach ($opd as $row)
        {

            $count = DB::table('temp_reports')->where('n_co1',$row->specialisation)
                ->where('dt_col1','2019-04-30')
                ->where('n_co2',$row->consultant_code)->where('n_co2',$row->department_code)->count();

            if($count > 0)
            {
                DB::Table('temp_reports')
                    ->where('n_co1',$row->specialisation)
                    ->where('dt_col1','2019-04-30')
                    ->where('n_co2',$row->consultant_code)->where('n_co2',$row->department_code)
                    ->update([
                    'n_co5'=>$row->amount
                ]);
            }

            if($count == 0)
            {
                DB::Table('temp_reports')->insert([
                    'dt_col1'=>'2019-04-30',
                    'v_col1'=>'OPD',
                    'v_col2'=>$row->Specialisation_name,
                    'v_col3'=>$row->doctor_name,
                    'v_col4'=>$row->department_name,
                    'n_co1'=>$row->specialisation,
                    'n_co2'=>$row->consultant_code,
                    'n_co3'=>$row->department_code,
                    'n_co5'=>$row->amount,
                ]);
            }


        }



//        OPD CONSULTATION FEE UPDATE


        $opd =  $db_ext->select("select dc.specialisation, sp.Specialisation_name, cl.DoctorCode, dc.doctor_name, sum(cl.ChargesAmount) amount
                                from Hp_OPD_DoctorC_Collection cl
                                join doctor_main dc on dc.Doctor_code = cl.DoctorCode
                                join specialisation_master sp on sp.Specialisation_code = dc.specialisation 
                                where cl.CollectionDate between '2019-04-01' and '2019-04-30'
                                and cl.status = 'A'
                                group by dc.specialisation, sp.Specialisation_name, cl.DoctorCode, dc.doctor_name");


        foreach ($opd as $row)
        {

            $count = DB::table('temp_reports')
                ->where('n_co2',$row->DoctorCode)->where('n_co3',39)
                ->where('dt_col1','2019-04-30')->count();

            if($count > 0)
            {
                DB::Table('temp_reports')
                    ->where('n_co2',$row->DoctorCode)->where('n_co3',39)
                    ->where('dt_col1','2019-04-30')
                    ->update([
                        'n_co5'=>$row->amount
                    ]);
            }

            $doctor = DB::table('temp_reports')->where('n_co2',$row->DoctorCode)->first();

            if($count == 0)
            {
                DB::Table('temp_reports')->insert([
                    'dt_col1'=>'2019-04-30',
                    'v_col1'=>'OPD',
                    'v_col2'=>$row->Specialisation_name,
                    'v_col3'=>$row->doctor_name,
                    'v_col4'=>'CONSULTATION FEES',
                    'n_co1'=>$row->specialisation,
                    'n_co2'=>$row->DoctorCode,
                    'n_co3'=>39,
                    'n_co5'=>$row->amount,
                ]);
            }


        }


        dd('Complete');
    }
}
