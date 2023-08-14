@extends('layouts.layout')

@section('content')

    @include('layouts.single-parts.single-header')

    <div  class="row" style="margin-top:12vh">

        <div class="col-md-6 text-center">
            <div class="look-box" style="margin-top:10vh; margin-bottom:10vh;">
                <img src="{{asset('ufe_assets/images/test-single.png')}}" alt="look1" style="max-width:200px">
            </div>
        </div>

        <div class="col-md-6 text-center" style="background-color:white; height: 100vh;" id="desktopVideo">
            <div class="row" style="margin-top:14vh; margin-bottom:8vh;">
                <div class="col-md-6" style="padding:1vh; margin-bottom:5vh;">
                    <img src="{{asset('ufe_assets/images/test-cornince.png')}}" style="max-width:180px">
                    <br><small> P1 700€ </small>
                </div>
                <div class="col-md-6" style="padding:1vh; margin-bottom:5vh;">
                    <img src="{{asset('ufe_assets/images/test-cornince.png')}}" style="max-width:180px">
                    <br><small> P2 700€ </small>
                </div>
                <div class="col-md-6" style="padding:1vh;">
                    <img src="{{asset('ufe_assets/images/test-cornince.png')}}" style="max-width:180px">
                    <br><small> P4 300€ </small>
                </div>
                <div class="col-md-6" style="padding:1vh;">
                    <img src="{{asset('ufe_assets/images/test-cornince.png')}}" style="max-width:180px">
                    <br><small> P3 400€ </small>
                </div>
            </div>
        </div>
    </div>

@endsection
