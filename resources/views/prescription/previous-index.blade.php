@extends('layouts.master')

@section('pagetitle')
    <h2 class="no-margin-bottom">Previous Prescriptions</h2>
@endsection
@section('content')
    <script type="text/javascript" src="{!! asset('assets/js/jquery-3.3.1.min.js') !!}"></script>
    <link href="{!! asset('assets/tabs/css/style.css') !!}" rel="stylesheet" type="text/css" />

    @include('partials.flash-message')

    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12" style="overflow-x:auto;">
                <table class="table table-bordered table-hover table-striped" id="terms-table">
                    <thead style="background-color: #b0b0b0">
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Reg No</th>
                        <th>Visited On</th>
                        <th>Diagnosis</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div> <!--/.Container-->

    @include('prescription.modals.previous-advices')
{{--    @include('prescription.modals.fresh-appointment')--}}
{{--    @include('prescription.modals.patient-update-modal')--}}

@endsection

@push('scripts')

    <script>
        $(function() {
            var table= $('#terms-table').DataTable({
                processing: true,
                serverSide: true,
                autoWidth: false,
                responsive: true,
                ajax: 'previousdata',
                columns: [
                    { data: 'patient.name', name: 'patient.name' },
                    { data: 'patient.age', name: 'patient.age' },
                    { data: 'patient.registration_no', name: 'patient.registration_no' },
                    { data: 'patient.visit_date', name: 'patient.visit_date' },
                    { data: 'diagnosis', name: 'diagnosis' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, printable: false}
                ]
            });


            $(this).on("click", ".btn-previous", function (e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var url = $(this).data('remote');

                // confirm then
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'json',

                    data: {method: '_POST', submit: true,
                    },

                    error: function (request, status, error) {
                        alert(request.responseText);
                    },

                    success: function (data) {

                        $(".medicinedata").remove();
                        var trHTML = '';

                        $.each(data.amedicine, function (i, item) {
                            trHTML += '<tr class="medicinedata">' +
                                '<td align="left">' + item.medicine.name + '</td>' +
                                '<td align="left">' + item.dose + '</td>' +
                                '<td>' +  item.duration + '</td>' +
                                '<td align="left">' + item.advice + '</td></tr>';
                        });

                        $('#medicine-table').append(trHTML);

                        $(".investigationdata").remove();
                        var trHTML = '';

                        $.each(data.adiagnosis, function (i, item) {
                            trHTML += '<tr class="investigationdata">' +
                                '<td align="left">' + item.diagnosis.name + '</td>' +
                                '<td align="left">' + item.advice + '</td></tr>';
                        });

                        $('#invest-table').append(trHTML);

                        $(".advicedata").remove();
                        var trHTML = '';

                        $.each(data.gadvice, function (i, item) {
                            trHTML += '<tr class="advicedata">' +
                                '<td align="left">' + item.advice + '</td></tr>';
                        });

                        $('#advice-table').append(trHTML);
                    }

                });
            });

            $("body").on("click", ".btn-print", function (e) {
                e.preventDefault();

                var url = $(this).data('remote');
                window.location.href = url;

            });

        });

        $(function (){
            $(document).on("focus", "input:text", function() {
                $(this).select();
            });
        });

    </script>
@endpush