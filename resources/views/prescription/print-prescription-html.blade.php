@extends('layouts.master')

@section('pagetitle')
    <h2 class="no-margin-bottom">Prescription Preview</h2>
@endsection
@section('content')

    <style>
        table.table {
            width:100%;
            margin:0;
            background-color: #ffffff;
        }

        table.order-bank {
            width:100%;
            margin:0;
        }
        table.order-bank th{
            padding:5px;
        }
        table.order-bank td {
            padding:5px;
            background-color: #ffffff;
        }
        tr.row-line th {
            border-bottom-width:1px;
            border-top-width:1px;
            border-right-width:1px;
            border-left-width:1px;
        }
        tr.row-line td {
            border-bottom:none;
            border-bottom-width:1px;
            font-size:10pt;
        }
        th.first-cell {
            text-align:left;
            border:1px solid red;
            color:blue;
        }
        div.order-field {
            width:100%;
            backgroundr: #ffdab9;
            border-bottom:1px dashed black;
            color:black;
        }
        div.blank-space {
            width:100%;
            height: 50%;
            margin-bottom: 100px;
            line-height: 10%;
        }
    </style>

    <div class="row">
        <!--  form area -->
        <div class="col-sm-12">
            <div  class="panel panel-default thumbnail">

                <div class="panel-heading no-print">
                    <div class="btn-group">
                        <a class="btn btn-primary" href="{!! url('doctor/prescriptionlist') !!}"> <i class="fa fa-list"></i>  Prescription List </a>
                        <button type="button" onclick="printDiv()" class="btn btn-danger" ><i class="fa fa-print"></i></button>
                    </div>
                </div>


                <div class="row" id="printpage">
                    <!--  form area -->
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- Headline -->
                                <table class="table-striped">
                                    <thead>
                                    <tr style="width: 300%">
                                        <td width="10%" style="font-size:8pt; color:black; "><strong>Date</strong></td>
                                        <td width="5%" style="font-size:8pt; color:black; "><strong>:</strong></td>
                                        <td width="50%" style="font-size:8pt; color:black; "><strong>{!! \Carbon\Carbon::parse($prescription->record_date)->format('d-M-Y')  !!}</strong></td>
                                        <td width="10%" style="font-size:8pt; color:black; "><strong>Age</strong></td>
                                        <td width="5%" style="font-size:8pt; color:black; "><strong>:</strong>  </td>
                                        <td width="20%" style="font-size:8pt; color:black; "><strong>{!! $patient->age !!}Y</strong></td>
                                    </tr>

                                    <tr style="width: 300%">
                                        <td width="10%" style="font-size:8pt; color:black; "><strong>ID</strong></td>
                                        <td width="5%" style="font-size:8pt; color:black; "><strong>:</strong></td>
                                        <td width="50%" style="font-size:8pt; color:black; "><strong>{!! $patient->registration_no !!}</strong></td>
                                        <td width="10%" style="font-size:8pt; color:black; "><strong>Gender</strong></td>
                                        <td width="5%" style="font-size:8pt; color:black; "><strong>:</strong>  </td>
                                        <td width="20%" style="font-size:8pt; color:black; "><strong>{!! $patient->gender == 'M' ? 'Male' : 'Female' !!}</strong></td>
                                    </tr>
                                    <tr style="width: 300%">
                                        <td width="10%" style="font-size:8pt; color:black; "><strong>Name</strong></td>
                                        <td width="5%" style="font-size:8pt; color:black; "><strong>:</strong></td>
                                        <td width="50%" style="font-size:8pt; color:black; "><strong>{!! $patient->name !!}</strong></td>
                                        <td width="10%" style="font-size:8pt; color:black; "><strong>Mobile</strong></td>
                                        <td width="5%" style="font-size:8pt; color:black; "><strong>:</strong>  </td>
                                        <td width="20%" style="font-size:8pt; color:black; "><strong>{!! $patient->mobile !!}</strong></td>
                                    </tr>

                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                    <table class="table-striped">
                        <tbody>
                        <tr>
                            <td width="30%" style="font-size:8pt; color:black; ">Chief Complaints: {!! $prescription->complains !!}<br/>
                                Currenr Medicine: {!! $prescription->current_medication !!}<br/>
                            </td>

                            <td width="70%">
                                <table class="table-striped">
                                    <thead>
                                    <tr class="row-line">
                                        <th colspan="6" class="row-line" style="font-size: 10pt; line-height: 230%">Medicine</th>
                                    </tr>
                                    <tr class="row-line" style="line-height: 230%">
                                        <th width="5%" style="font-size:8pt; color:black; ">SL</th>
                                        <th colspan="3" width="60%" style="font-size:8pt; color:black; ">Name</th>
                                        <th width="15%" style="font-size:8pt; color:black; ">Dose</th>
                                        <th width="20%" style="font-size:8pt; color:black; ">Instruction</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($prescription->amedicine))
                                        @foreach($prescription->amedicine as $i=>$item)
                                            <tr style="line-height: 230%">

                                                <td style="font-size:8pt; color:black; ">{!! $i+1 !!}</td>
                                                <td width="13%" style="font-size:8pt; color:black; ">{!! $item->medicine->mtype->name !!}</td>
                                                <td width="32%" style="font-size:8pt; color:black; ">{!! $item->medicine->name !!}</td>
                                                <td width="15%" style="font-size:8pt; color:black; ">{!! $item->strength !!}</td>
                                                <td style="font-size:8pt; color:black; ">{!! $item->dose !!}</td>
                                                <td style="font-size:8pt; color:black; ">{!! $item->advice !!}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                    <div class="blank-space"></div>

                    <table class="table-striped">
                        <tbody>
                        <tr>
                            <td width="30%" style="font-size:8pt; color:black; ">Weight: {!! $prescription->weight !!}kg<br/>
                                BP: {!! $prescription->bp !!}<br/>
                                Suger: {!! $prescription->sugar !!}<br/>
                                Temp : {!! $prescription->temperature !!}<br/>
                                Pulse : {!! $prescription->pulse !!}
                            </td>

                            <td width="70%">
                                <table class="table-striped">
                                    <thead>
                                    <tr class="row-line">
                                        <th colspan="6" class="row-line" style="font-size: 10pt; line-height: 230%">Diagnosis</th>
                                    </tr>
                                    <tr class="row-line" style="line-height: 230%">
                                        <th width="5%" style="font-size:8pt; color:black; ">SL</th>
                                        <th width="50%" style="font-size:8pt; color:black; ">Name</th>
                                        <th width="45%" style="font-size:8pt; color:black; ">Instruction</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($prescription->adiagnosis))
                                        @foreach($prescription->adiagnosis as $i=>$test)
                                            <tr style="line-height: 230%">

                                                <td style="font-size:8pt; color:black; ">{!! $i+1 !!}</td>
                                                <td style="font-size:8pt; color:black; ">{!! $test->diagnosis->name !!}</td>
                                                <td style="font-size:8pt; color:black; ">{!! $test->remarks !!}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        <div class="blank-space"></div>
                        <div class="blank-space"></div>
                        <div class="blank-space"></div>

                        <tr>
                            <td width="30%">
                            </td>

                            <td width="70%">
                                <table class="table-striped">
                                    <thead>
                                    <tr class="row-line">
                                        <th colspan="6" class="row-line" style="font-size: 10pt; line-height: 230%">General Advice</th>
                                    </tr>
                                    <tr class="row-line" style="line-height: 230%">
                                        <th width="10%" style="font-size:8pt; color:black; ">SL</th>
                                        <th width="90%" style="font-size:8pt; color:black; ">Advice</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($prescription->gadvice))
                                        @foreach($prescription->gadvice as $i=>$advs)
                                            <tr style="line-height: 230%">

                                                <td style="font-size:8pt; color:black;">{!! $i+1 !!}</td>
                                                <td style="font-size:8pt; color:black; "><font face="SolaimanLipi_20-04-07">{!! $advs->advice !!}</font> </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </td>
                        </tr>

                        </tbody>
                    </table>

                    <div class="blank-space"></div>
                    <div class="blank-space"></div>
                    <div class="blank-space"></div>
                    <div class="blank-space"></div>
                    <div class="blank-space"></div>
                    <div class="blank-space"></div>

                    <table class="table-striped">

                        <tbody>
                        <tr>
                            <td width="60%"></td>
                            <td width="40%" style="font-size:10pt; color:black; ">{!! $prescription->doctor->name !!}</td>
                        </tr>
                        <tr>
                            <td width="60%"></td>
                            <td width="40%" style="font-size:10pt; color:black; ">{!! $prescription->doctor->education !!}</td>
                        </tr>

                        </tbody>
                    </table>
                </div>


                <script>
                    function printDiv()
                    {


                        var newstr=document.getElementById("printpage").innerHTML;

                        var header='<header><div align="center"><h3 style="color:#EB5005"> Your HEader </h3></div><br></header><hr><br>'

//        var footer ="Your Footer";

                        //You can set height width over here
                        var popupWin = window.open('', '_blank', 'width=720,height=326');
                        popupWin.document.open();
                        popupWin.document.write('<link rel="stylesheet" href="{!! asset('assets/bootstrap-4.1.3/css/bootstrap.min.css') !!}" type="text/css" />');
                        popupWin.document.write('<html> <body onload="window.print()">'+ newstr + '</html>');
//        popupWin.document.write('<html> <body onload="window.print()">'+ newstr + '</html>' + footer);
                        popupWin.document.close();
                        return false;


                    }
                </script>


            </div>
        </div>
    </div>

@endsection

@push('scripts')

    <script>
        function printDiv()
        {


            var newstr=document.getElementById("printpage").innerHTML;

            var header='<header><div align="center"><h3 style="color:#EB5005"> Your HEader </h3></div><br></header><hr><br>'

//        var footer ="Your Footer";

            //You can set height width over here
            var popupWin = window.open('', '_blank', 'width=720,height=326');
            popupWin.document.open();
            popupWin.document.write('<link rel="stylesheet" href="{!! asset('assets/bootstrap-4.1.3/css/bootstrap.min.css') !!}" type="text/css" />');
            popupWin.document.write('<html> <body onload="window.print()">'+ newstr + '</html>');
//        popupWin.document.write('<html> <body onload="window.print()">'+ newstr + '</html>' + footer);
            popupWin.document.close();
            return false;


        }
    </script>
@endpush

