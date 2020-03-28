<!-- Modal -->
<div class="modal fade" id="previous-prescription-modal" tabindex="-1" role="dialog" aria-labelledby="previous-prescription-modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 100%; padding: 0" role="document">
        <div class="modal-content" style="width: 100%; padding: 0">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="previous-prescription-modalTitle">Privious Prescription of : {!! $appointment->name !!} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="prev-table" class="table-striped table-bordered history-table">
                    <thead style="background-color: #8eb4cb">
                    <tr>
                        <th width="10%" class="text-left">Date</th>
                        <th width="35%" class="text-left">Medicine</th>
                        <th width="25%" class="text-center">Investigation</th>
                        <th width="20%" class="text-center">Advice</th>
                        <th width="5%" class="text-center">Copy</th>
                        <th width="5%" class="text-center">Action</th>
                    </tr>
                    </thead>
                        <tbody>
                        <input type="hidden" name="current_id" id="current_id" value="{!! $prescription->id !!}" class="form-control"/>

                            @foreach($previous as $row)
                                <tr>
                                    <td>{!! $row->record_date !!}</td>
                                    <td>
                                        @foreach($row->amedicine as $med)

                                            {!! $med->medicine->name !!}<br/>

                                        @endforeach
                                    </td>

                                    <td>
                                        @foreach($row->adiagnosis as $invg)

                                            {!! $invg->diagnosis->name !!}<br/>

                                        @endforeach
                                    </td>

                                    <td>
                                        @foreach($row->gadvice as $adv)

                                            {!! $adv->advice !!}<br/>

                                        @endforeach

                                    </td>
                                    <td><input type="checkbox" name="copy_id[]" class="copy_id" id="copy_id" value="{!! $row->id !!}"></td>
                                    {{--<input type="hidden" name="prev_id" id="prev_id" value="{!! $prescription->id !!}" class="form-control"/>--}}
                                    {{--<input type="hidden" name="advice_id[]" class="advice_id" value="{!! $row->value1 !!}" id="advice_id" >--}}

                                    <td><button type="submit" class="btn btn-secondary btn-previous-copy">Submit</button></td>
                                </tr>


                            @endforeach

                        </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).on('click', '.btn-previous-copy', function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var url = 'copy/previous/save';

        var s1 = [];
        $("input[name='copy_id[]']:checked:enabled").each(function() {

            var row = [];
            row.push($(this).val());
            s1.push(row);
        });

        // confirm then
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',

            data: {method: '_POST', submit: true,
                current_id:$('#current_id').val(), prev_id:s1,
            },

            error: function (request, status, error) {
                alert(request.responseText);
            },

            success: function (data,status) {

                document.getElementById('complains').value = (data.data.complaints);
                document.getElementById('diagnosis').value = (data.data.diagnosis);


                $('#medicine-table').DataTable().draw(false);
                $('#diagnosis-table').DataTable().draw(false);
                $('#advices-table').DataTable().draw(false);

                $('#previous-prescription-modal').modal('hide');

            }

        });
    });


</script>