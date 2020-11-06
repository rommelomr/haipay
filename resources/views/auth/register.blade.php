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
                                <label for="name">Name <span style="color:salmon">*</span></label>
                                <input id="name" type="text" name="name" value="{{old('name')}}">
                                
                            </div>
                            <div class="input-field">
                                <label for="email">Email <span style="color:salmon">*</span></label>
                                <input id="email" type="text" name="email" value="{{old('email')}}">
                                
                            </div>              
                            <div class="input-field">
                                <label for="id">ID <span style="color:salmon">*</span></label>
                                <input id="id" type="text" name="id" value="{{old('id')}}">
                            </div>              
                            <div class="input-field">
                                <label for="phone">Phone</label>
                                <input id="phone" type="text" name="phone" value="{{old('phone')}}">
                            </div>              
                                      
                            <div class="input-field">
                                <label for="contrasena">Password <span style="color:salmon">*</span></label>
                                <input id="contrasena" type="password" name="password">
                                
                            </div>
                            <div class="input-field">
                                <label for="reptir">Repeat Password <span style="color:salmon">*</span></label>
                                <input id="reptir" type="password" name="password_confirmation">
                                
                            </div>
                            <div class="input-field">
                                <label for="register_code">Register Code</label>
                                <input id="register_code" type="text" name="register_code">
                            </div>
                            
                            @if(isset($_GET['r']))
                                <input name="referred" value="{{$_GET['r']}}" hidden>
                            @endif
                            
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