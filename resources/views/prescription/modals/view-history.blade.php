<!-- Modal -->
<div class="modal fade" id="view-history-modal" tabindex="-1" role="dialog" aria-labelledby="view-history-modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" style="width: 100%; padding: 0" role="document">
        <div class="modal-content" style="width: 100%; padding: 0">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="view-history-modalTitle">History of : {!! $appointment->name !!} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="history-table" class="table-striped table-bordered history-table">
                    <thead style="background-color: #8eb4cb">
                        <tr>
                            <th style="width: 8%">Date</th>
                            <th style="width: 8%">Food Allergies</th>
                            <th style="width: 8%">Tendency Bleed</th>
                            <th style="width: 8%">Heart Disease</th>
                            <th style="width: 8%">High <br/>Blood <br/>Pressure</th>
                            <th style="width: 8%">Diabetic</th>
                            <th style="width: 8%">Surgery</th>
                            <th style="width: 8%">Accident</th>
                            <th style="width: 8%">Others</th>
                            <th style="width: 8%">Family <br/>Medical <br/>History</th>
                            <th style="width: 8%">Female <br/>Pregnancy </th>
                            <th style="width: 8%">Breast Feeding</th>
                        </tr>
                    </thead>
                    <tbody>
                    <td id="name_p"></td>

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>