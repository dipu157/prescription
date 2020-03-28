<div class="modal fade right" id="modal-add-medicine" tabindex="-1" role="dialog" aria-labelledby="modal-add-medicine-label"
     aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-info" role="document">
        <!--Content-->

        <div class="modal-content">
            <!--Header-->
            <div class="modal-header" style="background-color: #17A2B8;">
                <p class="heading">Add New Medicine </p>
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
                                    <label for="generic_id" class="col-sm-3 col-form-label">Generic</label>
                                    <div class="col-sm-9">
                                        <div class="input-group mb-3">

                                            <input type="text" name="new_dose" id="new_dose" class="form-control typeahead_g" autofocus>
                                            <input type="hidden" name="generics_id" id="generics_id">

                                        </div>
                                    </div>
                                </div>




                                <div class="form-group row">
                                    <label for="manufacturer_id" class="col-sm-3 col-form-label">Manufacturer</label>
                                    <div class="col-sm-9">
                                        <div class="input-group mb-3">

                                            {!! Form::select('manufacturer_id', $manufacturers , null , array('id' => 'manufacturer_id', 'class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="new_medicine_name" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <div class="input-group mb-3">

                                            <input type="text" name="new_medicine_name" id="new_medicine_name" class="form-control" autofocus>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="new_strength_id" class="col-sm-3 col-form-label">Strength</label>
                                    <div class="col-sm-9">
                                        <div class="input-group mb-3">

                                            {!! Form::select('new_strength_id', $strengths , null , array('id' => 'new_strength_id', 'class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="new_type_id" class="col-sm-3 col-form-label">Types</label>
                                    <div class="col-sm-9">
                                        <div class="input-group mb-3">

                                            {!! Form::select('new_type_id', $types , null , array('id' => 'new_type_id', 'class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                </div>




                                <div class="form-group row">
                                    <label for="new_medicine_dose" class="col-sm-3 col-form-label">Dose</label>
                                    <div class="col-sm-9">
                                        <div class="input-group mb-3">

                                            <input type="text" name="new_medicine_dose" id="new_medicine_dose" class="form-control" autofocus>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="new_medicine_duration" class="col-sm-3 col-form-label">Duration</label>
                                    <div class="col-sm-9">
                                        <div class="input-group mb-3">

                                            <input type="text" name="new_medicine_duration" id="new_medicine_duration" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="new_medicine_instruction" class="col-sm-3 col-form-label">Instructions</label>
                                    <div class="col-sm-9">
                                        <div class="input-group mb-3">

                                            <input type="text" name="new_medicine_instruction" id="new_medicine_instruction" class="form-control">
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
                <button type="submit" class="btn btn-primary btn-add-medicine-save">Save</button>
                <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</a>
            </div>

        </div>
        <!--/.Content-->
    </div>
</div>
<!-- Modal: modalAbandonedCart-->

