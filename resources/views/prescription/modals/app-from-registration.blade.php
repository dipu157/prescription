<div class="modal fade right" id="modal-app-from-registration" tabindex="-1" role="dialog" aria-labelledby="modal-new-templare-label"
     aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-info" role="document">
        <!--Content-->

            <div class="modal-content">
                <!--Header-->
                <div class="modal-header" style="background-color: #17A2B8;">
                    <p class="heading">Appointment From UH ID Number
                    </p>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>

                <!--Body-->
                <div class="modal-body">

                    <div class="md-form input-group">
                        <input type="text" name="uh_id" id="uh_id" class="form-control" placeholder="Insert UH ID" autofocus>
                        <div class="input-group-prepend">
                            <button class="btn btn-reg-new btn-unique waves-effect m-0 btn-reg-get" type="button">Submit</button>
                        </div>
                    </div>

                    <form action="{!! url('appointment/registration/save') !!}" class="form-inner" method="post" accept-charset="utf-8">
                        {{ csrf_field() }}

                        <table class="table">

                                <tbody>
                                    <tr>
                                        <th scope="row">Registration No</th>
                                        <td>:</td>
                                        <td id="registration_no"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Name</th>
                                        <td>:</td>
                                        <td id="patient_name"></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Birth Date</th>
                                        <td>:</td>
                                        <td id="patient_dob"></td>
                                    </tr>
                                </tbody>

                        </table>

                        <button type="submit" id="btn-app-reg" name="btn-app-reg" class="btn btn-primary btn-app-reg">Save</button>
                        <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</a>

                    </form>
                </div>


            </div>
            <!--/.Content-->
    </div>
</div>
<!-- Modal: modalAbandonedCart-->

<script>

    $(document).on('click', '.btn-reg-new', function (e) {
       e.preventDefault();


        var url = 'getregdata/' + $('#uh_id').val();

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            data: {method: '_GET', submit: true },

            error: function (request, status, error) {
                alert(request.responseText);
            },

            success: function (data) {

                // $(".historydata").remove();

                m_name = (data.middle_name == null) ? '' : data.middle_name;
                fm_name = (data.family_name == null) ? '' : data.family_name;
                title = (data.ptitle == null) ? '' : data.ptitle;

                document.getElementById('registration_no').innerHTML = data.registration_no;
                document.getElementById('patient_name').innerHTML = title + ' ' + data.first_name + ' ' + m_name + ' ' + fm_name;
                document.getElementById('patient_dob').innerHTML = data.date_of_birth;

                document.getElementById('btn-app-reg').value= data.registration_no;


            }

        });
    });

</script>