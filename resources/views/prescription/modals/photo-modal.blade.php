<!-- To change the direction of the modal animation change .right class -->
<div class="modal fade right" id="photo-update-modal" tabindex="-1" role="dialog" aria-labelledby="photo-update-modalLabel" aria-hidden="true">

    <!-- Add class .modal-side and then add class .modal-top-right (or other classes from list above) to set a position to the modal -->
    <div class="modal-dialog modal-side modal-top-right" role="document">


        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="myModalLabel">Update Photo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" role="form" method="POST" action="{!! url('photo/update') !!}" accept-charset="UTF-8" enctype="multipart/form-data">

                <div class="modal-body">

                    {{ csrf_field() }}

                    {{--<input type="hidden" name="id" id="id" value="">--}}

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4 col-example">Image</div>
                            <div class="col-md-6 ml-auto col-example">
                                <img src="" class="imagepreview" style="width: 100%;" >
                            </div>
                        </div>
                        <br>

                        <div class="row">
                            {{--<div class="col-md-4 col-example"></div>--}}
                            <div class="col-md-10 ml-auto col-example">
                                <input type="file" name="imagefilename" id="imagefilename" class="form-control" onchange="return imageFileValidation()">
                            </div>
                        </div>

                        <div class="col-md-4" id="imagePreview"></div>
                        <br>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="buttonvalue" class="btn btn-primary" value="{!! $prescription->appointment_id !!}">Save changes</button>
            </div>

            </form>
        </div>
    </div>
</div>
<!-- Side Modal Top Right -->