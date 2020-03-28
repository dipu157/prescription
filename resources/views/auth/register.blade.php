@extends('layouts.master')

@section('content')

    <script type="text/javascript" src="{!! asset('assets/js/jquery-3.3.1.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('assets/js/bootstrap3-typeahead.js') !!}"></script>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="role_id" class="col-md-4 col-form-label text-md-right">Select Role</label>

                                <div class="col-md-6">

                                    {!! Form::select('role_id',$roles,null,array('id'=>'role_id','class'=>'form-control','autofocus')) !!}

                                </div>
                            </div>

                            {{--<div class="form-group row">--}}
                                {{--<label for="emp_id" id="doctor_label" class="col-md-4 col-form-label text-md-right">Select Name</label>--}}

                                {{--<div class="col-md-6">--}}

                                    {{--{!! Form::select('doctor_id',$data,null,array('id'=>'doctor_id','class'=>'form-control','autofocus', 'placeholder'=>'Please Select')) !!}--}}

                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group row">
                                <label for="emp_id" id="doctor_label" class="col-md-4 col-form-label text-md-right">Enter Name</label>

                                <div class="col-md-6">

                                    <input id="d_name" type="text" class="form-control typeahead" name="d_name" autocomplete="off" required>
                                    <input id="doctor_id" type="hidden"  name="doctor_id" required>

                                </div>
                            </div>


                            <div class="form-group row" id="person_name">
                                <label for="name" id="label_name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="your-id@brbhospital.com" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>


        $(document).ready(function(){

            // $('#person_name').hide();

            $('#role_id').change(function() {
                // alert($('#role_id').val());


                var x = $('#role_id').val();

                if(x == 1)
                {
                    // $('#person_name').hide();
                    $("#doctor_label").html("Doctor Name");

                }
                if(x == 2)
                {
                    // $('#person_name').show();
                    $("#doctor_label").html("Attached With");
                    $("#label_name").html($('#role_id :selected').text() + "Name");
                }
                if(x == 3)
                {
                    // $('#person_name').show();
                    $("#doctor_label").html("Attached With");
                    $("#label_name").html($('#role_id :selected').text() + " " + " Name");

                }

                // document.getElementById('name').value = $('#role_id :selected').text();
            });

            $('#doctor_id').change(function() {

                document.getElementById('name').value = $('#doctor_id :selected').text();
            });



            var autocomplete_path = "{{ url('autocomplete/doctors') }}";

            $(document).on('click', '.form-control.typeahead', function() {

                $(this).typeahead({
                    minLength: 2,
                    displayText:function (data) {
                        return data.name;
                    },
                    source: function (query, process) {
                        $.ajax({
                            url: autocomplete_path,
                            type: 'GET',
                            dataType: 'JSON',
                            data: 'query=' + query ,
                            success: function(data) {
                                return process(data);
                            }
                        });
                    },
                    afterSelect: function (data) {

                        document.getElementById('doctor_id').value = data.id;
                        document.getElementById('name').value = data.name;

                    }
                });
            });



        });


// Get Doctors




    </script>
@endpush
