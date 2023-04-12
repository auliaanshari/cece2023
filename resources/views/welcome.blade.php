@extends('layout.app')
{{-- @extends('layout.header') --}}
@extends('layout.sidenav')
@section('content')
    <div class="coming-soon-wrapper bg-white text-center bg-overlay" style="background-image: url({{url('img/bg-img/welcome.jpg')}})">
        <div class="container">
            <div class="cs-logo">
                <a href="#">
                    <img src="{{ asset('img/core-img/logo.png') }}" alt="">
                </a>
            </div>
            <h2 class="text-white display-3">Selamat Datang</h2>
            <h5 class="text-white">Dilomba cerdas cermat Semarak Ramadan 1444 H</h5>
            <p class="text-white">Ikatan Remaja Masjid Muslimin Bulakan Tanjuang Gadang</p>
            {{-- <div class="countdown2 justify-content-center" id="countdown2" data-date="23-4-2022" data-time="22:00">
                <div class="day"><span class="num"></span><span class="word"></span></div>
                <div class="hour"><span class="num"></span><span class="word"></span></div>
                <div class="min"><span class="num"></span><span class="word"></span></div>
                <div class="sec"><span class="num"></span><span class="word"></span></div>
            </div> --}}
            <div class="notify-email mt-5">
                <a class="btn btn-warning text-light btn-lg" href="{{ url('/play') }}">Mulai</a>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection