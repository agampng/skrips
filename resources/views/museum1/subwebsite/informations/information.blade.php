@extends('navigation.museumNavigation')

@section('content')
<div class="container-header"   style="background-color:#a7bbc7;">
    <header class="d-flex justify-content-center py-3">
      <ul class="nav nav-pills">
        <li class="nav-item"><span class="fs-3">Informasi</span></li>
      </ul>
    </header>
</div>

<div class="bg-light border g-0" style="padding-top:20px;margin:0px">

    <div class="row text-center border g-0" style="padding:5px;height:50%;">
        <div class="col-2">
            <h4 class="align-text-center">Tiket</h4>
        </div>
        <div class="col-3">
            <h4>Hari</h4>
        </div>
        <div class="col-3">
            <h4>Waktu</h4>
        </div>
        <div class="col-2">
            <h4>Target</h4>
        </div>
        <div class="col-2">
            <h4>Harga</h4>
        </div>
    </div>
    @if ($jadwal->isnotEmpty())

        @foreach ($jadwal as $item)
        <div class="row data text-center border g-0" style="padding:5px;">
            <div class="col-2">
            </div>
            <div class="col-3">
                <span>{{$item->hari_pertama}} - {{$item->hari_terakhir}}</span>
            </div>
            <div class="col-3">
                {{$item->jam_buka}} - {{$item->jam_tutup}}
            </div>

            @php
                    $reset = 0;
            @endphp

            @foreach ($ticket as $info)

                    @if($reset == 0)
                        @if ($item->id == $info->jadwal_id)
                            <div class="col-2">
                                {{$info->target}}
                            </div>
                            <div class="col-2">
                                Rp.{{$info->harga}}
                            </div>
                            <div class="w-100"></div>
                            @php
                                $reset = 1;
                                $prev_pertama = $item->hari_pertama;
                                $prev_terakhir = $item->hari_terakhir;
                            @endphp
                        @endif

                    @elseif ($item->hari_pertama ==  $prev_pertama && $item->hari_terakhir == $prev_terakhir)
                        @if($item->id == $info->jadwal_id)
                            <div class="col-2 offset-8">
                                {{$info->target}}
                            </div>
                            <div class="col-2">
                                Rp.{{$info->harga}}
                            </div>
                            <div class="w-100"></div>
                            @php
                                $reset = $reset+1;
                            @endphp
                        @endif

                    @elseif ($item->hari_pertama !=  $prev_pertama || $item->hari_terakhir != $prev_terakhir)
                            <br>
                            <!--do nothing-->
                    @endif
            @endforeach
        </div>
        @endforeach<!--schedule show-->
    @else
        <div class="row g-0">
            <h3 class="col text-center">data jadwal tidak ada</h3>
        </div>
    @endif
<div class="container border" style="margin-top:75px;background-color:white;">
    <div class="container-header">
        <header class="d-flex justify-content-center py-3">
          <ul class="nav nav-pills">
            <li class="nav-item"><span class="fs-3">Lokasi</span></li>
          </ul>
        </header>
    </div>
    <div class="row g-0 border" style="margin:10px;">
        <div class="col-12 border">
            <iframe src="{{$link}}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>

</div>


@endsection

