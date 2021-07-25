@extends('navigation.adminNavigation')

@section('content')

<div class="body" style="background-color:#77acf1;min-height:600px">
    <div class="container py-4">
        <form class="form-text" method="POST" action="/admin/deletecollection" enctype="multipart/form-data">
            @csrf
            <div class="row g-0">
                <div class="col-3">
                    <h5>Hapus Koleksi</h3>
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

                    <div class="mb-2"><label for="collection">Pilih Koleksi</label></div>
                    <div class="mb-2">
                        <select class="custom-select d-block w-100 mb-2" id="collection" name="collection">
                            <option value="select">Tidak Ada Koleksi</option>
                        </select>
                        <div id="collection_image">
                            <img src="" alt="Tidak menemukan gambar" width="150">
                            <p>Nama tidak ditemukan</p>
                        </div>
                    </div>
                    @error('collection')
                    <div class="alert-danger" >{{$message}}</div>
                    @enderror

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

            </div>
        </form>
    </div>
</div>


<script>
    //load image from computer upload
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };

    //museum dependent image collection
    $('#museum').change(function()
    {
        var museumID = $(this).val();
        if(museumID)
        {
            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
            });//end of ajax setup
            $.ajax({
                type:"GET",
                url:"/ajax-request/get-collection-by-museum?museum_id="+museumID,
                success:function(data){
                    if(data != ""){
                        console.log(data);
                        $("#collection").empty();
                        $("#collection").append('<option value="select">Pilih Koleksi...</option>');
                        $.each(data,function(key,value){
                            $("#collection").append('<option value="'+value.id+'"> '+value.nama_gambar+' </option>');
                        });
                    }else
                    {
                        $("#collection").empty();
                        $("#collection").append('<option value="select">Tidak Ada Koleksi</option>');
                    }
                }//end of success:function
            });//end of ajax stuff
        }//end of IF museumID
    });

    //image name dependent image show
    $('#collection').change(function()
    {
        var collectionID = $(this).val();
        if(collectionID)
        {
            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
            });//end of ajax setup
            $.ajax({
                type:"GET",
                url:"/ajax-request/get-image-by-collection?collection_id="+collectionID,
                success:function(data){
                    if(data != ""){
                        console.log(data);
                        $("#collection_image").empty();
                        $.each(data,function(key,value){
                            //bingung append imagenya
                            $("#collection_image").append('<img src="'+value.url+'" width="200px">');
                            $("#collection_image").append('<p>'+value.name+'</p>');
                        });
                    }else
                    {
                        $("#collection").empty();
                        $("#collection_image").append('<img src="" alt="Gambar Tidak Ditemukan" width="200px">');
                        $("#collection_image").append('<p>Nama Tidak Ditemukan</p>');
                    }
                }//end of success:function
            });//end of ajax stuff
        }//end of IF museumID
    });
</script>

@endsection
