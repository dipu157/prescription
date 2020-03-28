@extends('layouts.master')

@section('pagetitle')
    @if(!empty($patient))
    <h2 class="no-margin-bottom">Investigation Result for : <span style="font-weight: bold; color: darkred">{!! $patient->first_name. ' '. $patient->middle_name. ' '. $patient->family_name !!}</span> </h2>
    <p>Gender: {!! $patient->sex=='M' ? 'Male' : 'Female' !!},   IP No {!! $ipNo !!}</p>
    @endif
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




        </div>


        <div class="row justify-content-center">

            {{--@if(!empty($patient))--}}

                {{--<div class="col-md-6">--}}

                    {{--<div class="card">--}}

                        {{--<div class="card-body">--}}

                            {{--<table class="table table-striped table-bordered table-success">--}}

                                {{--<tbody>--}}
                                {{--<tr>--}}
                                    {{--<td>Name :</td>--}}
                                    {{--<td>{!! $title->title !!} {!! $patient->first_name. ' '. $patient->middle_name. ' '. $patient->family_name !!} : {!! $patient->registration_no !!}</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td>Gender :</td>--}}
                                    {{--<td>{!! $patient->sex=='M' ? 'Male' : 'Female' !!}</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td>Date of Birth :</td>--}}
                                    {{--<td>{!! \Carbon\Carbon::parse($patient->date_of_birth)->format('d-M-Y') !!}</td>--}}
                                {{--</tr>--}}
                                {{--<tr>--}}
                                    {{--<td>IP No</td>--}}
                                    {{--<td>{!! $ipNo !!}</td>--}}
                                {{--</tr>--}}
                                {{--</tbody>--}}

                            {{--</table>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--@endif--}}

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


        @if(!empty($cbc_result))

            <div class="col-md-12">

                @foreach($lab_dates as $dt)

                    <div class="card">

                        <div class="card-header">
                            <h2 style="text-align: center; font-weight: bold;">Haematology Report </h2>
                            <h2 style="text-align: center; font-weight: bold"></h2>
                            <h3 style="font-weight: bold">Result Date : {!! \Carbon\Carbon::parse($dt->d_bill_dt)->format('d-m-Y H:s') !!} </h3>
                        </div>

                        <div class="card-body">

                            <table class="table table-striped table-bordered table-secondary">

                                <thead>
                                    <tr>
                                        <th>Test</th>
                                        <th>Result</th>
                                        <th>Unit</th>
                                        <th>Reference Range</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($cbc_result as $row)
                                    @if($dt->n_rpt_id == $row->n_rpt_id)
                                        <tr>
                                            <td>{!! $row->v_rpt_par !!}</td>
                                            <td>{!! $row->v_result !!}</td>
                                            <td>{!! $row->v_mu !!}</td>
                                            <td>{!! $row->v_ref_val !!}</td>
                                        </tr>
                                    @endif
                                @endforeach
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


        $('#formatted').html(function() {
            return this.innerHTML.substring(6).replace(/\t/g, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
        });


    </script>

@endpush