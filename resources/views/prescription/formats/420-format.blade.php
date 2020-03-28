@extends('layouts.master')

@section('pagetitle')
    <h2 class="no-margin-bottom">Prescription Priview : Template for {!! \Illuminate\Support\Facades\Auth::user()->name !!}</h2>
@endsection
@section('content')




    {{--<style type="text/css" media="print">--}}
    {{--@page {--}}
    {{--size: auto;   /* auto is the initial value */--}}
    {{--margin: 0;  /* this affects the margin in the printer settings */--}}
    {{--}--}}
    {{--</style>--}}


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

                                    <tr style="line-height: 60%">
                                        <td width="5%" style="font-size:12pt; color:black; "><strong>Date</strong></td>
                                        <td width="3%" style="font-size:12pt; color:black; "><strong>:</strong></td>
                                        <td colspan="2" width="15%" style="font-size:12pt; color:black; text-align: left "><strong>{!! \Carbon\Carbon::parse($prescription->record_date)->format('d-M-Y')  !!}</strong></td>
                                        <td width="7%" style="font-size:12pt; color:black; "><strong>UHID</strong></td>
                                        <td width="1%" style="font-size:12pt; color:black; "><strong>:</strong>  </td>
                                        <td colspan="2" width="20%" style="font-size:12pt; color:black; "><strong>{!! $patient->registration_no !!}</strong></td>
                                        <td width="7%" style="font-size:12pt; color:black; "><strong>Mobile</strong></td>
                                        <td width="1%" style="font-size:12pt; color:black; "><strong>:</strong>  </td>
                                        <td colspan="2" width="20%" style="font-size:12pt; color:black; "><strong>{!! $patient->mobile !!}</strong></td>
                                    </tr>


                                    <tr style="line-height: 60%">
                                        <td width="5%" style="font-size:12pt; color:black; "><strong>Name</strong></td>
                                        <td width="3%" style="font-size:12pt; color:black; "><strong>:</strong></td>
                                        <td width="40%" style="font-size:12pt; color:black; text-align: left "><strong>{!! $patient->name  !!}</strong></td>
                                        <td width="5%" style="font-size:12pt; color:black; "><strong>Age</strong></td>
                                        <td width="1%" style="font-size:12pt; color:black; "><strong>:</strong>  </td>
                                        <td width="5%" style="font-size:12pt; color:black; "><strong>{!! $patient->age !!}Y</strong></td>
                                        <td width="7%" style="font-size:12pt; color:black; "><strong>Weight</strong></td>
                                        <td width="1%" style="font-size:12pt; color:black; "><strong>:</strong></td>
                                        <td width="7%" style="font-size:12pt; color:black; "><strong>{!! $prescription->weight !!}</strong></td>
                                        <td width="7%" style="font-size:12pt; color:black; "><strong>BSA</strong></td>
                                        <td width="1%" style="font-size:12pt; color:black; "><strong>:</strong>  </td>
                                        <td width="7%" style="font-size:12pt; color:black; "><strong>{!! $prescription->bsa !!}</strong></td>
                                    </tr>


                                    </thead>
                                </table>

                                <!-- <div style="position: relative; width: 25%; height: 10px"></div> -->

                                <div style="float:left;width:100%;border-right:1px solid #e4e5e7;padding-right:10px">

                                    <div style="float:left;width:25%;border-right:1px solid #e4e5e7;padding-right:10px">

                                        <div style="position: relative; width: 25%; height: 10px"></div>

                                        <table class="table table-striped" width="25%">
                                            <thead>

                                            <tr style="width: 100%">
                                                <td colspan="3" width="75%" style="font-size:12pt; color:black; "><strong><u>Diagnosis</u></strong></td>
                                            </tr>
                                            <tr style="width: 100%">
                                                <td colspan="3" width="75%" style="font-size:12pt; color:black; ">{!! nl2br(e($prescription->diagnosis)) !!}</td>
                                            </tr>

                                            <tr style="width: 100%">
                                                <td colspan="3" width="75%" style="font-size:12pt; color:black; "><strong><u>Current Status</u></strong></td>
                                            </tr>
                                            <tr style="width: 100%">
                                                <td colspan="3" width="75%" style="font-size:12pt; color:black; ">{!! nl2br(e($prescription->complains)) !!}</td>
                                            </tr>



                                            <tr style="width: 100%">
                                                <td colspan="3" width="10%" style="font-size:12pt; color:black; "><strong><u>Physical Exam</u></strong></td>
                                            </tr>

                                            <tr style="width: 100%">
                                                <td width="10%" style="font-size:12pt; color:black; "><strong>BP</strong></td>
                                                <td width="5%" style="font-size:12pt; color:black; "><strong>:</strong></td>
                                                <td width="50%" style="font-size:12pt; color:black; "><strong>{!! $prescription->bp !!}</strong></td>
                                            </tr>

                                            <tr style="width: 100%">
                                                <td width="10%" style="font-size:12pt; color:black; "><strong>Temp</strong></td>
                                                <td width="5%" style="font-size:12pt; color:black; "><strong>:</strong></td>
                                                <td width="50%" style="font-size:12pt; color:black; "><strong>{!! $prescription->temperature !!}</strong></td>
                                            </tr>


                                            <tr style="width: 100%">
                                                <td colspan="3" width="75%" style="font-size:12pt; color:black; "><strong><u>Next Plan</u></strong></td>
                                            </tr>
                                            <tr style="width: 100%">
                                                <td colspan="3" width="75%" style="font-size:12pt; color:black; ">{!! $prescription->remarks !!}</td>
                                            </tr>


                                            <tr style="width: 100%">
                                                <td colspan="3" width="75%" style="font-size:12pt; color:black; "><strong><u>With following Investigations <br/> (On Appiintment)</u></strong></td>
                                            </tr>

                                            @foreach($investigations as $j=>$line)
                                                <tr>

                                                    <td colspan="3" width="75%" style="font-size:12pt; color:black; ">{!! $line->invest !!}</td>

                                                </tr>
                                            @endforeach



                                            </thead>
                                        </table>
                                    </div>


                                    <div style="float:left;width:65%;padding-left:10px">
                                        <div class="avatar"><img src="{!! asset('images/rx.png') !!}" width="50px" height="50px" alt="..." class="img-fluid rounded-circle"></div>
                                        <!-- Medicine -->
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th style="border:1px solid #000;" width="5%">SL</th>
                                                <th style="border:1px solid #000;" width="35%">Medicine Name</th>
                                                <th style="border:1px solid #000;" width="10%">Type</th>
                                                <th style="border:1px solid #000;" width="15%%">Dose</th>
                                                <th style="border:1px solid #000;" width="15%">Duration</th>
                                                <th style="border:1px solid #000;" width="20%">Instruction</th>
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


                                        <div style="position: relative; width: 100%; height: 100px"></div>

                                        <table class="table table-striped text-center">

                                            <tbody>
                                            <tr>
                                                <td width="40%"></td>
                                                <td width="60%">{!! $prescription->doctor->name !!}</td>
                                            </tr>
                                            <tr>
                                                <td width="40%"></td>
                                                <td width="60%">{!! $prescription->doctor->education !!}</td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
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