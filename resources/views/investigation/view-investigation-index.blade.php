@extends('layouts.master')

@section('pagetitle')
    <h2 class="no-margin-bottom">Investigation</h2>
@endsection
@section('content')
    <script type="text/javascript" src="{!! asset('assets/js/jquery-3.3.1.min.js') !!}"></script>

    <link href="{!! asset('assets/css/jquery.datetimepicker.min.css') !!}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{!! asset('assets/js/jquery.datetimepicker.js') !!}"></script>


    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">
                <div class="pull-left">
                    <a class="btn btn-primary" href="{!! URL::previous() !!}"> <i class="fa fa-list"></i> Back </a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="pull-right">

                    <form class="form-inline" id="search-form" method="get" action="{!! url('investigation/viewResultByIP') !!}">

                        <div class="form-group mx-sm-3 mb-1">
                            <input type="text" name="ip_no" id="ip_no" class="form-control" value="" required placeholder="IP No" autofocus />
                        </div>


                        <button type="submit" class="btn btn-primary btn-sm mb-2">Submit</button>
                    </form>
                </div>
            </div>


            {{--<div class="col-md-6">--}}
                {{--<div class="pull-right">--}}
                    {{--<input type="text" name="registration_no" id="registration_no" class="form-control" value="" required />--}}
                    {{--<button type="submit" class="btn btn-primary btn-sm">Submit</button>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>


        <div class="row justify-content-center">

            @if(!empty($patients))

                <!--Table-->
                    <table class="table table-striped table-hover table-bordered">

                        <!--Table head-->
                        <thead>
                        <tr>
                            <th style="font-weight: bold;">#</th>
                            <th style="font-weight: bold;">Name</th>
                            <th>Registration No</th>
                            <th>IP No</th>
                            <th>Bed No</th>
                            <th>View</th>
                        </tr>
                        </thead>
                        <!--Table head-->



                        <!--Table body-->
                        <tbody>

                        @foreach($patients as $i=>$row)
                            <tr class="{!! $i/1==0 ? 'table-info' : '' !!}">
                                <th scope="row">{!! $i+1 !!}</th>
                                <td>{!! $row->first_name !!} {!! $row->middle_name !!} {!! $row->family_name !!}</td>
                                <td>{!! $row->registration_no !!}</td>
                                <td>{!! $row->encounter_no !!}</td>
                                <td>{!! $row->current_bed_no !!}</td>

                                <td><a href="{!! url('investigation/viewResult/'.$row->registration_no) !!}">
                                        View Result
                                    </a></td>
                            </tr>

                        @endforeach

                        </tbody>
                        <!--Table body-->


                    </table>
                    <!--Table-->

            @endif





            {{--<div class="col-md-6">--}}
                {{--<div class="card">--}}
                    {{--<div class="card-header">User Privillege</div>--}}

                    {{--<div class="card-body">--}}
                        {{--<form method="get" action="{{ route('investigation/viewIndex') }}" >--}}
                            {{--@csrf--}}

                            {{--<div class="form-group row">--}}
                                {{--<label for="opd_ipd" class="col-md-4 col-form-label text-md-right">OP/IP</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--{!! Form::select('opd_ipd',['IP'=>'IPD'],null,['id'=>'opd_ipd', 'class'=>'form-control','readonly']) !!}--}}
{{--                                    {!! Form::select('opd_ipd',['IP'=>'IPD','OP'=>'OPD'],null,['id'=>'opd_ipd', 'class'=>'form-control','readonly']) !!}--}}

                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group row">--}}
                                {{--<label for="registration_no" id="lb_registration_no" class="col-md-4 col-form-label text-md-right">IP No</label>--}}

                                {{--<div class="col-md-6">--}}

                                    {{--<input type="text" name="registration_no" id="registration_no" class="form-control" value="" required />--}}

                                {{--</div>--}}
                            {{--</div>--}}

                            {{--<div class="form-group row mb-0">--}}
                                {{--<div class="col-md-6 offset-md-4">--}}
                                    {{--<button type="submit" class="btn btn-primary">Submit</button>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</form>--}}
                    {{--</div>--}}


                {{--</div>--}}
            {{--</div>--}}

            @if(!empty($patient))


                <div class="col-md-6">

                    <div class="card">

                        <div class="card-body">

                            <table class="table table-striped table-bordered table-success">

                                <tbody>
                                    <tr>
                                        <td>Name :</td>
                                        <td>{!! $title->title !!} {!! $patient->first_name. ' '. $patient->middle_name. ' '. $patient->family_name !!} : {!! $patient->registration_no !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Gender :</td>
                                        <td>{!! $patient->sex=='M' ? 'Male' : 'Female' !!}</td>
                                    </tr>
                                    <tr>
                                        <td>Date of Birth :</td>
                                        <td>{!! \Carbon\Carbon::parse($patient->date_of_birth)->format('d-M-Y') !!}</td>
                                    </tr>
                                    <tr>
                                        <td>IP No</td>
                                        <td>{!! $ipNo !!}</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            @endif

        </div>

        @if(!empty($results))


        @foreach($departments as $dept)
            @if($results->contains('sub_department_code',$dept->sub_code))

                    <div class="col-md-12">

                        <div class="card">

                            <div class="card-header">
                                <h2 style="text-align: left">{!! $dept->sub_name !!}</h2>
                            </div>

                            <div class="card-body">

                                <table class="table table-striped table-bordered table-success">
                                    <thead>
                                        <tr style="background-color: #11adbe">
                                            <th colspan="2">Investigation</th>
                                            <th>Result</th>
                                            <th>Ref Value</th>
                                        </tr>
                                    </thead>

                                    <tbody>

                                    @php($name = null)
                                    @php($labNo = null)

                                        @foreach($results as $row)

                                            @if($dept->sub_code == $row->sub_department_code)

                                                @if($labNo <> $row->lab_regno)
                                                    <tr style="background-color: rgba(255,0,0,0.15)">
                                                        <td style="font-weight: bold">SAMPLE COLLECTION DATE</td>
                                                        <td style="font-weight: bold">{!! \Carbon\Carbon::parse($row->sample_collect_date)->format('d-M-Y H:i') !!}</td>
                                                        <td style="font-weight: bold">RESULT DATE</td>
                                                        <td style="font-weight: bold">{!! \Carbon\Carbon::parse($row->result_date)->format('d-M-Y H:i') !!}</td>

                                                    </tr>
                                                    @php($name = null)
                                                @endif

                                                <tr>
                                                    <td>{!! $row->Service_Name == $name ? null : $row->Service_Name !!}</td>
                                                    <td>{!! $row->Profile == 'Y' ? $row->final_name : null !!}</td>
                                                    <td>{!! $row->result !!} {!! $row->Unit_name !!}</td>
                                                    <td>{!! $row->min_value . ' '.$row->symbol . $row->max_value !!}</td>
                                                </tr>

                                                @php($name = $row->Service_Name)
                                                @php($labNo = $row->lab_regno)
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            @endif
        @endforeach
        @endif


        @if(!empty($typical))

            <div class="col-md-12">

                @foreach($typical as $row)

                    <div class="card">

                        <div class="card-header">
                            <h2 style="text-align: center; font-weight: bold;">{!! $row->sub_name !!} </h2>
                            <h2 style="text-align: center; font-weight: bold">{!! $row->Service_Name !!} </h2>
                            <h3 style="font-weight: bold">Result Date : {!! \Carbon\Carbon::parse($row->result_date)->format('d-M-Y H:i') !!}</h3>
                        </div>

                        <div class="card-body">

                            <table class="table table-striped table-bordered table-secondary">
                                <tbody>
                                    <tr>
                                        <td id="formatted">{!! str_replace(':', '     :  ', $row->FORMATHTML) !!}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                @endforeach
            </div>

        @endif
    </div> <!--/.Container-->

@endsection

@push('scripts')

    <script>

        $("#opd_ipd").change(function(){

            $(this).val() == 'IP' ? document.getElementById('lb_registration_no').innerHTML = 'IP Number' : document.getElementById('lb_registration_no').innerHTML = 'UHID';

        });

        $('#formatted').html(function() {
            return this.innerHTML.substring(6).replace(/\t/g, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
        });




    </script>

@endpush