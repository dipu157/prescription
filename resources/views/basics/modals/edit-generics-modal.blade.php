<div class="modal fade right" id="modal-edit-generic" tabindex="-1" role="dialog" aria-labelledby="modal-edit-generic-label"
     aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-info modal-lg" role="document">
        <!--Content-->
        <form action="#" method="post" accept-charset="utf-8">
            <div class="modal-content">
                <!--Header-->
                <div class="modal-header" style="background-color: rgba(28,212,238,0.14);">
                    <p class="heading">Edit Generic Info</p>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>

                <!--Body-->

                <div class="modal-body">


                    <div class="col-sm-12">
                        <div class="card text-primary bg-gray border-primary">

                            <div class="card-body">

                                {{ csrf_field() }}

                                <div class="form-group row">
                                    <label for="new_generic_name" class="col-sm-3 col-form-label">Generic Name</label>
                                    <div class="col-sm-9">
                                        <div class="input-group mb-3">
                                            <input type="text" name="name" id="edit_name" class="form-control" required autofocus>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="id" id="row_id" class="form-control" required>

                                <div class="form-group row">
                                    <label for="new_generic_description" class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <div class="input-group mb-3">

                                            <input type="text" name="description" id="edit_description" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="new_generic_description" class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-9">
                                        <div class="input-group mb-3">

                                            {!! Form::checkbox('edit_status',null,false, array('id'=>'edit_status')) !!}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Footer-->
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-edit-generic">Save</button>
                    <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</a>
                </div>

            </div>
        </form>
        <!--/.Content-->
    </div>
</div>
<!-- Modal: modalAbandonedCart-->

