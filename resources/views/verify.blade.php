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
                        <form action="{{route('restore_password')}}" method="post">

                            @csrf
                            <input type="text" name="token" value="{{$token}}" hidden>

                            <div class="input-field">
                                <label for="password">Enter the new Password</label>
                                <input type="text" id="password" name="password">
                            </div>                 
                            <div class="input-field">
                                <label for="repeat">Please, repeat the new password</label>
                                <input type="text" name="password_confirmation" id="repeat">
                            </div>                 
                                   
                            <center>
                                <button class="btn indigo">Send</button>
                            </center>
                                
                        </form>
                    </div>
                </div>

            </div>
        </div>            
    </div>
@endsection

<script>

    document.addEventListener('DOMContentLoaded', function() {

        var elems_drop_down = document.querySelectorAll('.dropdown-trigger');
        var instances_drop_down = M.Dropdown.init(elems_drop_down);

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
        let elems_tooltip = document.querySelectorAll('.tooltipped');
        let instances = M.Tooltip.init(elems_tooltip);
    });

</script>