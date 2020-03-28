<div class="modal fade right" id="patient-update-modal" tabindex="-1" role="dialog" aria-labelledby="patient-update-modal-label"
     aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <!--Content-->

        <div class="modal-content">
            <!--Header-->
            <div class="modal-header" style="background-color: #17A2B8;">
                <p class="heading">Add More Medicine Dose For : </p>
                <p id="medicine_name" style="color: RED"></p>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="white-text">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">


                <div class="col-sm-12">
                    <div class="card text-primary bg-gray border-primary">

                        <div class="card-body">

                            <form action="#" class="form-inner" method="post" accept-charset="utf-8">
                                {{ csrf_field() }}

                                <input type="hidden" name="appointment-id" id="appointment-id">

                                <div class="form-group row">
                                    <label for="patient-title" class="col-sm-3 col-form-label">Title</label>
                                    <div class="col-sm-9">
                                        <div class="input-group mb-3">

                                            <input type="text" name="patient-title" id="patient-title" class="form-control" autofocus>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="first_name" class="col-sm-3 col-form-label">First Name</label>
                                    <div class="col-sm-9">
                                        <div class="input-group mb-3">

                                            <input type="text" name="first_name" id="first_name" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="middle_name" class="col-sm-3 col-form-label">Middle Name</label>
                                    <div class="col-sm-9">
                                        <div class="input-group mb-3">

                                            <input type="text" name="middle_name" id="middle_name" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="last_name" class="col-sm-3 col-form-label">Last Name</label>
                                    <div class="col-sm-9">
                                        <div class="input-group mb-3">
                                            <input type="text" name="last_name" id="last_name" class="form-control">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="p_age" class="col-sm-3 col-form-label">Age</label>
                                    <div class="col-sm-9">
                                        <div class="input-group mb-3">
                                            <input type="text" name="p_age" id="p_age" class="form-control">
                                        </div>
                                    </div>
                                </div>


                                {{--<div class="form-group row">--}}
                                    {{--<label for="patient-name" class="col-sm-3 col-form-label">Name</label>--}}
                                    {{--<div class="col-sm-9">--}}
                                        {{--<div class="input-group mb-3">--}}

                                            {{--<input type="text" name="patient-name" id="patient-name" class="form-control" autofocus>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}



                            </form>
                        </div>
                    </div>
                </div>


            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
                <button type="submit" class="btn btn-primary btn-patient-data-update">Save</button>
                <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</a>
            </div>

        </div>
        <!--/.Content-->
    </div>
</div>
<!-- Modal: modalAbandonedCart-->

