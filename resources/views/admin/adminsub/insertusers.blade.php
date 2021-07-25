@extends('navigation.adminNavigation')

@section('content')
<div class="body" style="background-color:#77acf1; height: 600px">
    <div class="container py-4">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ action('AdminControllers\AdminControllersSub\UserController@store') }}" method="POST"
            autocomplete="off">
            @csrf
            <div class="form row">
                <h5>Tambah Admin Baru</h5>

                <div class="col-md-12 mt-4">
                    <label class="control-label">Nama <span class="text-danger">*</span></label>
                    <input id="name" type="text" maxlength="20"
                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                        value="{{ old('name') }}" placeholder="Nama" required autofocus>

                    @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form row mt-4">
                <div class="col-md-6">
                    <label class="control-label">Email <span class="text-danger">*</span></label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                        name="email" value="{{ old('email') }}" placeholder="Email" required>

                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-md-6">
                    <label class="control-label">Role <span class="text-danger">*</span></label>
                    <select name="roles" class="form-control{{ $errors->has('roles') ? ' is-invalid' : '' }}"
                        id="select-role" aria-label="Default select example" required>
                        <option value="">-- Pilih Role --</option>
                        <option value="SUPERADMIN">SUPERADMIN</option>
                        <option value="ADMIN">ADMIN</option>
                    </select>

                    @if ($errors->has('roles'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('roles') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form mt-4 select-museum" style="display: none">
                <div class="col">
                    <label class="control-label">Museum <span class="text-danger">*</span></label>
                    <select name="museum_id" class="form-control{{ $errors->has('museum_id') ? ' is-invalid' : '' }}"
                        aria-label="Default select example" id="select-museum-admin" required>
                        <option value="">-- Pilih Museum --</option>
                        @foreach ($museum as $item)
                        <option value="{{$item->id}}">{{$item->id}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('museum_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('museum_id') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="form row mt-4 mb-4">
                <div class="col-md-6">
                    <label class="control-label">Password <span class="text-danger">*</span></label>
                    <input id="password" type="password"
                        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required
                        autocomplete="false" placeholder="Password">

                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="col-md-6">
                    <label class="control-label">Konfirmasi Password <span class="text-danger">*</span></label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required placeholder="Konfirmasi Password">
                </div>
            </div>

            @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
            <div class="w-100"></div>
            @endif

            <div class="form-actions mt-5 mb-5">
                <button type="submit" class="btn btn-outline-light">Simpan</button>
                {{-- <a href="{{ action('Backend\AdminController@index') }}">
                <button type="button" class="btn btn-inverse">Cancel</button>
                </a> --}}
            </div>
        </form>
    </div>
</div>
<script>
    $("#select-role")
    .change(function() {
      if ($(this).val() == "ADMIN") {
        console.log($(this).val())
        $(".select-museum").show();
        $("#select-museum-admin").prop("required", true);
      } else {
        $(".select-museum").hide();
        $("#select-museum-admin").prop("required", false);
      }
    })
    .change();
</script>
@endsection