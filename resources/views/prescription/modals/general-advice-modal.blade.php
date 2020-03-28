{{--General Advice Modal--}}

<!-- Modal -->
<div class="modal fade" id="modal-general-advice" tabindex="-1" role="dialog" aria-labelledby="adviceModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0480be;">
                <h5 class="modal-title" id="exampleModalLongTitle">List of Advices</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table responstable table-striped table-hover">
                    <thead style="background-color: #167F92">
                    <tr>
                        <th>Check</th>
                        <th>Advice</th>
                    </tr>
                    </thead>

                    @if(!empty($advices))

                        @foreach($advices as $row)

                            <tr>
                                <td><input type="checkbox" name="advice_check[]" class="advice_check" id="advice_check" value="{!! $row->value1 !!}"></td>
                                <input type="hidden" name="advice_id[]" class="advice_id" value="{!! $row->value1 !!}" id="advice_id" >
                                <td class="advice_text" id="advice_text">{!! $row->value1 !!}</td>
                            </tr>

                        @endforeach
                    @endif
                </table>
            </div>
            <div class="modal-footer" style="background-color: #0480be;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-g-advice">Save changes</button>
            </div>
        </div>
    </div>
</div>

{{--End Advice Modal--}}