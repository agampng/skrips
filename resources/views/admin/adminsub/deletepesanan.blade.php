@extends('navigation.adminNavigation')

@section('content')

<div class="body" style="background-color:#77acf1;min-height:600px;">
    <div class="container py-4">
        <form class="form-text" method="POST" action="/admin/delete-booking">
            @csrf
            <div class="row g-0">
                <div class="col-3">
                    <h5>Hapus Pemesanan Tiket</h5>
                </div>
                <div class="w-100"></div>
                <div class="form mt-4">
                    <div class="col">
                        <label class="control-label">Pilih Tiket <span class="text-danger">*</span></label>
                        <select name="select_booking" id="select-admin"
                            class="form-control{{ $errors->has('select_booking') ? ' is-invalid' : '' }}"
                            aria-label="Default select example" required>
                            <option value="">-- Pilih Tiket --</option>
                            @foreach ($myBooking as $item)
                            <option value="{{$item->id}}">{{$item->nama_perwakilan}}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('select_booking'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('select_booking') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
                <div class="w-100"></div>
                @endif
                <div class="mt-2  ml-auto py-5">
                    <button class="btn btn-outline-light" type="submit">Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection