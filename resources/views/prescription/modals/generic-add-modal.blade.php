<div class="modal fade right" id="modal-add-generic" tabindex="-1" role="dialog" aria-labelledby="modal-add-generic-label"
     aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-info" role="document">
        <!--Content-->

        <div class="modal-content">
            <!--Header-->
            <div class="modal-header" style="background-color: #17A2B8;">
                <p class="heading">Add New Generic </p>
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


                                <div class="form-group row">
                                    <label for="new_generic_name" class="col-sm-3 col-form-label">Generic Name</label>
                                    <div class="col-sm-9">
                                        <div class="input-group mb-3">

                                            <input type="text" name="new_generic_name" id="new_generic_name" class="form-control" required autofocus>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="new_generic_description" class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <div class="input-group mb-3">

                                            <input type="text" name="new_generic_description" id="new_generic_description" class="form-control">
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
                <button type="submit" class="btn btn-primary btn-add-generic-save">Save</button>
                <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</a>
            </div>

        </div>
        <!--/.Content-->
    </div>
</div>
<!-- Modal: modalAbandonedCart-->

