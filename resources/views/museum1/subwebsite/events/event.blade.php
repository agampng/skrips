@extends('navigation.museumNavigation')

@section('content')
<div class="row mb-2">
    <div class="container-header"   style="background-color:#a7bbc7;">
        <header class="d-flex justify-content-center py-3">
          <ul class="nav nav-pills">
            <li class="nav-item"><span class="fs-3">Agenda</span></li>
          </ul>
        </header>
    </div>
</div>
    @foreach ($event as $event)
    <div class="col-md-12 border-bottom" style="padding:0px;margin-top:20px;margin-bottom:10px;background-color:#e1e5ea;">
      <div class="row g-0 rounded overflow-hidden flex-md-row py-4 h-md-250 position-relative">
        <div class="col-md-5 d-none d-lg-block px-4" style="padding-right: 0px;">
            <div class="card" style="min-height:200px;display: flex;justify-content: center;border:1px solid black">
                <img class="img-fluid rounded mx-auto d-block " width="200px"
                src="{{ asset('events/' .$event->nama_gambar) }}" alt="...."  id="{{$event->id}}">
            </div>
          </div>
        <div class="col-md-6 p-4 d-flex flex-column">
            <h3 class="mb-0">{{$event->nama_agenda}}</h3>
            <div class="mb-1 text-muted">
                {{\Carbon\Carbon::parse($event->tanggal_mulai_agenda)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($event->tanggal_berakhir_agenda)->format('d/m/Y')}}
            </div>
            <p class="card-text mb-auto">{{$event->deskripsi_agenda}}
            </p>
            <form action="/{{$museum}}/events/{{$event->nama_agenda}}" method="GET">
                @csrf
                <input type="hidden" name="eventid" value="{{$event->id}}">
                <input type="hidden" name="event_name" value="{{$event->nama_agenda}}">

                <button type="submit" class="btn btn-outline-secondary">Lihat</button>
            </form>
          </div>
        </div>
      </div>
    </div>
    @endforeach
</div>

<div class="row" style="margin: 20px">
    <div class="col-2"></div>
    <div class="col-8 text-center" >
        <div style="margin-bottom: 20px">Halaman nomor:{{$page}}</div>
        <div class="w-100"></div>
        @php
            $newpage = $page + 1;
            $prevpage = $page - 1;
        @endphp
        <div>
            @if ($prev == 'show')
                <form action="/{{$museum}}/events" style="display: inline-block">
                    @csrf
                    <input type="hidden" name="page" value="{{$prevpage}}">
                    <button type="submit" class="btn btn-outline-secondary">prev</button>
                </form>
            @endif
            @if ($next == 'show')
                <form action="/{{$museum}}/events" style="display: inline-block">
                    @csrf
                    <input type="hidden" name="page" value="{{$newpage}}">
                    <button type="submit" class="btn btn-outline-secondary">next</button>
                </form>
            @endif
        </div>
    </div>

    <div class="col-2"></div>
</div>
@endsection

