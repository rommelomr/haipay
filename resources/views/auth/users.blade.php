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
							<form method="post" action="create_user">
								<input name="tipo" value="1" hidden>
								@csrf
								<div class="row" style="margin-top:0">
									
									<div class="input-field col s6 ">
										<i class="material-icons prefix">person</i>
										<label for="new-nombre">Name</label>
										<input id="new-nombre" type="text" name="name">
									</div>
									<div class="input-field col s6">
										<i class="material-icons prefix">email</i>
										<label for="new-email">Email</label>
										<input id="new-email" type="text" name="email">
									</div>

									<div class="input-field col s6">
										<i class="material-icons prefix">credit_card</i>
										<label for="new-pass">ID</label>
										<input id="new-pass" type="text" name="id">
									</div>
									<div class="input-field col s6">
										<i class="material-icons prefix">locked</i>
										<label for="new-pass">Password</label>
										<input id="new-pass" type="text" name="password">
									</div>
									<div class="input-field col s6 offset-s3">
										<i class="material-icons prefix">event</i>
										<input id="new-pass" type="date" name="date">
										<label for="new-pass">Birthday</label>
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
								<div class="col s12">
									@if(session('data'))
										<?php 
											$persona = session('data');
											//dd($persona->fecha_nacimiento);
										?>

										<form method="post" action="modifyUser">
											@csrf
											<input hidden value="{{$persona->id}}" name="id">
											<div class="content row">
													
												<div class="input-field col s5">
													<i class="material-icons prefix">person</i>
													<label for="nombre">Name</label>
													<input class="input-editable" readonly id="nombre" type="text" name="nombre" value="{{$persona->nombre}}">
													<i data-brother="nombre" class="icon-button edit material-icons prefix">edit</i>
												</div>
												<div class="input-field col offset-s1 s5">
													<i class="material-icons prefix">email</i>
													<label for="email">Email</label>
													<input class="input-editable " readonly id="email" type="email" name="email" value="{{$persona->usuario->email}}">
													<i data-brother="email" class="icon-button edit material-icons prefix">edit</i>
												</div>
												<div class="input-field col s5">
													<i class="material-icons prefix">credit_card</i>
													<label for="cedula">ID</label>
													<input class="input-editable " readonly id="cedula" type="text" name="cedula" value="{{$persona->cedula}}">
													<i data-brother="cedula" class="icon-button edit material-icons prefix">edit</i>
												</div>

												<div class="input-field col s5 offset-s1">
													<i class="material-icons prefix">locked</i>
													<label for="pass">Password</label>
													<input class="input-editable " readonly id="pass" type="text" name="password">
													<i data-brother="pass" class="icon-button edit material-icons prefix">edit</i>
												</div>
												<div class="input-field col s5">
													<i class="material-icons prefix">locked</i>
													<input class="input-editable " readonly id="date" type="date" name="fecha_nacimiento" value="{{$persona->usuario->fecha_nacimiento}}">
													<label for="date">birthday</label>
													<i data-brother="date" class="icon-button edit material-icons prefix">edit</i>
												</div>
												
											    <p>
											      <label class="col offset-s1 s5">
													<input class="check-editable with-gap" type="radio" name="id_rol" value="2" @if($persona->usuario->tipo == 2) checked @endif
													>
											        <span>Moderator</span>
											      </label>
											      <label class="col offset-s1 s5">
													<input class="check-editable with-gap" type="radio" name="id_rol" value="3" @if($persona->usuario->tipo == 3) checked @endif
													>
											        <span>Admin</span>
											      </label>
											    </p>	
											</div>
										      <div class="col s12">
										      	<center>
										      		<button id="button-submit" class="btn green ligthen-3">Save</button>
										      		@if($persona->usuario->estado === 0)
										      			<label class="btn green ligthen-3 changeState" data-state="1">Activate</label>
										      		@elseif($persona->usuario->estado === 1)
										      			<label class="btn red	ligthen-3 changeState" data-state="0">Desactivate</label>
										      		@elseif($persona->usuario->estado === 2)
										      			<label class="btn black">User in black list</label>

										      		@endif
													  <a class='dropdown-trigger btn indigo' href='#' data-target='dropdown1'>Options</a>
													  <ul id='dropdown1' class='dropdown-content'>
													    <li><a href="#!">See transactions</a></li>

										      			@if($persona->usuario->estado === 1)
													    	<li><a href="#!" class="changeState" data-state="2">Send to black list</a></li>

										      			@elseif($persona->usuario->estado === 2)
													    	<li><a href="#!" class="changeState" data-state="1">Remove from black list</a></li>
										      			@elseif($persona->usuario->estado === 0)
													    	<li><a href="#!" class="changeState" data-state="3">Delete definitely</li>
										      			@endif
													  </ul>
										      	</center>
										      </div>
										</form>
										<form id="change-state-form" action="changeState" method="post" hidden>
											@csrf
											<input name="user_to_change_state" value="{{$persona->id}}">
											<input id="state" name="state">
											<input id="changeState" type="submit">
										</form>
									@endif
								</div>
							<div class="col s8 offset-s2">
								<form action="search_user" method="get">
									@csrf
									<div class="input-field">
									
										<label for="buscar">search user</label>
										<input id="buscar_usuario" type="submit" hidden>

										<input id="buscar" type="text" name="buscar" value="">
										<span><label for="buscar_usuario"><i class="icon-button material-icons prefix">search</i></label></span>

									</div>
								</form>

	
								<div class="col s12">
									<center>
										See <a href="#">desactivated users</a>
									</center>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

<script>
	
	var submitEnabled = false;
	function selectInput(e){
	  	var element = e.target;
	  	var id = element.dataset.brother;
	  	input = document.getElementById(id);
	  	input.removeAttribute('readonly');
	  	input.focus();
	  	old_input_value = input.value;
	}
	function activateSubmit(e){
		var input_modified = old_input_value == input.value;
		if(!submitEnabled && !input_modified){
		  	var button = document.getElementById('button-submit');
		  	button.removeAttribute('disabled');
		}
	}
	function setChangeState(e){
		var input_state = document.getElementById('state');
		input_state.value = e.target.dataset.state;
		document.getElementById('change-state-form').submit();
	}
	  
	window.onload = function(){
	  	var edit = document.querySelectorAll('.edit');
	  	var max = edit.length;
	  	for(var i = 0; i<max; i++){

	  		edit[i].onclick = selectInput;
		}
		var changeState = document.querySelectorAll('.changeState');
		var max_change = changeState.length;

	  	for(var i = 0; i<max_change; i++){

	  		changeState[i].onclick = setChangeState;
		}
		@if(!session('user'))
			document.getElementById('buscar').focus();
		@endif

		var inputs = document.querySelectorAll('.input-editable');
		var max = inputs.length;
		for(var i = 0; i<max; i++){
		  	inputs[i].onkeyup = activateSubmit;
		}


		var checks = document.querySelectorAll('.check-editable');
		var max = checks.length;
		for(var i = 0; i<max; i++){

			checks[i].onchange = activateSubmit;
		}

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