@extends('layouts.master')

@section('pagetitle')
    <h2 class="no-margin-bottom">Prescription Personalisation</h2>
@endsection
@section('content')
    <script type="text/javascript" src="{!! asset('assets/js/jquery-3.3.1.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/js/bootstrap3-typeahead.js') !!}"></script>

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                <div class="pull-left">
                    <button type="button" class="btn btn-new btn-success" data-toggle="modal" data-target="#modal-new-templare"><i class="fa fa-plus"></i>New</button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12" style="overflow-x:auto;">
                <table class="table table-bordered table-hover table-striped" id="templates-table">
                    <thead style="background-color: #b0b0b0">
                    <tr>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Dose</th>
                        <th>Duration</th>
                        <th>Instruction</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>



    <!-- Modal: modalAbandonedCart-->


    <div class="modal fade right" id="modal-new-templare" tabindex="-1" role="dialog" aria-labelledby="modal-new-templare-label"
         aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog modal-info" role="document">
            <!--Content-->
            <form action="{{ url('template/save') }}"  method="post" accept-charset="utf-8">
                {{ csrf_field() }}

                <div class="modal-content">
                    <!--Header-->
                    <div class="modal-header" style="background-color: #17A2B8;">
                        <p class="heading">Product in the cart
                        </p>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="white-text">&times;</span>
                        </button>
                    </div>

                    <!--Body-->
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-sm-12">
                                <div class="card text-primary bg-gray border-primary">

                                    <div class="card-body">

                                        <div class="form-group row">
                                            <label for="template_type" class="col-md-4 col-form-label text-md-right">Template For</label>
                                            <div class="col-md-8">
                                                {!! Form::select('item_type',array('M' => 'Medicine', 'A' => 'Advice','C'=>'Complains','I'=>'Investigations'),null,array('id'=>'item_type','class'=>'form-control','autofocus')) !!}
                                            </div>
                                        </div>

                                        <div class="form-group row" id="md-name">
                                            <label for="md-name" class="col-sm-4 col-form-label text-md-right">Item Name</label>
                                            <div class="col-sm-8">
                                                <div class="input-group mb-3">
                                                    <input type="text" name="item_name" id="item_name" class="form-control typeahead" autocomplete="off">
                                                    <input type="hidden" name="item_id" id="item_id">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row" id="value-1">
                                            <label for="value1" class="col-sm-4 col-form-label text-md-right">Dose</label>
                                            <div class="col-sm-8">
                                                <div class="input-group mb-3">
                                                    <input type="text" name="value1" id="value1" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row" id="value-2">
                                            <label for="value2" class="col-sm-4 col-form-label text-md-right">Duration</label>
                                            <div class="col-sm-8">
                                                <div class="input-group mb-3">
                                                    <input type="text" name="value2" id="value2" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="value3" class="col-sm-4 col-form-label text-md-right">Instruction</label>
                                            <div class="col-sm-8">
                                                <div class="input-group mb-3">
                                                    <input type="text" name="value3" id="value3" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!--Footer-->
                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</a>
                    </div>

            </div>
        <!--/.Content-->
        </form>
    </div>
    </div>
    <!-- Modal: modalAbandonedCart-->




@endsection

@push('scripts')

    <script>
        $(function() {
            var table= $('#templates-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                ajax: 'tabledata',
                columns: [
                    { data: 'item_type', name: 'item_type' },
                    { data: 'name', name: 'name' },
                    { data: 'value1', name: 'value1' },
                    { data: 'value2', name: 'value2' },
                    { data: 'value3', name: 'value3' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, printable: false}
                ]
            });



            $('#templates-table').on('click', '.btn-delete[data-remote]', function (e) {
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
                        data: {method: '_DELETE', submit: true},

                        error: function (request, status, error) {
                            alert(request.responseText);
                        },
                    }).always(function (data) {
                        $('#templates-table').DataTable().draw(false);
                    });
                }else
                    alert("You have cancelled!");
            });



        });


        $(document).ready(function(){



            var autocomplete_path = "{{ url('autocomplete/item/') }}";

            $(document).on('click', '.form-control.typeahead', function() {

                $item_type = $('select[name="item_type"]').val();

                $(this).typeahead({
                    minLength: 2,
                    items: 20,
                    displayText:function (data) {

                        if($item_type=='M')
                        {
                            if(data.mtype !=null){
                                return data.name + ' : ' + data.mtype.name;
                            }else {
                                return data.name + ' : ' + 'Generic';
                            }
                        }else {
                            return data.name;
                        }

                    },
                    source: function (query, process) {
                        $.ajax({
                            url: 'autocomplete/item/' + $item_type,
                            type: 'GET',
                            dataType: 'JSON',
                            data: 'query=' + query ,
                            success: function(data) {
                                return process(data);
                            }
                        });
                    },
                    afterSelect: function (data) {
                        $('#item_id').val(data.id);

                        // document.getElementById('m_strength').value= data.strength.name;

                    }
                });
            });



            $('select[name="item_type"]').on('change', function() {
                var get_data = $(this).val();
                var clone = $("#md-name").clone();

                if(get_data === 'A'){
                    $("label[for='value1']").text("Advice");
                    $('#value-1').show();
                    $('#value-2').hide();
                    $('#md-name').hide();

                }

                if(get_data === 'I'){
                    $("label[for='md-name']").text("Investigation");
                    $('#value-1').hide();
                    $('#value-2').hide();
                    $('#md-name').show();

                }

                if(get_data === 'C'){
                    $("label[for='value1']").text("Complain");
                    $('#value-1').show();
                    $('#value-2').hide();
                    $('#md-name').hide();

                }


                if(get_data === 'M'){
                    $("label[for='md-name']").text("Medicine");
                    $("label[for='value1']").text("Dose");
                    $("label[for='value2']").text("Duration");
                    $("label[for='value3']").text("Instruction");
                    $('#value-1').show();
                    $('#value-2').show();
                    $('#md-name').show();
                }

            });


        });



        $(function (){
            $(document).on("focus", "input:text", function() {
                $(this).select();
            });
        });

    </script>

@endpush