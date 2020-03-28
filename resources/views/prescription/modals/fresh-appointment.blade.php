<div class="modal fade right" id="modal-fresh-appointment" tabindex="-1" role="dialog" aria-labelledby="modal-fresh-appointment-label"
     aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-info" role="document">
        <!--Content-->
        <form action="{{ url('prescription/template/save') }}"  method="post" accept-charset="utf-8">
            {{ csrf_field() }}

            <div class="modal-content">
                <!--Header-->
                <div class="modal-header" style="background-color: #17A2B8;">
                    <p class="heading">New Appointment
                    </p>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>

                <!--Body-->
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card text-primary bg-gray border-primary">

                                <div class="card-body">

                                    <div class="form-group row">
                                        <label for="template_type" class="col-md-4 col-form-label text-md-right">Template For</label>
                                        <div class="col-md-8">
                                            {!! Form::select('item_type',array('M' => 'Medicine', 'A' => 'Advice'),null,array('id'=>'item_type','class'=>'form-control','autofocus')) !!}
                                        </div>
                                    </div>

                                    <div class="form-group row" id="md-name">
                                        <label for="food_allergies" class="col-sm-4 col-form-label text-md-right">Item Name</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <input type="text" name="item_name" id="item_name" class="form-control typeahead" autocomplete="off">
                                                <input type="hidden" name="item_id" id="item_id">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="value1" class="col-sm-4 col-form-label text-md-right">Dose</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <input type="text" name="value1" id="value1" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="value2" class="col-sm-4 col-form-label text-md-right">Duration</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <input type="text" name="value2" id="value2" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="value3" class="col-sm-4 col-form-label text-md-right">Instruction</label>
                                        <div class="col-sm-8">
                                            <div class="input-group mb-3">
                                                <input type="text" name="value3" id="value3" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Footer-->
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Cancel</a>
                </div>

            </div>
            <!--/.Content-->
        </form>
    </div>
</div>
<!-- Modal: modalAbandonedCart-->