<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Khill\Lavacharts\Lavacharts;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role_id != 1)
        {
            $finances = \Lava::DataTable();

            $finances->addColumns(array(array('string', 'Date'), array('number', 'Appointments'), array('number', 'Visited')));
            $days_ago = date('Y-m-d', strtotime('-5 days', strtotime(Carbon::now())));
            $today = Carbon::now()->format('Y-m-d');

            $data = Appointment::query()
                ->select(array('appointment_date', DB::raw('COUNT(id) as appoint'), DB::raw('COUNT(IF(status=0, 1, NULL)) as visited')))
                ->whereBetween('appointment_date',[$days_ago,$today])
                ->where('doctor_id',get_doctor_external_id(Auth::user()->attached))
                ->groupBy('appointment_date')->get();

//            echo($data);

            foreach ($data as $row)
            {
                $rowData = array(Carbon::parse($row->appointment_date)->format('d-m-Y'), $row->appoint, $row->visited);
                $finances->addRow($rowData);
            }

            \Lava::ColumnChart('Finances', $finances, [
                'title' => 'Daily Status',
                'titleTextStyle' => [
                    'color'    => '#eb6b2c',
                    'fontSize' => 14
                ]
            ]);
        }

        return view('dashboard');
    }

}
