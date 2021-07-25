@extends('navigation.museumNavigation')

@section('content')

    <div class="body" style="width:auto;padding-bottom: 200px;background-color:#a7bbc7;">
      <div style="padding-top:30px;">
        <div class="col" style="padding-left:120px ">
          <h1 class="display-3 fst-italic">{{$eventname}}</h1>
        </div>
        <div class="w-100"></div>
        <div class="col" style="padding-left:120px ">
            <p class="my-3">{{$startDate}} - {{$endDate}}</p>
        </div>
        <div class="w-100"></div>
        <div class="col">
            <img class="img-fluid rounded mx-auto d-block " width="500px"
                src="{{ asset('events/'.$eventimg) }}" alt="....">
        </div>
        <div class="w-100"></div>
        <div class="col" style="margin-top:50px;padding-left:120px ">
            <p>
                {{$eventdetail}}
            </p>
        </div>
        </div>
    </div

@endsection
