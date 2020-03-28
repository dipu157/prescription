@extends('layouts.master')

@section('pagetitle')
    <h2 class="no-margin-bottom">Patient Appointment</h2>
@endsection
@section('content')
    <script type="text/javascript" src="{!! asset('assets/js/jquery-3.3.1.min.js') !!}"></script>

    @include('partials.flash-message')

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">
                <div class="pull-left">
                    <button type="button" class="btn btn-register btn-success" data-toggle="modal" data-target="#modal-app-from-registration"><i class="fa fa-plus"></i>New From Registration</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="pull-left">
                    <button type="button" class="btn btn-fresh btn-info" data-toggle="modal" data-target="#modal-fresh-appointment"><i class="fa fa-plus"></i>Fresh</button>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12" style="overflow-x:auto;">
                <table class="table table-bordered table-hover table-striped" id="terms-table">
                    <thead style="background-color: #b0b0b0">
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Reg No</th>
                        <th>Mobile</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div> <!--/.Container-->

    @include('prescription.modals.app-from-registration')
    @include('prescription.modals.fresh-appointment')
    @include('prescription.modals.patient-update-modal')

@endsection

@push('scripts')

    <script>
        $(function() {
            var table= $('#terms-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                pageLength: 50,
                ajax: 'tabledata',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'age', name: 'age' },
                    { data: 'registration_no', name: 'registration_no' },
                    { data: 'mobile', name: 'mobile' },
                    { data: 'visit', name: 'visit' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, printable: false}
                ]
            });


            $('#terms-table').on("click", ".btn-patient-edit", function (e) {
                e.preventDefault();

                var data_id = $(this).data('rowid');
                var data_title = $(this).data('title');

                var data_fname = $(this).data('firstname');
                var data_mname = $(this).data('middlename');
                var data_lname = $(this).data('lastname');
                var data_page = $(this).data('page');

                document.getElementById('appointment-id').value=data_id;
                document.getElementById('patient-title').value=data_title;
                document.getElementById('first_name').value=data_fname;
                document.getElementById('middle_name').value=data_mname;
                document.getElementById('last_name').value=data_lname;
                document.getElementById('p_age').value=data_page;

            });


            $("body").on("click", ".btn-create", function (e) {
                e.preventDefault();

                var url = $(this).data('remote');
                window.location.href = url;

            });



        });

// Patient Name Update

        $(document).on('click', '.btn-patient-data-update', function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var url = 'patient/update';

            // confirm then
            $.ajax({
                url: url,
                type: 'POST',
                dataType: 'json',

                data: {method: '_POST', submit: true, app_id:$('#appointment-id').val(),
                    title:$('#patient-title').val(),
                    first_name:$('#first_name').val(), middle_name:$('#middle_name').val(),
                    last_name:$('#last_name').val(),p_age:$('#p_age').val(),
                },

                error: function (request, status, error) {
                    alert(request.responseText);
                },

                success: function (data) {

                    $('#patient-update-modal').modal('hide');
                    $('#terms-table').DataTable().draw(false);

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