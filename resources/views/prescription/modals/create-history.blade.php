<!-- Modal -->
<div class="modal fade" id="create-history-modal" tabindex="-1" role="dialog" aria-labelledby="create-history-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">History of {!! $appointment->name !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row container-fluid">

                    <div class="col-sm-12">
                        <div class="card text-primary bg-gray border-primary">

                            <div class="card-body">

                                <form action="#" class="form-inner" method="post" accept-charset="utf-8">
                                    {{ csrf_field() }}


                                    <div class="form-group row">
                                        <label for="food_allergies" class="col-sm-3 col-form-label">Food Allergies</label>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <input type="checkbox" name="chk_food_allergies" id="chk_food_allergies" aria-label="Checkbox for following text input">
                                                    </div>
                                                </div>
                                                <input type="text" name="food_allergies" id="food_allergies" class="form-control" aria-label="Text input with checkbox">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="food_allergies" class="col-sm-3 col-form-label">Tendency Bleed</label>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <input type="checkbox" id="chk_tendency_bleed" name="chk_tendency_bleed" aria-label="Checkbox for following text input">
                                                    </div>
                                                </div>
                                                <input type="text" name="tendency_bleed" id="tendency_bleed" class="form-control" aria-label="Text input with checkbox">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="food_allergies" class="col-sm-3 col-form-label">Heart Disease</label>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <input type="checkbox" name="chk_heart_disease" id="chk_heart_disease" aria-label="Checkbox for following text input">
                                                    </div>
                                                </div>
                                                <input type="text" name="heart_disease" id="heart_disease" class="form-control" aria-label="Text input with checkbox">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="food_allergies" class="col-sm-3 col-form-label">High Blood Pressure</label>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <input type="checkbox" name="chk_hbp" id="chk_hbp" aria-label="Checkbox for following text input">
                                                    </div>
                                                </div>
                                                <input type="text" name="hbp" id="hbp" class="form-control" aria-label="Text input with checkbox">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="food_allergies" class="col-sm-3 col-form-label">Diabetic</label>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <input type="checkbox" name="chk_diabetic" id="chk_diabetic" aria-label="Checkbox for following text input">
                                                    </div>
                                                </div>
                                                <input type="text" name="diabetic" id="diabetic" class="form-control" aria-label="Text input with checkbox">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="food_allergies" class="col-sm-3 col-form-label">Surgery</label>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <input type="checkbox" name="chk_surgery" id="chk_surgery" aria-label="Checkbox for following text input">
                                                    </div>
                                                </div>
                                                <input type="text" name="surgery" id="surgery" class="form-control" aria-label="Text input with checkbox">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="food_allergies" class="col-sm-3 col-form-label">Accident</label>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <input type="checkbox" name="chk_accident" id="chk_accident" aria-label="Checkbox for following text input">
                                                    </div>
                                                </div>
                                                <input type="text" name="accident" id="accident" class="form-control" aria-label="Text input with checkbox">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="food_allergies" class="col-sm-3 col-form-label">Family Medical History</label>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <input type="checkbox" name="chk_fmh" id="chk_fmh" aria-label="Checkbox for following text input">
                                                    </div>
                                                </div>
                                                <input type="text" name="fmh" id="fmh" class="form-control" aria-label="Text input with checkbox">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="food_allergies" class="col-sm-3 col-form-label">Current Medication</label>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <input type="checkbox" name="chk_current_medication" id="chk_current_medication" aria-label="Checkbox for following text input">
                                                    </div>
                                                </div>
                                                <input type="text" name="current_medication" id="current_medication" class="form-control" aria-label="Text input with checkbox">
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label for="food_allergies" class="col-sm-3 col-form-label">Others</label>
                                        <div class="col-sm-9">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <input type="checkbox" name="chk_others" id="chk_others" aria-label="Checkbox for following text input">
                                                    </div>
                                                </div>
                                                <input type="text" name="others" id="others" class="form-control" aria-label="Text input with checkbox">
                                            </div>
                                        </div>
                                    </div>



                                    @if($appointment->gender == 'F')

                                        <div class="form-group row">
                                            <label for="food_allergies" class="col-sm-3 col-form-label">Female Pregnancy</label>
                                            <div class="col-sm-9">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <input type="checkbox" name="chk_female_pregnancy" id="chk_female_pregnancy" aria-label="Checkbox for following text input">
                                                        </div>
                                                    </div>
                                                    <input type="text" name="female_pregnancy" id="female_pregnancy" class="form-control" aria-label="Text input with checkbox">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="food_allergies" class="col-sm-3 col-form-label">Breast Feeding</label>
                                            <div class="col-sm-9">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">
                                                            <input type="checkbox" name="chk_breast_feeding" id="chk_breast_feeding" aria-label="Checkbox for following text input">
                                                        </div>
                                                    </div>
                                                    <input type="text" name="breast_feeding" id="breast_feeding" class="form-control" aria-label="Text input with checkbox">
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary btn-create-history">Save changes</button>
            </div>
        </div>
    </div>
</div>
