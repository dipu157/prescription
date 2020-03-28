@extends('layouts.master')

@section('pagetitle')
    <h2 class="no-margin-bottom">Dashboard</h2>
@endsection
@section('content')
    <script type="text/javascript" src="{!! asset('assets/js/jquery-3.3.1.min.js') !!}"></script>
    <!-- Dashboard Counts Section-->

    @if(\Illuminate\Support\Facades\Auth::user()->role_id != 1)

        <div id="perf_div"></div>
        <?= Lava::render('ColumnChart', 'Finances', 'perf_div') ?>
    @endif

    {{--<section class="dashboard-counts no-padding-bottom">--}}
        {{--<div class="container-fluid">--}}
            {{--<div class="row bg-white has-shadow">--}}
                {{--<!-- Item -->--}}
                {{--<div class="col-xl-3 col-sm-6">--}}
                    {{--<div class="item d-flex align-items-center">--}}
                        {{--<div class="icon bg-violet"><i class="icon-user"></i></div>--}}
                        {{--<div class="title"><span>Total<br>PC</span>--}}
                            {{--<div class="progress">--}}
                                {{--<div role="progressbar" style="width: 25%; height: 4px;" aria-valuenow={!! (250/10)*100 !!} aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-violet"></div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="number"><strong>10</strong></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<!-- Item -->--}}
                {{--<div class="col-xl-3 col-sm-6">--}}
                    {{--<div class="item d-flex align-items-center">--}}
                        {{--<div class="icon bg-red"><i class="icon-padnote"></i></div>--}}
                        {{--<div class="title"><span>Total<br>Printer</span>--}}
                            {{--<div class="progress">--}}
                                {{--<div role="progressbar" style="width: 70%; height: 4px;" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-red"></div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="number"><strong>20</strong></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<!-- Item -->--}}
                {{--<div class="col-xl-3 col-sm-6">--}}
                    {{--<div class="item d-flex align-items-center">--}}
                        {{--<div class="icon bg-green"><i class="icon-bill"></i></div>--}}
                        {{--<div class="title"><span>Total<br>IP Phone</span>--}}
                            {{--<div class="progress">--}}
                                {{--<div role="progressbar" style="width: 40%; height: 4px;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-green"></div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="number"><strong>30</strong></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<!-- Item -->--}}
                {{--<div class="col-xl-3 col-sm-6">--}}
                    {{--<div class="item d-flex align-items-center">--}}
                        {{--<div class="icon bg-orange"><i class="icon-check"></i></div>--}}
                        {{--<div class="title"><span>Total<br>Card Printer</span>--}}
                            {{--<div class="progress">--}}
                                {{--<div role="progressbar" style="width: 50%; height: 4px;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="progress-bar bg-orange"></div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="number"><strong>40</strong></div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}


@endsection
