@extends('layouts.master')

@section('pagetitle')
    <h2 class="no-margin-bottom">Prescription Priview : Template for {!! \Illuminate\Support\Facades\Auth::user()->name !!}</h2>
@endsection
@section('content')


    <script type="text/javascript" src="{!! asset('assets/js/jquery-3.3.1.min.js') !!}"></script>

    <div class="row">
        <!--  form area -->
        <div class="col-sm-12">
            <div  class="panel panel-default thumbnail">

                <div class="panel-heading no-print">
                    <div class="btn-group">
                        <a class="btn btn-primary" href="{!! URL::previous() !!}"> <i class="fa fa-list"></i> Back </a>
                        <button type="button" onclick="printDiv()" class="btn btn-danger" ><i class="fa fa-print"></i></button>
                    </div>
                </div>

                <div class="panel-body">

                    <div id="printpage">


                        <div style="position: relative; width: 100%; height: 30px"></div>

                        <div class="text-center">
                            <img src="{!! isset($prescription->image) ? asset($prescription->image) : ($prescription->patient->gender == 'M' ? asset('images/male.jpeg') : asset('images/female.png'))  !!}" width="150px" height="150px" class="rounded" alt="..">
                        </div>

                    <div style="position: relative; width: 100%; height: 140px"></div>

                        <div class="row">
                            <div class="container-fluid">

                                <table class="table table-striped" id="report">
                                    <thead>

                                    <tr style="line-height: 60%; margin-top: 10px;">
                                        
                                        <td></td>
                                        <td></td>
                                        <td style="font-size:12pt; color:black;"><strong>UHID : {!! $patient->registration_no !!}</strong></td>
                                        
                                        
                                    </tr>

                                    <tr style="line-height: 60%; margin-top: 20px;">
                                        <td style="font-size:12pt; color:black; "><strong>Date : {!! \Carbon\Carbon::parse($prescription->record_date)->format('d-M-Y')  !!}</strong></td>

                                        <td style="font-size:12pt; color:black; "><strong>Name : {!! $patient->name !!}</strong></td>
                                    
                                        <td style="font-size:12pt; color:black; "><strong>Age : {!! $patient->age !!}Y</strong></td>

                                        <td style="font-size:12pt; color:black; "><strong>Weight : {!! $prescription->weight !!} Kg</strong></td>

                                        <td style="font-size:12pt; color:black; "><strong>BSA : {!! $prescription->bsa !!}_______ M^2</strong></td>
                                        
                                        
                                    </tr>


                                    <tr style="line-height: 60%">
                                        
                                        <td style="font-size:12pt; color:black; "><strong>Pulse : {!! $prescription->pulse !!}</strong></td>

                                        <td style="font-size:12pt; color:black; "><strong>BP : {!! $prescription->bp !!}</strong></td>

                                        <td style="font-size:12pt; color:black; "><strong>O2SAT : {!! $prescription->o2sat !!} %</strong></td>

                                        <td style="font-size:12pt; color:black; "><strong>Mobile : {!! $patient->mobile !!}</strong></td>
                                    </tr>

                                    </thead>
                                </table>

                                <!-- <div style="position: relative; width: 100%; height: 10px"></div> -->

                                <div style="float:left;width:100%;border-right:1px solid #e4e5e7;padding-right:10px">

                                    <!-- <div style="position: relative; width: 25%; height: 10px"></div> -->

                                    <table class="table table-striped" width="100%">
                                        <thead>

                                        <tr style="width: 100%">
                                            <td colspan="3" width="15%" style="font-size:12pt; color:black; "><strong><u>Diagnosis</u></strong></td>
                                            <td width="1%" style="font-size:12pt; color:black; "><strong>:</strong></td>
                                            <td colspan="3" width="75%" style="font-size:12pt; color:black; ">{!! nl2br(e($prescription->diagnosis)) !!}</td>
                                        </tr>

                                        <tr style="width: 100%">
                                            <td colspan="3" width="15%" style="font-size:12pt; color:black; "><strong><u>Current Status</u></strong></td>
                                            <td width="1%" style="font-size:12pt; color:black; "><strong>:</strong></td>
                                            <td colspan="3" width="75%" style="font-size:12pt; color:black; ">{!! nl2br(e($prescription->complains)) !!}</td>
                                        </tr>

                                        </thead>
                                    </table>
                                </div>

                                <div style="float: left;width: 20%">
                                    <tr style="width: 100%">
                                            <td colspan="3" width="75%" style="font-size:12pt; color:black; "><strong><b>Follow Up (On Appointment):</b></strong></td>

                                        </tr>
                                        <tr style="width: 100%">
                                            <td colspan="3" width="75%" style="font-size:12pt; color:black; ">{!! $prescription->remarks !!}</td>
                                        </tr>

                                        @foreach($investigations as $j=>$line)
                                            <tr>

                                                <td colspan="3" width="75%" style="font-size:12pt; color:black; ">{!! $line->invest !!}</td>

                                            </tr>
                                        @endforeach
                                </div>


                                <div style="float:left;width:80%;padding-left:10px">
                                    

                                    <div class="avatar"><img src="{!! asset('images/rx.png') !!}" width="50px" height="50px" alt="..." class="img-fluid rounded-circle"></div>
                                    <!-- Medicine -->
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th style="border:1px solid #000;" width="5%">SL</th>
                                            <th style="border:1px solid #000;" width="34%">Medicine Name</th>
                                            <th style="border:1px solid #000;" width="10%">Type</th>
                                            <th style="border:1px solid #000;" width="13%%">Dose</th>
                                            <th style="border:1px solid #000;" width="13%">Duration</th>
                                            <th style="border:1px solid #000;" width="25%">Instruction</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($prescription->amedicine as $i=>$row)
                                            <tr>
                                                <td>{!! $i+1 !!}</td>
                                                <td>{!! $row->medicine->name !!}</td>
                                                <td>{!! $row->medicine->mtype->short_name !!}</td>

                                                <td>
                                                    @foreach($row->durations as $line)
                                                        {!! $line->dose !!}<br/>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach($row->durations as $line)
                                                        {!! $line->duration !!}<br/>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    @foreach($row->durations as $line)
                                                        {!! $line->advice !!}<br/>
                                                    @endforeach
                                                </td>

                                            </tr>

                                            {{--@if($i === 10)--}}
                                                {{--<div class="page-break">more content, this content may be short or long</div>--}}
                                            {{--@endif--}}

                                        @endforeach

                                        </tbody>
                                    </table>

                                    <div class="page-break"></div>

                                    @if(count($prescription->gadvice) > 0)
                                    <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th width="10%">SL</th>
                                                <th width="90%">Advice</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @foreach($prescription->gadvice as $i=>$advs)
                                                <tr style="line-height: 75%">
                                                    <td >{!! $i+1 !!}</td>
                                                    <td>{!! $advs->advice !!}</td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                    </table>
                                    @endif

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@push('scripts')

    <script>
        function printDiv()
        {


            var newstr=document.getElementById("printpage").innerHTML;

            // var header='<header><div align="center"><h3 style="color:#EB5005"> Your HEader </h3></div><br></header><hr><br>'

//        var footer ="Your Footer";
            var htmlTableToPrint = '' +
                '<style media="print" type="text/css">' +
                'table th {' +
                'border:1px solid #000;' +
                'padding;0.5em;' +
                '}' +
                '</style>';

            var htmlToPrint = '' +
                '<style media="print">' +
                '   @page {' +
                '      size: auto;' +
                '      margin: 30px;' +
                '  }' +
                '</style>'

            //You can set height width over here
            var popupWin = window.open('', '_blank', 'width=720,height=326');
            popupWin.document.open();
            popupWin.document.write('<link rel="stylesheet" href="{!! asset('assets/bootstrap-4.1.3/css/bootstrap.min.css') !!}" type="text/css" />');
            popupWin.document.write('<link rel="stylesheet" href="{!! asset('assets/css/print.css') !!}" type="text/css" />');
            popupWin.document.write('<html> <body onload="window.print()">'+ htmlTableToPrint +  newstr + '</html>');
//        popupWin.document.write('<html> <body onload="window.print()">'+ newstr + '</html>' + footer);
            popupWin.document.close();
            return false;


        }
    </script>
@endpush