@extends('navigation.adminNavigation')

@section('content')
<div class="body" style="background-color:#77acf1;">
    <div class="container py-4">
        <form class="form-text" method="POST" action="/admin/neweventupload" enctype="multipart/form-data">
            @csrf
            <div class="row g-0">
                <div class="col-3">
                    <h5>Tambah Agenda Baru</h3>
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
                    <div class="mt-2 ml-auto">
                        <label class="mb-2" for="event">Nama Agenda</label>
                        <input type="text" class="form-control" name="event_title" placeholder="nama agenda">
                    </div>

                    <div class="mt-2 ml-auto">
                        <div class="mb-2"><label for="museum">Pilih Tanggal Mulai</label></div>
                        <div class="mb-2">
                            <input type="date" class="form-control" name="event_start_date" id="event_start_date">
                        </div>

                        @error('event_start_date')
                        <div class="alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mt-2 ml-auto">
                        <div class="mb-2"><label for="museum">Pilih Tanggal Berakhir</label></div>
                        <div class="mb-2">
                            <input type="date" class="form-control" name="event_end_date" id="event_end_date">
                        </div>

                        @error('event_end_date')
                        <div class="alert-danger">{{$message}}</div>
                        @enderror
                    </div>


                    <div class="mt-2 ml-auto">
                        <label class="mb-2" for="gambar">Unggah Gambar Agenda</label>
                        <div class="custom-file">
                            <div class="custom-file">
                                <p><img id="output" width="200px"/></p>
                                <input type="file" class="custom-file-input" accept="image/*" name="event_image" id="event_image"      onchange="loadFile(event)">
                                <label class="custom-file-label" for="validatedCustomFile"></label>
                            </div>
                            <label class="custom-file-label" for="validatedCustomFile"></label>
                        </div>

                        @error('event_image')
                        <div class="alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mt-2  ml-auto">
                        <label class="mb-2" for="event_description">deskripsi agenda</label>
                        <textarea class="form-control" name="event_description" placeholder="deskripsi agenda" id="exampleFormControlTextarea1" rows="3"></textarea>
                        @error('event_description')
                        <div class="alert-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mt-2  ml-auto">
                        <label class="mb-2" for="event_text">penjelasan agenda</label>
                        <textarea class="form-control" name="event_text" placeholder="penjelasan agenda" id="exampleFormControlTextarea1" rows="3"></textarea>
                        @error('event_text')
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
