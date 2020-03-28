@extends('layouts.master')

@section('pagetitle')
    <h2 class="no-margin-bottom">Investigations</h2>
@endsection
@section('content')
    <script type="text/javascript" src="{!! asset('assets/js/jquery-3.3.1.min.js') !!}"></script>

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">
                <div class="pull-left">
                    <button type="button" class="btn btn-investigation btn-success" data-toggle="modal" data-target="#modal-new-investigation"><i class="fa fa-plus"></i>New</button>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12" style="overflow-x:auto;">
                <table class="table table-bordered table-hover table-striped" id="investigations-table">
                    <thead style="background-color: #b0b0b0">
                    <tr>
                        <th>Name</th>
                        <th>Sample</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div> <!--/.Container-->

    @include('basics.modals.new-investigations')
    @include('basics.modals.modal-edit-investigation')

@endsection

@push('scripts')

    <script>
        $(function() {
            var table= $('#investigations-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                ajax: 'investigationsTabledata',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'sample', name: 'sample' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, printable: false}
                ]
            });


            $(this).on("click", ".btn-investigation-edit", function (e) {
                e.preventDefault();

                var data_rowid = $(this).data('rowid');
                var data_name = $(this).data('name');
                var data_sample = $(this).data('sample');

                document.getElementById('edit_name').value=data_name;
                document.getElementById('edit_sample').value=data_sample;
                document.getElementById('row_id').value=data_rowid;

            });


            // $("body").on("click", ".btn-create", function (e) {
            //     e.preventDefault();
            //
            //     var url = $(this).data('remote');
            //     window.location.href = url;
            //
            // });



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