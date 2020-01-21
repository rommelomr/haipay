@extends('layouts.app')
@extends('layouts.navbar')
@section('head')
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('main')
    <div id="background"></div>
    <div class="container-fluid">
        <div class="row">

            <div id="login" class="col s10 offset-s1 m6 offset-m3 card-panel">
                <div class="row">
                    <nav class="indigo">
                        <div class="nav-wrapper">
                            <span class="brand-logo center">
                    
                                Login
                            </span>
                        </div>
                    </nav>
                    <div class="col s10 offset-s1">

                            <form action="login" method="post">
                                @csrf
                                <div class="input-field">
                                    <label for="email">Email</label>
                                    <input id="email" type="text" name="email">
                                </div>
                                <div class="input-field">
                                    <label for="pass">Password</label>
                                    <input id="pass" type="password" name="password">
                                </div>
                                <input id="submit" type="submit" hidden>
                            </form>
                    </div>
                    <div class="col s5 offset-s1">
                        
                        <label for="submit" class="col s12 btn indigo">login</label>
                    </div>
                    <div class="col s5">
                        <a href="{{route('register')}}" class="col s12 btn grey lighten-3 text-black">Register</a>
                    </div>
                </div>
                <center>
                    Forgot <a href="#">password</a>?<br><br>
                </center>
            </div>
        </div>
    </div>
@endsection

