@extends('layouts.master')

@section('pagetitle')
    <h2 class="no-margin-bottom">Manufacturer</h2>
@endsection
@section('content')
    <script type="text/javascript" src="{!! asset('assets/js/jquery-3.3.1.min.js') !!}"></script>

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-6">
                <div class="pull-left">
                    <button type="button" class="btn btn-manufacturer btn-success" data-toggle="modal" data-target="#modal-new-manufacturer"><i class="fa fa-plus"></i>New</button>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12" style="overflow-x:auto;">
                <table class="table table-bordered table-hover table-striped" id="manufacturer-table">
                    <thead style="background-color: #b0b0b0">
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div> <!--/.Container-->

    @include('basics.modals.new-manufacturer-modal')
    @include('basics.modals.edit-manufacturer-modal')

@endsection

@push('scripts')

    <script>
        $(function() {
            var table= $('#manufacturer-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                ajax: 'manufacturerTabledata',
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, printable: false}
                ]
            });


            $(this).on("click", ".btn-manufacturer-edit", function (e) {
                e.preventDefault();

                var data_rowid = $(this).data('rowid');
                var data_name = $(this).data('name');
                var data_description = $(this).data('description');
                var data_status = $(this).data('status');

                document.getElementById('edit_name').value=data_name;
                document.getElementById('edit_description').value=data_description;
                document.getElementById('row_id').value=data_rowid;

                // alert(data_status);


                if(data_status === 1)
                {
                    document.getElementById("edit_status").checked= true;
                }

            });


            $(this).on('click', '.btn-edit-manufacturer', function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var url = 'update';

                var chk_status = $("#edit_status").is(":checked") ? 1 : 0;

                // confirm then
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',

                    data: {method: '_POST', submit: true, id:$('#row_id').val(),
                        name:$('#edit_name').val(),
                        description:$('#edit_description').val(),
                        status:chk_status,

                    },

                    error: function (request, status, error) {
                        alert(request.responseText);
                    },

                    success: function (data) {

                        $('#modal-edit-manufacturer').modal('hide');
                        $('#manufacturer-table').DataTable().draw(false);

                    }

                });
            });


        });

        $(function (){
            $(document).on("focus", "input:text", function() {
                $(this).select();
            });
        });

    </script>






@endpush