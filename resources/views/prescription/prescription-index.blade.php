@extends('layouts.master')

@section('pagetitle')
    <h2 class="no-margin-bottom">{!! $prescription->id !!} Create Prescription for : {!! $appointment->name !!}, Age : {!! $appointment->age  !!} Gender: {!! $appointment->gender == 'F' ? 'Female' : 'Male' !!}</h2>
@endsection
@section('content')


    <script type="text/javascript" src="{!! asset('assets/js/jquery-3.3.1.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/js/bootstrap3-typeahead.js') !!}"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <div class="row container-fluid">

        <div class="col-sm-8">
            <div class="card text-primary bg-gray border-primary">
                <div class="card-header">
                    <h5 class="card-title">General Info</h5>
                </div>
                <div class="card-body">

                    <form action="{{ url('prescription/general') }}" class="form-inner" method="post" accept-charset="utf-8">
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="wiight" class="col-sm-2 col-form-label">Weight</label>
                            <div class="col-sm-2">
                                <input type="text" name="weight" value="{!! $prescription->weight !!}" class="form-control" id="wiight" placeholder="Weight" autofocus>
                            </div>

                            <label for="bp" class="col-sm-1 col-form-label">BP</label>
                            <div class="col-sm-3">
                                <input type="text" name="bp" value="{!! $prescription->bp !!}" class="form-control" id="bp" placeholder="Blood Pressure">
                            </div>

                            <label for="sugar" class="col-sm-2 col-form-label">Sugar</label>
                            <div class="col-sm-2">
                                <input type="text" name="sugar" value="{!! $prescription->sugar !!}" class="form-control" id="sugar" placeholder="Blood Pressure">
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="temperature" class="col-sm-3 col-form-label">Temperature</label>
                            <div class="col-sm-3">
                                <input type="text" name="temperature" value="{!! $prescription->temperature !!}" class="form-control" id="temperature" placeholder="Temperature" autofocus>
                            </div>

                            <label for="pulse" class="col-sm-3 col-form-label">Pulse Rate</label>
                            <div class="col-sm-3">
                                <input type="text" name="pulse" value="{!! $prescription->pulse !!}" class="form-control" id="pulse" placeholder="Pulse Rate">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="complains" class="col-sm-3 col-form-label">Complaints /<br/>Current Status</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="complains" cols="50" rows="4" id="complains">{!! $prescription->complains !!}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="c-medicine" class="col-sm-3 col-form-label">Current <br/>Medicine</label>
                            <div class="col-sm-9">
                                <input type="text" name="c-medicine" value="{!! $prescription->current_medication !!}" class="form-control" id="c-medicine" placeholder="Current Madications">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="diagnosis" class="col-sm-3 col-form-label">Diagnosis</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="diagnosis" cols="50" rows="4" id="diagnosis">{!! $prescription->diagnosis !!}</textarea>
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="o2sat" class="col-sm-2 col-form-label">O2Sat</label>
                            <div class="col-sm-4">
                                <input type="text" name="o2sat" value="{!! $prescription->o2sat !!}" class="form-control" id="o2sat" placeholder="O2Sat">
                            </div>

                            <label for="bsa" class="col-sm-2 col-form-label">BSA</label>
                            <div class="col-sm-4">
                                <input type="text" name="bsa" value="{!! $prescription->bsa !!}" class="form-control" id="bsa" placeholder="BSA">
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="sugar" class="col-sm-2 col-form-label">Next<br/>Plan</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="c-remarks" cols="50" rows="4" id="c-remarks">{!! $prescription->remarks !!}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" name="btn-general" class="btn btn-primary" value="{!! $appointment->id !!}">Submit</button>

                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>


        <div class="col-sm-4">
            <div class="card">
                <div class="card-body">

                    <div class="btn-group-vertical" role="group" aria-label="Vertical button group">
                        <button type="button" class="btn btn-primary ml-0" href="#previous-prescription-modal" data-target="#previous-prescription-modal" data-toggle="modal">Previous Prescription</button>
                        <button type="button" class="btn btn-info">Current Medication</button>

                        <div class="btn-group btn-group-sm " role="group" aria-label="History">
                            <button type="button" class="btn btn-sm btn-secondary" href="#create-history-modal" data-target="#create-history-modal" data-toggle="modal">Craete</button>
                            <button type="button" class="btn btn-sm btn-secondary btn-view-history" href="#view-history-modal" data-target="#view-history-modal" data-toggle="modal">View</button>
                            <button type="button" class="btn btn-sm btn-secondary" disabled>History</button>
                        </div>

                        <button type="button" class="btn btn-info ml-0" href="#modal-add-generic" data-target="#modal-add-generic" data-toggle="modal">Complains</button>

                        <button type="button" class="btn btn-primary ml-0" href="#modal-add-generic" data-target="#modal-add-generic" data-toggle="modal">Add Generic</button>
                        <button type="button" class="btn btn-info" href="#modal-add-medicine" data-target="#modal-add-medicine" data-toggle="modal">Add Drug</button>

                    </div>
                </div>
            </div>


            {{--<div class="clearfix"></div>--}}
            {{--<div class="card">--}}
                {{--<div class="card-body text-center">--}}

                    {{--<div class="panel-heading no-print">--}}
                        {{--<div class="btn-group">--}}
                            {{--<a class="btn btn-secondary btn-general-advice" href="#modal-general-advice" data-target="#modal-general-advice" data-toggle="modal"> <i></i>Complains</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                {{--</div>--}}
            {{--</div>--}}


            <div class="clearfix"></div>
            {{--<div class="card">--}}
                {{--<div class="card-body text-center">--}}

                    {{--<div class="panel-heading no-print">--}}
                        {{--<div class="btn-group">--}}
                            {{--<a class="btn btn-secondary btn-general-advice" href="#modal-general-advice" data-target="#modal-general-advice" data-toggle="modal"> <i></i>General Advices</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                {{--</div>--}}
            {{--</div>--}}

            <div class="clearfix"></div>

            <div class="card">
                <div class="card-body text-center">

                    <div class="panel-heading no-print">
                        <div class="btn-group btn-group-sm">
{{--                            <a class="btn btn-sm btn-primary" href="{!! url('prescription/print/'.$prescription->id) !!}"  > <i class="fa fa-print"></i>Print</a>--}}
                            <a class="btn btn-sm btn-primary" href="{!! url('prescription/preview/'.$prescription->id) !!}"  > <i class="fa fa-print"></i>Preview</a>
                            <a class="btn btn-sm btn-secondary btn-reload" id="btn-reload" ></i>Reload</a>

                        </div>
                    </div>

                </div>
            </div>


            <div class="card">
                <div class="card-body text-center">

                    <div class="text-center">
                        <img src="{!! isset($prescription->image) ? asset($prescription->image) : ($appointment->gender == 'M' ? asset('images/male.jpeg') : asset('images/female.png'))  !!}" width="100px" height="100px" class="rounded" alt="..">
                        <button style="margin: 0 auto" type="submit" name="btn-invs-list" href="#photo-update-modal" data-target="#photo-update-modal" data-toggle="modal" class="btn btn-sm btn-info"><i></i>Photo</button>
                    </div>

                </div>
            </div>


        </div>
    </div>

    {!! Form::hidden('prescription_id', $prescription->id, array('id' => 'prescription_id')) !!}


    <div class="card">
        <div class="card-header text-center" style="background-color: rgba(177, 245, 174, 0.33)">MEDICINE ADVICE</div>
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped" id="medicine-table">
                <thead>
                <tr style="background-color: #f9f9f9;">

                    <th width="23%" class="text-left">Medicine</th>
                    <th width="16%" class="text-left">Strength</th>
                    <th width="16%" class="text-center">Dose</th>
                    <th width="16%" class="text-center">Duration</th>
                    <th width="16%" class="text-left">Instruction</th>
                    <th width="5%"  class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
            </table>

                {{--<form action="#" class="form-inner" method="post" accept-charset="utf-8">--}}

                    {{ csrf_field() }}

                    <div class="form-row">
                        <div class="col-md-3">
                            <input type="text" name="a_medicine" class="form-control typeahead_m" id="a_medicine" placeholder="Medicine" autocomplete="off">
                            <input type="hidden" name="medicine_id" id="medicine_id">
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="m_strength" class="form-control" id="m_strength" placeholder="Strength" autocomplete="off">
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="m_dose" class="form-control typeahead_dose" id="m_dose" placeholder="Dose" autocomplete="off">
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="m_duration" class="form-control typeahead_days" id="m_duration" placeholder="Duration" autocomplete="off">
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="m_instruction" class="form-control typeahead_i" id="m_instruction" placeholder="Instructions" autocomplete="off">
                        </div>
                        <div class="col-md-1">
                            <button style="margin: 0 auto" type="submit" id="btn-add-medicine" name="btn-medicine" value="{!! $prescription->id !!}" class="btn btn-add-medicine btn-sm btn-primary"><i></i>Save</button>
                        </div>
                    </div>
                {{--</form>--}}
        </div>
    </div>


        {{--// Investigations--}}

    <div class="card">
        <div class="card-header text-center" style="background-color: rgba(177, 245, 174, 0.33)">INVESTIGATIONS</div>
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped" id="diagnosis-table">
                <thead>
                <tr style="background-color: #f9f9f9;">

                    <th width="50%" class="text-left">Investigation Name</th>
                    <th width="40%" class="text-left">Instructions</th>
                    <th width="10%"  class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
            </table>


            {{--<form action="{{ url('prescription/diagnosis') }}" class="form-inner" method="post" accept-charset="utf-8">--}}

                {{--{{ csrf_field() }}--}}

                <div class="form-row">
                    <div class="col-md-6">
                        <input type="text" name="p_diagnosis" class="form-control typeahead_d" id="p_diagnosis" placeholder="Investigations" autocomplete="off">
                        <input type="hidden" name="diagnosis_id" id="diagnosis_id">
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="d_remarks" class="form-control" id="d_remarks" placeholder="Instructions" autocomplete="off">
                    </div>

                    <div class="col-md-2">
                        <button style="margin: 0 auto" type="submit" name="btn-diagnosis" value="{!! $prescription->id !!}" class="btn btn-sm btn-add-diagnosis btn-primary"><i></i>Save</button>
                        <button style="margin: 0 auto" type="submit" name="btn-invs-list" href="#modal-investigation-advice" data-target="#modal-investigation-advice" data-toggle="modal" class="btn btn-sm btn-info"><i></i>List</button>
                    </div>
                </div>
            {{--</form>--}}
        </div>
    </div>




    {{--// Investigations--}}

    <div class="card">
        <div class="card-header text-center" style="background-color: rgba(177, 245, 174, 0.33)">General Advices</div>
        <div class="card-body">
            <table width="60%" class="table table-bordered table-hover table-striped" id="advices-table">
                <thead>
                <tr style="background-color: #f9f9f9;">

                    <th width="80%" class="text-left">Advices</th>
                    <th width="20%"  class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>
            </table>


            {{--<form action="{{ url('prescription/diagnosis') }}" class="form-inner" method="post" accept-charset="utf-8">--}}

            {{--{{ csrf_field() }}--}}

            <div class="form-row">
                <div class="col-md-6">
                    <input type="text" name="p_advices" class="form-control" id="p_advices" placeholder="Advices" autocomplete="off">
                </div>

                <div class="col-md-2">
                    <button style="margin: 0 auto" type="submit" name="btn-advices" value="{!! $prescription->id !!}" class="btn btn-sm btn-add-gadvices btn-primary"><i></i>Save</button>
                    <button style="margin: 0 auto" type="submit" name="btn-invs-list" href="#modal-general-advice" data-target="#modal-general-advice" data-toggle="modal" class="btn btn-sm btn-info"><i></i>List</button>
                </div>
            </div>
            {{--</form>--}}
        </div>
    </div>






    @include('prescription.modals.create-history')
    @include('prescription.modals.view-history')
    @include('prescription.modals.more-duration-modal')
    @include('prescription.modals.general-advice-modal')
    @include('prescription.modals.medicine-add-modal')
    @include('prescription.modals.generic-add-modal')
    @include('prescription.modals.investigation-list-modal')
    @include('prescription.modals.previous-prescription-modal')
    @include('prescription.modals.photo-modal')





@endsection

@push('scripts')
    <script>

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });


        $(function (){
            $(document).on("focus", "input:text", function() {
                $(this).select();
            });
        });

        $('#btn-reload').click(function() {
            location.reload();
        });

        $(document).ready(function(){


            var autocomplete_path_m = "{{ url('autocomplete/medicine') }}";
            var autocomplete_path_d = "{{ url('autocomplete/diagnosis') }}";

            var autocomplete_path_g = "{{ url('autocomplete/generics') }}";

            $(document).on('click', '.form-control.typeahead_m', function() {
                input_id = $(this).attr('id').split('-');
                item_id = parseInt(input_id[input_id.length-1]);

                $(this).typeahead({
                    minLength: 3,
                    items: 20,
                    displayText:function (data) {

                        if(data.mtype !=null){
                            return data.name + ' : ' + data.mtype.name;
                        }else {
                            return data.name + ' : ' + 'Generic';
                        }

                    },
                    source: function (query, process) {
                        $.ajax({
                            url: autocomplete_path_m,
                            type: 'GET',
                            dataType: 'JSON',
                            data: 'query=' + query ,
                            success: function(data) {
                                return process(data);
                            }
                        });
                    },
                    afterSelect: function (data) {
                        $('#medicine_id').val(data.id);

                        if(data.strength !=null){

                            document.getElementById('m_strength').value= data.strength.name;
                        }else{
                            document.getElementById('m_strength').value= '';
                        }

                        if(data.template_data != null) { // Covers 'undefined' as well
                            dose = data.template_data.value1;
                            duration = data.template_data.value2;
                            instruction = data.template_data.value3;
                        } else {
                            dose = '';
                            duration = '';
                            instruction = '';
                        }

                        document.getElementById('m_dose').value= dose;
                        document.getElementById('m_duration').value = duration;
                        document.getElementById('m_instruction').value = instruction;

                    }
                });
            });


            $(document).on('click', '.form-control.typeahead_d', function() {
                $(this).typeahead({
                    minLength: 2,
                    displayText:function (data) {
                        return data.name;
                    },
                    source: function (query, process) {
                        $.ajax({
                            url: autocomplete_path_d,
                            type: 'GET',
                            dataType: 'JSON',
                            data: 'query=' + query ,
                            success: function(data) {
                                return process(data);
                            }
                        });
                    },
                    afterSelect: function (data) {
                        $('#diagnosis_id').val(data.id);

                    }
                });
            });



            // DOSE TYPE AHEAD


            $(document).on('click', '.form-control.typeahead_dose', function() {

                $(this).typeahead({
                    minLength: 1,
                    displayText:function (data) {
                        return data;
                    },
                    source: ["1+1+1", "1+0+1", "1+0+0", "0+0+1","0+1+0"],

                });
            });



            // END DOSE TYPE-AHEAD



            //Duration TYPE-AHEAD


            $(document).on('click', '.form-control.typeahead_days', function() {

                $(this).typeahead({
                    minLength: 1,
                    displayText:function (data) {
                        return data;
                    },
                    source: [" চলবে","১ দিন","১ সপ্তাহ","১ মাস", "২ দিন","২ সপ্তাহ","২ মাস", "৩ দিন","৩ সপ্তাহ","৩ মাস","প্রয়োজনে (ব্যথা হলে)", "৪ দিন", "৪ সপ্তাহ", "৫ দিন", "৬ দিন","৬ সপ্তাহ","৬ মাস","৭ দিন", "১০ দিন", "১৪ দিন"],

                });
            });

            // END Duration



            //Instructions Type Ahead


            $(document).on('click', '.form-control.typeahead_i', function() {

                $(this).typeahead({
                    minLength: 1,
                    displayText:function (data) {
                        return data;
                    },
                    source: ["খাবারের আগে","খাবারের পরে (ভরা পেটে)","ঘুমানোর আগে","খাবারের ½ ঘন্টা আগে","খাবারের ½ ঘন্টা পরে","খাবারের ১ ঘন্টা আগে","খাবারের ১ ঘন্টা পরে","খাবারের ২ ঘন্টা আগে","খাবারের ২ ঘন্টা পরে","যদি ব্যথা থাকে" ],

                });
            });


            // End Instructions Type Ahead


            $(document).on('click', '.form-control.typeahead_g', function() {

                $(this).typeahead({
                    minLength: 2,
                    displayText:function (data) {
                        return data.name;
                    },
                    source: function (query, process) {
                        $.ajax({
                            url: autocomplete_path_g,
                            type: 'GET',
                            dataType: 'JSON',
                            data: 'query=' + query ,
                            success: function(data) {
                                return process(data);
                            }
                        });
                    },
                    afterSelect: function (data) {
                        $('#generics_id').val(data.id);

                    }
                });
            });


        });


        //Medicine Advices Data Datatables

        $(function() {
            var table= $('#medicine-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                bFilter: false,
                bInfo: false,
                bPaginate: false,
                ajax: 'medicineddvicetable/'+ $('#prescription_id').val(),
                columns: [
                    { data: 'medicine.name', name: 'medicine.name' },
                    { data: 'strength', name: 'strength' },
                    { data: 'nextdose', name: 'nextdose' },
                    { data: 'nextduration', name: 'nextduration' },
                    { data: 'nextadvice', name: 'nextadvice' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, printable: false}
                ]
            });

            $("body").on("click", ".btn-create", function (e) {
                e.preventDefault();

                var url = $(this).data('remote');
                window.location.href = url;

            });


            $('#medicine-table').on('click', '.btn-extra-dose', function (e) {
                e.preventDefault();

                var p_id = $(this).data('p-id');
                var m_id = $(this).data('m-id');

                document.getElementById('medicine_name').innerText = $(this).data('m-name');
                document.getElementById('for-medicine-advice-id').value = $(this).data('ma-id');

                $("#modal-add-dose-duration").modal()
            });


            // Save Medicine Advice


            $(document).on('click', '.btn-add-medicine', function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var url = 'medicine';

                // confirm then
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',

                    data: {method: '_POST', submit: true, medicine_id:$('#medicine_id').val(),
                        m_strength:$('#m_strength').val(), m_dose:$('#m_dose').val(),
                        m_duration:$('#m_duration').val(), m_instruction:$('#m_instruction').val(),
                        prescription_id:$('#prescription_id').val(),
                    },

                    error: function (request, status, error) {
                        alert(request.responseText);
                    },

                    success: function (data) {

                        document.getElementById('m_strength').value='';
                        document.getElementById('a_medicine').value='';
                        document.getElementById('medicine_id').value='';
                        document.getElementById('m_dose').value='';
                        document.getElementById('m_duration').value='';
                        document.getElementById('m_instruction').value='';

                        $('#medicine-table').DataTable().draw(false);

                    }

                });
            });


            // Extra Dose Save


            $(document).on('click', '.btn-extra-dose-save', function (e) {
//        e.preventDefault();
//        alert('click');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var url = 'medicine/extradose';

                // confirm then
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',

                    data: {method: '_POST', submit: true, ma_id:$('#for-medicine-advice-id').val(),
                        new_dose:$('#new_dose').val(),
                        new_duration:$('#new_duration').val(), new_instruction:$('#new_instruction').val(),
                    },

                    error: function (request, status, error) {
                        alert(request.responseText);
                    },

                    success: function (data) {

                        // $('#item-idn-' + data.drugrow).val(data.id);
                        // $('#item-name-' + data.drugrow).val(data.name);
                        $('#modal-add-dose-duration').modal('hide');
                        $('#medicine-table').DataTable().draw(false);

                    }

                });
            });

            // Extra Dose Save End


            //Add New Medicine


            $(document).on('click', '.btn-add-medicine-save', function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var url = 'medicine/new/save';

                // confirm then
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',

                    data: {method: '_POST', submit: true, generic_id:$('#generics_id').val(),
                        manufacturer_id:$('#manufacturer_id').val(),new_medicine_name:$('#new_medicine_name').val(),
                        new_medicine_dose:$('#new_medicine_dose').val(), new_strength_id:$('#new_strength_id').val(),
                        new_type_id:$('#new_type_id').val(),
                        new_medicine_duration:$('#new_medicine_duration').val(), new_medicine_instruction:$('#new_medicine_instruction').val(),
                    },

                    error: function (request, status, error) {
                        alert(request.responseText);
                    },

                    success: function (data) {

                        $('#modal-add-medicine').modal('hide');

                    }

                });
            });


            //End new Medicine

            //Add new Generic Save

            $(document).on('click', '.btn-add-generic-save', function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var url = 'generic/new/save';

                // confirm then
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',

                    data: {method: '_POST', submit: true,
                        new_generic_name:$('#new_generic_name').val(), new_generic_description:$('#new_generic_description').val(),
                    },

                    error: function (request, status, error) {
                        alert(request.responseText);
                    },

                    success: function (data) {

                        $('#modal-add-generic').modal('hide');

                    }

                });
            });


            //End New Generic

            $('#medicine-table').on('click', '.btn-delete[data-remote]', function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var url = $(this).data('remote');
                // confirm then
                if (confirm('Are you sure you want to delete this?')) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {method: '_DELETE', submit: true}
                    }).always(function (data) {
                        $('#medicine-table').DataTable().draw(false);
                    });
                }else
                    alert("You have cancelled!");
            });

        });
    </script>

    <script>
        $(function() {

            var table= $('#diagnosis-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                bFilter: false,
                bInfo: false,
                bPaginate: false,
                ajax: 'diagnosisadvicetable/'+ $('#prescription_id').val(),
                columns: [
                    { data: 'diagnosis.name', name: 'diagnosis.name' },
                    { data: 'remarks', name: 'remarks' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, printable: false}
                ]
            });

            $("body").on("click", ".btn-create", function (e) {
                e.preventDefault();

                var url = $(this).data('remote');
                window.location.href = url;

            });


            $('#diagnosis-table').on('click', '.btn-delete[data-remote]', function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var url = $(this).data('remote');
                // confirm then
                if (confirm('Are you sure you want to delete this?')) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {method: '_DELETE', submit: true}
                    }).always(function (data) {
                        $('#diagnosis-table').DataTable().draw(false);
                    });
                }else
                    alert("You have cancelled!");
            });


        });



        // Add Diagnosis


        $(document).on('click', '.btn-add-diagnosis', function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = 'diagnosis';

            // confirm then
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',

                data: {method: '_POST', submit: true, diagnosis_id:$('#diagnosis_id').val(),
                    d_remarks:$('#d_remarks').val(),
                    prescription_id:$('#prescription_id').val(),
                },

                error: function (request, status, error) {
                    alert(request.responseText);
                },

                success: function (data) {

                    document.getElementById('diagnosis_id').value='';
                    document.getElementById('d_remarks').value='';
                    document.getElementById('p_diagnosis').value='';

                    $('#diagnosis-table').DataTable().draw(false);

                }

            });
        });


    </script>



    {{--New General Advices--}}


    <script>
        $(function() {

            var table= $('#advices-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                bFilter: false,
                bInfo: false,
                bPaginate: false,
                ajax: 'generaladvicestable/'+ $('#prescription_id').val(),
                columns: [
                    { data: 'advice', name: 'advice' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, printable: false}
                ]
            });

            $("body").on("click", ".btn-create", function (e) {
                e.preventDefault();

                var url = $(this).data('remote');
                window.location.href = url;

            });


            $('#advices-table').on('click', '.btn-delete[data-remote]', function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var url = $(this).data('remote');
                // confirm then
                if (confirm('Are you sure you want to delete this?')) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        dataType: 'json',
                        data: {method: '_DELETE', submit: true}
                    }).always(function (data) {
                        $('#advices-table').DataTable().draw(false);
                    });
                }else
                    alert("You have cancelled!");
            });


        });



        // Add New Advices


        $(document).on('click', '.btn-add-gadvices', function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = 'ngadvices';

            // confirm then
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',

                data: {method: '_POST', submit: true, new_advice:$('#p_advices').val(),
                    prescription_id:$('#prescription_id').val(),
                },

                error: function (request, status, error) {
                    alert(request.responseText);
                },

                success: function (data) {

                    document.getElementById('p_advices').value='';

                    $('#advices-table').DataTable().draw(false);

                }

            });
        });


    </script>


    {{--END NEW General Advices--}}






    {{--Modals Open --}}
    <script>

        $(document).on('click', '.btn-create-history', function (e) {
//        e.preventDefault();
//        alert('click');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = 'history/createdata';

            var chk_food_allergies = $("input[name='chk_food_allergies']:checked:enabled") ? 1 : 0;
            var chk_tendency_bleed = $("input[name='chk_tendency_bleed']:checked:enabled") ? 1 : 0;
            var chk_heart_disease = $("input[name='chk_heart_disease']:checked:enabled") ? 1 : 0;
            var chk_hbp = $("input[name='chk_hbp[]']:checked:enabled") ? 1 : 0;
            var chk_diabetic = $("input[name='chk_diabetic']:checked:enabled") ? 1 : 0;
            var chk_surgery = $("input[name='chk_surgery']:checked:enabled") ? 1 : 0;
            var chk_accident = $("input[name='chk_accident']:checked:enabled") ? 1 : 0;
            var chk_others = $("input[name='chk_others']:checked:enabled") ? 1 : 0;
            var chk_fmh = $("input[name='chk_fmh']:checked:enabled") ? 1 : 0;
            var chk_current_medication = $("input[name='chk_current_medication']:checked:enabled") ? 1 : 0;
            var chk_female_pregnancy = $("input[name='chk_female_pregnancy']:checked:enabled") ? 1 : 0;
            var chk_breast_feeding = $("input[name='chk_breast_feeding']:checked:enabled") ? 1 : 0;

            // confirm then
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',

                data: {method: '_POST', submit: true, prescription_id:$('#prescription_id').val(), food_allergies:$('#food_allergies').val(), chk_food_allergies:chk_food_allergies,
                    tendency_bleed:$('#tendency_bleed').val(), chk_tendency_bleed:chk_tendency_bleed,
                    heart_disease:$('#heart_disease').val(), chk_heart_disease:chk_heart_disease,
                    hbp:$('#hbp').val(), chk_hbp:chk_hbp,
                    diabetic:$('#diabetic').val(), chk_diabetic:chk_diabetic,
                    surgery:$('#surgery').val(), chk_surgery:chk_surgery,
                    accident:$('#accident').val(), chk_accident:chk_accident,
                    others:$('#others').val(), chk_others:chk_others,
                    fmh:$('#fmh').val(), chk_fmh:chk_fmh,
                    current_medication:$('#current_medication').val(), chk_current_medication:chk_current_medication,
                    female_pregnancy:$('#female_pregnancy').val(), chk_female_pregnancy:chk_female_pregnancy,
                    breast_feeding:$('#breast_feeding').val(), chk_breast_feeding:chk_breast_feeding,
                },

                error: function (request, status, error) {
                    alert(request.responseText);
                },

                success: function (data) {

                    // $('#item-idn-' + data.drugrow).val(data.id);
                    // $('#item-name-' + data.drugrow).val(data.name);
                    $('#create-history-modal').modal('hide');

                }

            });
        });

        $(document).on('click', '.btn-view-history', function (e) {
//        e.preventDefault();

            var url = 'history/viewdata/' + $('#prescription_id').val();

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                data: {method: '_GET', submit: true, prescription_id:$('#prescription_id').val() },

                error: function (request, status, error) {
                    alert(request.responseText);
                },

                success: function (data) {

                    $(".historydata").remove();
                    var trHTML = '';

                    $.each(data.history, function (i, item) {
                        trHTML += '<tr class="historydata"><td align="right">' + item.record_date + '</td>' +
                            '<td align="left">' + item.food_allergies + '</td>' +
                            '<td>' +  item.tendency_bleed + '</td>' +
                            '<td align="right">' + item.heart_disease + '</td>' +
                            '<td align="right">' + item.hbp + '</td>' +
                            '<td align="right">' + item.diabetic + '</td>' +
                            '<td align="right">' + item.surgery + '</td>' +
                            '<td align="right">' + item.accident + '</td>' +
                            '<td align="right">' + item.others + '</td>' +
                            '<td align="right">' + item.fmh + '</td>' +
                            '<td align="right">' + item.female_pregnancy + '</td>' +
                            '<td align="right">' + item.breast_feeding + '</td>';
                    });

                    $('#history-table').append(trHTML);

                }
            });
        });


        // Ajax Call for Get Advice Data

        $(document).on('click', '.btn-general-advice', function (e) {
//        e.preventDefault();

            var url = 'generaladvice/getdata/' + $('#prescription_id').val();

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                data: {method: '_GET', submit: true },

                error: function (request, status, error) {
                    alert(request.responseText);
                },

                success: function (data) {

                    var trHTML = '';

                    $.each(data, function (i, item) {

                        // alert(item.advice_id);

                        $('#advice_check'+ 2).prop('checked', true);

                        // $("input[name='advice_check[]']").eq(item.advice_id).attr('checked', true);

                    });

                }

            });
        });

        /// End for Get Advice

        $(document).on('click', '.btn-g-advice', function (e) {
//        e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var url = 'advices/savedata';
            var s1 = [];

            $("input[name='advice_check[]']:checked:enabled").each(function() {

                var row = [];
                row.push($(this).val());
                s1.push(row);
            });

            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: {method: '_POST', submit: true, advice_check:s1, prescription_id:$('#prescription_id').val() },

                error: function (request, status, error) {
                    alert(request.responseText);
                },

                success: function (data) {

                    $('#modal-general-advice').modal('hide');
                    $('#advices-table').DataTable().draw(false);

                }

            });
        });

//button click to add investigations list

        $(document).on('click', '.btn-investigation-advice', function (e) {
//        e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var url = 'investigation/savedata';
            var s1 = [];

            $("input[name='investigation_check[]']:checked:enabled").each(function() {

                var row = [];
                row.push($(this).val());
                s1.push(row);
            });

            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',
                data: {method: '_POST', submit: true, investigation_id:s1, prescription_id:$('#prescription_id').val() },

                error: function (request, status, error) {
                    alert(request.responseText);
                },

                success: function (data) {

                    $('#modal-investigation-advice').modal('hide');
                    $('#diagnosis-table').DataTable().draw(false);

                }

            });
        });

        //end button click to add investigations list

// FOR PHOTO UPDATE


        // For Phot Update


//         $(document).on('click', '.btn-g-advice', function (e) {
//             // e.preventDefault();
//
//
//             var url = $(this).data('remote');
//
//             //Ajax Load data from ajax
//             $.ajax({
//                 url: url,
//                 type: "GET",
//                 dataType: "JSON",
//
//                 success: function(data)
//                 {
//                     $(".tabonedata").remove();
// //
//                     var trHTML = '';
//                     $.each(data, function (i, item) {
//                         trHTML += '<tr class="tabonedata"><td align="left">' + item.employee_id + '</td><td>' +  item.name + '</td></tr>';
//
//                         $('.imagepreview').attr('src', item.image);
//                         $('.signpreview').attr('src', item.signature);
//                         $('[id="id"]').val(item.employee_id);
//
//                     });
// //
//                     $('#tabonetable').append(trHTML);
//
//                     $('#photo-sign-modal').modal('show'); // show bootstrap modal when complete loaded
//
//                 },
//                 error: function (jqXHR, textStatus, errorThrown)
//                 {
//                     alert('Error get data from ajax');
//                 }
//             });
//
//         });



        // Check Photo File Validation


        function imageFileValidation(){
            var fileInput = document.getElementById('imagefilename');
            var filePath = fileInput.value;
            // var allowedExtensions = /(\.jpg)$/i;

            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;

            if(!allowedExtensions.exec(filePath)){
                alert('Please upload file having extensions .jpg only.');
                fileInput.value = '';
                return false;
            }else{
                //Image preview
                if (fileInput.files && fileInput.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('imagePreview').innerHTML = '<img src="'+e.target.result+'" width="100px"; height="100px"/>';
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        }

    </script>

@endpush