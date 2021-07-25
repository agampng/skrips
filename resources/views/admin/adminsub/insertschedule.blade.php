@extends('navigation.adminNavigation')

@section('content')
<div class="body" style="background-color:#77acf1;">
    <div class="container py-4">
        <form class="form-text" method="POST" action="/admin/newscheduleupload" enctype="multipart/form-data">
            @csrf
            <div class="row g-0">
                <div class="col-3">
                    <h5>Tambah Jadwal Baru</h5>
                </div>
                <div class="w-100"></div>
                <div class="col-md-5 md-3">
                    <div class="mb-2"><label for="museum">Pilih Museum</label></div>
                    <div class="mb-2">
                        <select class="custom-select d-block w-100" id="museum" name="museum" required="">
                            <option value="select">pilih museum...</option>
                            @foreach($museum as $data)
                                <option value="{{$data->id}}">{{$data->id}}</option>
                            @endforeach
                          </select>
                    </div>
                    @error('museum')
                    <div class="alert-danger" >{{$message}}</div>
                    @enderror

                    <div class="mb-2"><label for="firstday">Pilih Hari Pertama Dalam Seminggu</label></div>
                    <div class="mb-2">
                        <select class="custom-select d-block w-100" id="firstday" name="firstday" required="">
                            <option value="select">Pilih Hari...</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                          </select>
                    </div>
                    @error('firstday')
                    <div class="alert-danger" >{{$message}}</div>
                    @enderror

                    <div class="mb-2"><label for="lastday">Pilih Hari Terakhir Dalam Seminggu</label></div>
                    <div class="mb-2">
                        <select class="custom-select d-block w-100" id="lastday" name="lastday" required="">
                            <option value="select">Pilih Hari...</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                          </select>
                    </div>
                    @error('lastday')
                    <div class="alert-danger" >{{$message}}</div>
                    @enderror

                    <div class="col-md-3 mb-2">
                        <label for="inputMDEx1">waktu buka</label>
                        <input type="time" id="inputMDEx1" class="form-control" name="waktu_buka">
                    </div>

                    @error('waktu_buka')
                        <div class="alert-danger">{{$message}}</div>
                    @enderror

                    <div class="col-md-3 mb-2">
                        <label for="inputMDEx1">waktu tutup</label>
                        <input type="time" id="inputMDEx1" class="form-control" name="waktu_tutup">
                    </div>

                    @error('waktu_tutup')
                        <div class="alert-danger">{{$message}}</div>
                    @enderror

                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    <div class="w-100"></div>
                    @endif
                    <div class="mt-2  ml-auto py-5">
                        <button class="btn btn-outline-light" type="submit">Buat</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
