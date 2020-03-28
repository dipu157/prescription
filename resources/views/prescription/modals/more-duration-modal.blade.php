<div class="modal fade right" id="modal-add-dose-duration" tabindex="-1" role="dialog" aria-labelledby="modal-add-dose-duration-label"
     aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-info" role="document">
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

                                    <input type="hidden" name="for-medicine-advice-id" id="for-medicine-advice-id">


                                    <div class="form-group row">
                                        <label for="new_dose" class="col-sm-3 col-form-label">Dose</label>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-3">

                                                <input type="text" name="new_dose" id="new_dose" class="form-control" autofocus>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="new_duration" class="col-sm-3 col-form-label">Duration</label>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-3">

                                                <input type="text" name="new_duration" id="new_duration" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="new_instruction" class="col-sm-3 col-form-label">Instructions</label>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-3">

                                                <input type="text" name="new_instruction" id="new_instruction" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>


            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
                <button type="submit" class="btn btn-primary btn-extra-dose-save">Save</button>
                <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</a>
            </div>

        </div>
        <!--/.Content-->
    </div>
</div>
<!-- Modal: modalAbandonedCart-->

