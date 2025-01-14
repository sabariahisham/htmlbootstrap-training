@extends('layouts.app')

@section('title', 'Forms')

@section('head')

@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
    <li class="breadcrumb-item active">Forms</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Form Control</div>
                <div class="card-body">
                    {{-- <div class="row">
                        <div class="col">
                            <input type="text" name="" class="form-control" placeholder="Nama" id="">
                        </div>
                        <div class="col">
                            <input type="text" name="" class="form-control" placeholder="Email" id="">
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="card">
                <div class="card-header">Form With Label</div>
                <div class="card-body">
                    {{-- <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="form-control"
                                    placeholder=""
                                    aria-describedby="helpId"
                                />
                            </div>

                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    class="form-control"
                                    placeholder=""
                                    required
                                    aria-describedby="helpId"
                                />
                            </div>
                        </div>
                    </div> --}}

                    <div class="row form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name" class="col-sm-3 control-label">Nama</label>
                        <div class="col-sm-9">
                            <input type="text" id="name" value="{{ old('name') }}" name="name"
                                class="form-control" required="required" placeholder="Sila isi nama penuh anda">
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="row form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-sm-3 control-label">Email address</label>
                                <div class="col-sm-9">
                                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                                        class="form-control" required placeholder="eg: foo@bar.com">
                                    <small class="text-danger">{{ $errors->first('email') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row form-group {{ $errors->has('phoneNumber') ? 'has-error' : '' }}">
                                <label for="phoneNumber" class="col-sm-3 control-label">No Telefon</label>
                                <div class="col-sm-9">
                                    <input type="text" id="phoneNumber" value="{{ old('phoneNumber') }}"
                                        name="phoneNumber" class="form-control" required="required" placeholder="">
                                    <small class="text-danger">{{ $errors->first('phoneNumber') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button id="btnSubmit" type="button" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#btnSubmit').click(function(e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "{{ route('form.store') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    name: $('#name').val(),
                    email: $('#email').val(),
                    phoneNumber: $('#phoneNumber').val()
                },
                dataType: "json",
                success: function(response) {

                },
                error: function(xhr, ajaxOptions, thrownError) {
                    // console.log(xhr.responseJSON);
                    var errors = xhr.responseJSON.errors;
                    console.log(errors);
                    $.each(errors, function(indexInArray, error) {
                        $('#' + indexInArray).addClass('is-invalid');
                        $('#' + indexInArray).parent().find('.text-danger').text(error[0]);
                    });
                }
            });
        });
    </script>
@endsection
