@extends('layouts.app')
@extends('layouts.navbar')
@section('head')
    <link rel="stylesheet" href="{{asset('css/email.css')}}">
@endsection

@section('main')
    <div id="background"></div>
    <div class="container">
        <div class="row">
            
            <div id="card" class="col s12 l6 offset-l3 card-panel">
                <div class="row">
                    <div id="cabecera" class="indigo">
                        <center>
                            <h5>Recover Account</h5>
                        </center>
                    </div>
                    <div class="col s10 offset-s1">
                        <center>
                            We have sent a link to the email that you have entered. Please, check it and follow the instructions to recover your password.
                        </center>
                    </div>
                </div>

            </div>
        </div>            
    </div>
@endsection
