@extends('navigation.museumNavigation')

@section('content')
    <div class="modal-content" style="border: none;">
        <div class="modal-header">
          <h5 class="modal-title">Searching result</h5>
        </div>

        <div class="modal-body container" style="border: none;">
            @if ($event->isEmpty())
                <div>Tidak menemukan hasil pencarian!</div>
            @else
                @foreach ($event as $event)
                    <div class="row my-4 py-2" style="border:1px solid lightgrey;">
                        <div class="col-12 pb-2">
                            <a class="list-group-item list-group-item-action"
                                href="/{{$museum}}/events/{{$event->nama_agenda}}?eventid={{$event->id}}&event_name={{$event->nama_agenda}}"
                            >
                                {{$event->nama_agenda}}
                        </a>
                        </div>
                        <div class="col-5">
                            <div class="card" style="min-height:200px;display: flex;justify-content: center;">
                                <img class="img-fluid rounded mx-auto d-block " width="200px"
                                src="{{ asset('events/' .$event->nama_gambar) }}"  alt="image doesnt exist" width="300">
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="pb-2">
                                {{\Carbon\Carbon::parse($event->tanggal_mulai_agenda)->format('d/m/Y')}}
                                -
                                {{\Carbon\Carbon::parse     ($event->tanggal_berakhir_agenda)->format('d/m/Y')}}
                            </div>
                            <div>event description:</div>
                            <label for="description">{{$event->deskripsi_agenda}}</label>
                        </div>

                    </div>
                    @endforeach

                    <div class="row">
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
                                    <form action="/{{$museum}}/search" style="display: inline-block">
                                        @csrf
                                        <input type="hidden" name="page" value="{{$prevpage}}">
                                        <button type="submit" class="btn btn-outline-secondary">prev</button>
                                    </form>
                                @endif
                                @if ($next == 'show')
                                    <form action="/{{$museum}}/search" style="display: inline-block">
                                        @csrf
                                        <input type="hidden" name="page" value="{{$newpage}}">
                                        <button type="submit" class="btn btn-outline-secondary">next</button>
                                    </form>
                                @endif
                            </div>
                                        </div>



                            </div>
                        </div>
                    </div>
            @endif
        </div>



@endsection

