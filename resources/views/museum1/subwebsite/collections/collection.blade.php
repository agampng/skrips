@extends('navigation.museumNavigation')

@section('content')
<div class="container-header"   style="background-color:#a7bbc7;">
    <header class="d-flex justify-content-center py-3">
      <ul class="nav nav-pills">
        <li class="nav-item"><span class="fs-3">Koleksi</span></li>
      </ul>
    </header>
</div>

<div class="row g-0 " style="padding-top: 20px;">


        @foreach ($gambar as $item)
        <div class="col-md-6 px-4">
            <div class="col-md-12">
                <div class="my-4" style="border:1px solid black;background-color: #e1e5ea">
                    <div class="card shadow-sm" style="padding:20px;height:300px;background-color: #e1e5ea;display: flex;justify-content:   center">
                    <img src="{{ asset('collections/' .$item->gambar) }}"
                      width="255" class="img-fluid rounded mx-auto d-block" alt="...">
                    </div>
                    <div class="card-body justify-content-center" style="flex-direction: column;">
                      <p >
                        <h5 class="text-center">{{$item->nama_gambar}}</h5>
                      </p>
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
        <div >

        @if ($prev == 'show')
            <form action="/{{$museum}}/collections" style="display: inline-block">
                @csrf
                <input type="hidden" name="page" value="{{$prevpage}}">
                <button type="submit" class="btn btn-outline-secondary">prev</button>
            </form>
        @endif
        @if ($next == 'show')
            <form action="/{{$museum}}/collections" style="display: inline-block">
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
