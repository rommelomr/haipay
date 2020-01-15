@extends('layouts.app')
@extends('layouts.navbar')
@section('head')
    <link rel="stylesheet" href="{{asset('css/register.css')}}">
@endsection

@section('main')
    <div id="background"></div>
    <div class="container">
        <div class="row">
            
            <div id="card" class="col s12 l6 offset-l3 card-panel">
                <div class="row">
                    <nav class="indigo">
                        <div class="nav-wrapper">
                            <span class="brand-logo center">
                                Register
                            </span>
                        </div>
                    </nav>
                    @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="error">{{ $error }}</li>
                                @endforeach
                            </ul>
                    @endif

                    <form action="register" method="post">
                        @csrf
                        <div class="col s10 offset-s1">
                            <div class="input-field">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{old('name')}}">
                            </div>
                            <div class="input-field">
                                <label for="">Email</label>
                                <input type="text" name="email" value="{{old('email')}}">
                            </div>                        
                            <div class="input-field">
                                <label for="">Password</label>
                                <input type="password" name="password">
                            </div>
                            <div class="input-field">
                                <label for="">Repeat Password</label>
                                <input type="password" name="password_confirmation">
                            </div>
                            <center>
                                <button class="btn indigo">Create Account</button>
                            </center>
                        </div>
                    </form>
                </div>

                    <center>
                        
                        Do you have an account? <a href="#">Log in</a>
                    </center>

            </div>
        </div>            
    </div>
@endsection

