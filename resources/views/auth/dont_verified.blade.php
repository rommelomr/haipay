@extends('layouts.app')
@extends('layouts.navbar')
@section('head')
    <link rel="stylesheet" href="{{asset('css/dont_verified.css')}}">
@endsection

@section('main')
    <div id="background"></div>
    <div class="container">
        <div class="row">
            
            <div id="card" class="col s12 l6 offset-l3 card-panel">
                <div class="row">
                    <div id="cabecera" class="indigo">
                        <center>
                            <h5>Verify Your Account!</h5>
                        </center>
                    </div>
                    <div class="col s10 offset-s1">
                    	We have send you an email with a link to verify your account. Please check it! After that you could log in normaly
                    </div>
                </div>

            </div>
        </div>            
    </div>
@endsection

