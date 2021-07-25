@extends('navigation.adminNavigation')

@section('content')

<div class="body" style="background-color:#77acf1;min-height:600px;">
    <div class="container py-4">
        <form class="form-text" method="POST" action="/admin/delete-admin">
            @csrf
            <div class="row g-0">
                <div class="col-3">
                    <h5>Hapus Admin</h5>
                </div>
                <div class="w-100"></div>
                <div class="form mt-4">
                    <div class="col">
                        <label class="control-label">Pilih Admin <span class="text-danger">*</span></label>
                        <select name="select_admin" id="select-admin"
                            class="form-control{{ $errors->has('select_admin') ? ' is-invalid' : '' }}"
                            aria-label="Default select example" required>
                            <option value="">-- Pilih Admin --</option>
                            @foreach ($user as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        </select>

                        @if ($errors->has('select_admin'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('select_admin') }}</strong>
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

<script type="text/javascript">
    $('#museum').change(function()
    {
        var museumID = $(this).val();
        if(museumID)
        {
            console.log("im in");
            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
            });//end of ajax setup
            $.ajax({
                type:"GET",
                url:"/ajax-request/get-schedule-by-museum?museum_id="+museumID,
                success:function(data){
                    if(data != ""){
                        $("#schedule").empty();
                        $("#schedule").append('<option value="select">Pilih Jadwal...</option>');
                        $.each(data,function(key,value){
                            $("#schedule").append('<option value="'+value.id+'"> '+value.hari_pertama+' - '+value.hari_terakhir+' / '+value.jam_buka+' - '+value.jam_tutup+' </option>');
                        });
                    }else
                    {
                        $("#schedule").empty();
                        $("#schedule").append('<option value="select">Tidak Ada Jadwal</option>');
                    }
                }
            });
        }
    });
</script>

@endsection