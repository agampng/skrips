@extends('navigation.adminNavigation')

@section('content')
<div class="body" style="background-color:#77acf1;height:600px">
    <div class="container py-4">
        <form class="form-text" method="POST" action="/admin/newcollectionupload" enctype="multipart/form-data">
            @csrf
            <div class="row g-0">
                <div class="col-3">
                    <h5>Tambah Koleksi Baru</h3>
                </div>
                <div class="w-100"></div>
                <div class="col-md-5 md-3">
                    <div class="mb-2"><label for="museum">Pilih Museum</label></div>
                    <div class="mb-2">
                        <select class="custom-select d-block w-100" id="museum" name="museum">
                            <option value="select">pilih museum...</option>
                            @foreach($museum as $data)
                                <option value="{{$data->id}}">{{$data->id}}</option>
                            @endforeach
                          </select>
                    </div>
                    @error('museum')
                    <div class="alert-danger" >{{$message}}</div>
                    @enderror
                    <div class="mt-2 ml-auto">
                        <label class="mb-2" for="name">Nama Gambar</label>
                        <input type="text" class="form-control" placeholder="nama gambar" name="name" id="name">

                        @error('name')
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

<script>
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>

@endsection
