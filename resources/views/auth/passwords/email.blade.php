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
                        <div class="input-field">
                            <label for="">Email</label>
                            <input type="text">
                        </div>                        
                        <center>
                            <button class="btn indigo">Send</button>
                        </center>
                    </div>
                </div>

            </div>
        </div>            
    </div>
@endsection

