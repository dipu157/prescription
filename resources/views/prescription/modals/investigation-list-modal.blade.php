{{--General Advice Modal--}}

<!-- Modal -->
<div class="modal fade" id="modal-investigation-advice" tabindex="-1" role="dialog" aria-labelledby="investigationModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: rgba(4,152,226,0.23);">
                <h5 class="modal-title" id="investigationModalLongTitle">List of Investigations</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table responstable table-striped table-hover">
                    <thead style="background-color: rgba(46,203,246,0.08)">
                    <tr>
                        <th>Check</th>
                        <th>Investigations</th>
                    </tr>
                    </thead>

                    @if(!empty($investigations))

                        @foreach($investigations as $row)

                            <tr>
                                <td><input type="checkbox" name="investigation_check[]" class="investigation_check" id="investigation_check" value="{!! $row->id !!}"></td>
                                {{--<input type="hidden" name="investigation_id[]" class="investigation_id" value="{!! $row->item_id !!}" id="investigation_id" >--}}
                                <td class="investigation_text" id="advice_text">{!! $row->investigation->name !!}</td>
                            </tr>

                        @endforeach
                    @endif
                </table>
            </div>
            <div class="modal-footer" style="background-color: rgba(4,152,226,0.23);">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-investigation-advice">Save changes</button>
            </div>
        </div>
    </div>
</div>

{{--End Advice Modal--}}