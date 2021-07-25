@extends('navigation.museumNavigation')

@section('content')
    <div class="container-header"   style="background-color:#a7bbc7;">
        <header class="d-flex justify-content-center py-3">
          <ul class="nav nav-pills">
            <li class="nav-item"><span class="fs-3">{{$museum}}</span></li>
          </ul>
        </header>
    </div>

    <ul style="
    padding:0px;
    margin:20px;
    padding-left:10px;
    padding-right:10px;
    background-color:#e1e5ea;
    border:1px solid black;">
        <h1>Sekilas Agenda</h1>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3" style="margin-top:0px;padding-top:0px;">
            @foreach ($event as $event)
            <div class="col">
                <div class="card shadow-sm" style="min-height:200px;display: flex;justify-content: center">
                    <img class="img-fluid rounded mx-auto d-block " width="200px"
                    src="{{ asset('events/' .$event->nama_gambar) }}" alt="...."  id="{{$event->id}}">
                </div>

                  <div class="card-body">
                    <p class="card-text">{{$event->nama_agenda}}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <form action="/{{$museum}}/events/{{$event->nama_agenda}}" method="GET">
                                @csrf
                                <input type="hidden" name="eventid" value="{{$event->id}}">
                                <input type="hidden" name="event_name" value="{{$event->nama_agenda}}">

                                <button type="submit" class="btn btn-outline-secondary">Lihat</button>
                            </form>
                          </div>
                      <small class="text-muted">
                           <div>{{\Carbon\Carbon::parse($event->tanggal_mulai_agenda)->format('d/m/Y')}} - {{\Carbon\Carbon::parse($event->tanggal_berakhir_agenda)->format('d/m/Y')}}</div>
                      </small>
                    </div>
                  </div>
            </div>
            @endforeach
        </div>
        <div class="row mb-3">
        @foreach($event as $event)
              </div>
        @endforeach

        </div>

    </ul>
    <ul style="padding:0px;padding-left:5px;padding-bottom:20px;margin-left: 20px;margin-right: 20px;background-color:#e1e5ea;border:1px solid black;">
        <h1 style="padding-bottom: 10px;">Sekilas Koleksi</h1>
        <!--image collection loop start-->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach ($museumCollection as $item)
            <div class="col">
                <div class="card" style="background-color:#e1e5ea;border:0px;">
                    <div class="card-image"  style="min-height:200px;display: flex;justify-content: center">
                        <img class="img-fluid rounded mx-auto d-block " width="200px" src="{{ asset('collections/' .$item->gambar) }}" alt="...."  id="{{$item->id}}">
                    </div>
                </div>
              </div>
            @endforeach
        </div>

        <!--image collection loop end-->
    </ul>


@endsection
