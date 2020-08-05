@extends('layouts.app')
@extends('layouts.sidenav')
@section('head')
    <link rel="stylesheet" href="{{asset('css/users.css')}}">
@endsection
@section('main')

	<div class="row">
		<div class="col s12 l6">
			<div class="card">
				<div class="row">
					<div class="col s12">
						
						<nav class="nav-extended indigo">
							<div class="nav-content">
								<center>
									<span class="nav-title">New User</span>
								</center>
							</div>
						</nav>
						<div class="content">
							<form method="post" action="{{route('create_user')}}">
								<input name="tipo" value="1" hidden>
								@csrf
								<div class="row" style="margin-top:0">
									
									<div class="input-field col s6 ">
										<i class="material-icons prefix">person</i>
										<label for="new-nombre">Name</label>
										<input id="new-nombre" type="text" name="name" value="{{old('name')}}">
									</div>
									<div class="input-field col s6">
										<i class="material-icons prefix">email</i>
										<label for="new-email">Email</label>
										<input id="new-email" type="text" name="email" value="{{old('email')}}">
									</div>

									<div class="input-field col s6">
										<i class="material-icons prefix">credit_card</i>
										<label for="new-id">ID</label>
										<input id="new-id" type="text" name="id" value="{{old('id')}}">
									</div>
									<div class="input-field col s6">
										<i class="material-icons prefix">locked</i>
										<label for="new-pass">Password</label>
										<input id="new-pass" type="text" name="password" value="{{old('password')}}">
									</div>
									<div class="input-field col s6">
										<i class="material-icons prefix">phone</i>
										<input id="new-phone" type="text" name="phone" value="{{old('phone')}}">
										<label for="new-phone">Phone</label>
									</div>
									<div class="input-field col s6">
										<i class="material-icons prefix">event</i>
										<input id="new-date" type="date" name="date" value="{{old('date')}}">
										<label for="new-date">Birthday</label>
									</div>
									
									<center>
										

										
									    <p>
									      <label class="col s6">
											<input class="with-gap" value="2" type="radio" name="rol" checked="true">
									        <span>Moderator</span>
									      </label>

									      <label class="col s6">
											<input class="with-gap" value="3" type="radio" name="rol">
									        <span>Admin</span>
									      </label>
									    </p>	
									</center>

								</div>
								<div class="row" style="margin:0;padding:0">
							      	<div  class="input-field col s12">
							      		<center>
							    			<button class="btn indigo">Register</button>
							      		</center>
							      	</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col s12 l6">
			<div class="card">
				<div class="row">
					<div class="col s12">

						<nav class="nav-extended indigo">
							<div class="nav-content">
								<center>
									<span class="nav-title">Users</span>
								</center>
							</div>
						</nav><br>
						<div class=" row">
							<div class="col s8 offset-s2">
								<form action="{{route('search_user')}}" method="get">
									<div class="input-field">
									
										<label for="buscar">search user</label>
										<input id="buscar_usuario" type="submit" hidden>

										<input id="buscar" type="text" name="string">
										<span><label for="buscar_usuario"><i class="icon-button material-icons prefix">search</i></label></span>

									</div>
								</form>
							</div>
						</div>
						@if(isset($users))
							<div class="row">
								<div class="col s10 offset-s1">
									<ul class="collection">
										
										@forelse($users as $user)
											<li class="collection-item">
												@if($user->tipo == 1)
													<b>(Client)</b>
												@elseif($user->tipo == 2)
													<b>(Moderator)</b>
												@elseif($user->tipo == 3)
													<b>(Admin)</b>
												@endif
													<span class="badge"><a href="{{route('see_user',$user->id)}}"><i class="material-icons">edit</i></a></span>
												{{$user->persona->nombre}} {{$user->persona->cedula}} 
											</li>
										@empty
										@endforelse
									</ul>
								</div>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

<script>

	  
	window.onload = function(){

		@if(!session('user'))
			document.getElementById('buscar').focus();
		@endif

	  	var elems_dropdowns = document.querySelectorAll('.dropdown-trigger');
    	var instances_dropdowns = M.Dropdown.init(elems_dropdowns,{
    		constrainWidth: false
    	});


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

	}
</script>