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
                    <form action="register" method="post">
                        @csrf
                        <div class="col s10 offset-s1">
                            <div class="input-field">
                                <label for="name">Name</label>
                                <input id="name" type="text" name="name" value="{{old('name')}}">
                                <span style="color:salmon">*</span>
                            </div>
                            <div class="input-field">
                                <label for="email">Email</label>
                                <input id="email" type="text" name="email" value="{{old('email')}}">
                                <span style="color:salmon">*</span>
                            </div>              
                            <div class="input-field">
                                <label for="id">ID</label>
                                <input id="id" type="text" name="id" value="{{old('id')}}">
                            </div>              
                            <div class="input-field">
                                <label for="phone">Phone</label>
                                <input id="phone" type="text" name="phone" value="{{old('phone')}}">
                            </div>              
                                      
                            <div class="input-field">
                                <label for="contrasena">Password</label>
                                <input id="contrasena" type="password" name="password">
                                <span style="color:salmon">*</span>
                            </div>
                            <div class="input-field">
                                <label for="reptir">Repeat Password</label>
                                <input id="reptir" type="password" name="password_confirmation">
                                <span style="color:salmon">*</span>
                            </div>
                            <center>
                                <button class="btn indigo">Create Account</button>
                            </center>
                        </div>
                    </form>
                </div>

                    <center>
                        
                        Do you have an account? <a href="{{route('login')}}">Log in</a>
                    </center>

            </div>
        </div>            
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {

        @if(session('messages'))
            @foreach(session('messages') as $messages)
              M.toast({html: '{{$messages}}'})
            @endforeach

        @endif
        
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                M.toast({html: '{{ $error }}'})
            @endforeach
        @endif
        
    });
</script>