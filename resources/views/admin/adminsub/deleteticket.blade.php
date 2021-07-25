@extends('navigation.adminNavigation')

@section('content')

<div class="body" style="background-color:#77acf1;min-height:600px">
    <div class="container py-4">
        <form class="form-text" method="POST" action="/admin/deleteticket" enctype="multipart/form-data">
            @csrf
            <div class="row g-0">
                <div class="col-3">
                    <h5>Hapus Tiket</h5>
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

                    <div class="mb-2"><label for="schedule">Pilih Jadwal</label></div>
                    <div class="mb-2">
                        <select class="custom-select d-block w-100" id="schedule" name="schedule" >
                            <option value="select">Tidak ada jadwal</option>
                        </select>
                    </div>
                    @error('schedule')
                    <div class="alert-danger" >{{$message}}</div>
                    @enderror

                    <div class="mb-2">
                        <label for="tiket">Tiket yang Tersedia</label>
                        <select class="custom-select d-block w-100" id="ticket" name="ticket" >
                            <option value="select">Tidak ada Tiket Tersedia</option>
                        </select>
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
    });//get schedule drop down


    $('#schedule').change(function()
    {
        var scheduleID = $(this).val();
        if(scheduleID)
        {
            $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
            });//end of ajax setup
            $.ajax({
                type:"GET",
                url:"/ajax-request/get-ticket-by-schedule?schedule_id="+scheduleID,
                success:function(data){
                    if(data != ""){
                        $("#ticket").empty();
                        $("#ticket").append('<option value="">Pilih Tiket...</option>');
                        $.each(data,function(key,value){
                            $("#ticket").append('<option value="'+value.id+'">Rp.'+value.harga+'/'+value.target+'</option>');
                        });
                    }else
                    {
                        $("#ticket").empty();
                        $("#ticket").append('<option value="">Tidak Ada Tiket Tersedia</option>');
                    }
                }
            });
        }
    });//get ticket drop down
</script>

@endsection
