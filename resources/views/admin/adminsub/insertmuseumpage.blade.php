@extends('navigation.adminNavigation')

@section('content')
<div class="body" style="background-color:#77acf1;min-height:600px">
    <div class="container py-4">
        <form class="form-text" method="POST" action="/admin/newmuseumupload" enctype="multipart/form-data">
            @csrf
            <div class="row g-0">
                <div class="col-3">
                    <h5>Tambah Museum Baru</h3>
                </div>
                <div class="w-100"></div>
                <div class="col-2 py-2">Pilih Museum</div>
                <div class="w-100"></div>
                <div class="col-5">
                    <input type="text" class="form-control" name="museum" placeholder="nama museum">
                </div>
                <div class="col-7">
                    <label for="museum"><i> *Perlu diisi 5-20 karakter</i></label>
                </div>
                @error('museum')
                <div class="alert-danger col-5" >{{$message}}</div>
                @enderror

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
                <div class="col-2 py-2">Jumlah Kuota</div>
                <div class="w-100"></div>
                <div class="col-5">
                    <input type="number" class="form-control" name="jumlah" placeholder="jumlah kuota">
                </div>
                <div class="w-100"></div>
                <div class="col-2 py-2">Google Map Link Src</div>
                <div class="w-100"></div>
                <div class="col-5">
                    <input type="text" class="form-control" name="googleMapLink" placeholder="link google map">
                </div>

                </div>
                @if(session()->has('message'))
                    <div class="col-5 alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    <div class="w-100"></div>
                @endif
                <div class="col py-5">
                    <button class="btn btn-outline-light" type="submit">Buat</button>
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
