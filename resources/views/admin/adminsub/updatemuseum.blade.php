@extends('navigation.adminNavigation')

@section('content')
<div class="body" style="background-color:#77acf1;min-height:600px">
    <div class="container py-4">
        <form class="form-text" method="POST" action="/admin/updatemuseum" enctype="multipart/form-data">
            @csrf
            <div class="row g-0">
                <div class="col-3">
                    <h5>Perbarui Nama Museum</h3>
                </div>
                <div class="w-100"></div>
                <div class="col-md-5 md-3">
                    <div class="mb-2"><label for="museum">Pilih museum</label></div>
                    <div class="mb-2">
                        <select class="custom-select d-block w-100" id="museum" name="museum" required="">
                            <option value="select">Pilih museum...</option>
                            @foreach($museum as $data)
                                <option value="{{$data->id}}">{{$data->id}}</option>
                            @endforeach
                          </select>
                    </div>
                    @error('museum')
                    <div class="alert-danger" >{{$message}}</div>
                    @enderror

                    <div class="mb-2">
                        <label class="mb-2" for="rename">Ganti Nama Museum</label>
                        <input type="text" class="form-control" placeholder="nama baru museum" name="rename" id="rename">

                        @error('rename')
                        <div class="alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mt-2 ml-auto">
                        <label class="mb-2" for="gambar">Unggah Gambar Agenda</label>
                        <div class="custom-file">
                            <p><img id="output" width="200px"/></p>
                            <input type="file" class="custom-file-input" accept="image/*" name="image" id="file" onchange="loadFile(event)">
                            <label class="custom-file-label" for="validatedCustomFile"></label>
                        </div>

                        @error('image')
                        <div class="alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="w-100"></div>
                    <div class="col py-2">Jumlah Kuota</div>
                    <div class="w-100"></div>
                    <div class="col">
                        <input type="number" class="form-control" name="jumlah" placeholder="jumlah kuota">
                    </div>
                    <div class="w-100"></div>
                    <div class="col py-2">Google Map Link Src</div>
                    <div class="w-100"></div>
                    <div class="col">
                        <input type="text" class="form-control" name="googleMapLink" placeholder="link google map">
                    </div>

                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    <div class="w-100"></div>
                    @endif
                    <div class="mt-2  ml-auto py-5">
                        <button class="btn btn-outline-light" type="submit">Perbarui</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    var loadFile = function(event) {
     var image = document.getElementById('output');
     image.src = URL.createObjectURL(event.target.files[0]);
 };
</script>
@endsection
