@extends('layouts.app')
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
									<span class="nav-title">Clients</span>
								</center>
							</div>
						</nav>
							@if(session('messages'))
								@foreach(session('messages') as $messages)
									{{$messages}}
								@endforeach

							@endif
							@if ($errors->any())
							    <div class="alert alert-danger">
							        <ul>
							            @foreach ($errors->all() as $error)
							                <li>{{ $error }}</li>
							            @endforeach
							        </ul>
							    </div>
							@endif
						<div class=" row">
								<div class="col s12">
									@if(session('data'))
									<?php 
										$persona = session('data');
									?>
									<form method="post" action="modify_client">
										@csrf
										<input hidden value="{{$persona->id}}" name="id">
										<div class="content row">
											<div class="input-field col s5">
												<i class="material-icons prefix">person</i>
												<label for="nombre">Name</label>
												<input class="input-editable " readonly id="nombre" type="text" name="nombre" value="{{$persona->nombre}}">
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
										</div>
									      <div class="col s12">
									      	<center>
									      		<button id="button-submit" class="btn green ligthen-3">Save</button>
									      		<label for="changeState" class="btn green ligthen-3">Activate</label>
												  <a class='dropdown-trigger btn indigo' href='#' data-target='dropdown1'>Options</a>
												  <ul id='dropdown1' class='dropdown-content'>
												    <li><a href="#!">See transactions</a></li>
												    <li><a href="#!">Delete user</a></li>
												    <li><a href="#!">Black List</a></li>
												    <li><a href="#!">Delete Definitely</li>
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
								<form action="search_client" method="get">
									@csrf
									<div class="input-field">
									
										<label for="buscar">search user</label>
										<input id="buscar_usuario" type="submit" hidden>
										
										<input id="buscar" type="text" name="buscar" value="27">
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
		<div class="col s12 l6">
				<div class="card">
					<div class="row">
						<div class="col s12">
							<nav class="nav-extended indigo">
								<div class="nav-content">
									<center>
										<span class="nav-title">Disabled Clients</span>
									</center>
								</div>
							</nav>
							<div class="row">
								<div class="col s10 offset-s1">
							  <ul class="collapsible">
							    <li>
							      <div class="collapsible-header black" style="color:white"><i class="material-icons">person</i>#123 Nombre Apellido</div>
							      <div class="collapsible-body">
							      	<table>
							      		<thead>
							      		<tr>
							      			
								      	<th>
								      		<center><b>Nombre Completo</b></center>
								      	</th>
								      	<th>
								      		<center>
								      			<b>Descripción</b>
								      		</center>
								      	</th>
								      	<th>
								      		<center>
								      			<b>Opciones</b>
								      		</center>
								      	</th>
							      		</tr>	
							      		</thead>
							      		<tbody>
							      			<tr>
							      				
										      	<td>
										      		<center>
										      			Nombre completo
										      		</center>
										      	</td>
										      	<td>
										      		<center>
										      			
										      			Lorem ipsum dolor sit amet, consectetur adipisicing elit. Impedit aperiam asperiores, labore a, beatae rem hic cumque, repellat autem eaque quos magni, tenetur delectus consequuntur minima ipsum! Cum dolorum, quia!
										      		</center>
										      	</td>
										      	<td>
										      		<center>
										      			<button class="btn indigo">Enable again</button><br><br>
										      			<button class="btn red">Delete definitely</button>
										      		</center>
										      	</td>
							      			</tr>
								      </tbody>
							      	</table>
							    </div>
							    </li>
							    <li>
							      <div class="collapsible-header black" style="color:white"><i class="material-icons">person</i>#123 Nombre Apellido</div>
							      <div class="collapsible-body">
							      	<table>
							      		<thead>
							      		<tr>
							      			
								      	<th>
								      		<center><b>Nombre Completo</b></center>
								      	</th>
								      	<th>
								      		<center>
								      			<b>Descripción</b>
								      		</center>
								      	</th>
								      	<th>
								      		<center>
								      			<b>Opciones</b>
								      		</center>
								      	</th>
							      		</tr>	
							      		</thead>
							      		<tbody>
							      			<tr>
							      				
										      	<td>
										      		<center>
										      			Nombre completo
										      		</center>
										      	</td>
										      	<td>
										      		<center>
										      			
										      			Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio vitae repudiandae eveniet provident, sint id iste vero corporis reprehenderit dolorum dolor dicta culpa iure sapiente, voluptates assumenda. Sint, magnam, aliquam!
										      		</center>
										      	</td>
										      	<td>
										      		<center>
										      			<button class="btn indigo">Enable again</button><br><br>
										      			<button class="btn red">Delete definitely</button>
										      		</center>
										      	</td>
							      			</tr>
								      </tbody>
							      	</table>
							    </div>
							    </li>
							    <li>
							      <div class="collapsible-header"><i class="material-icons">person</i>#123 Nombre Apellido</div>
							      <div class="collapsible-body">
							      	<table>
							      		<thead>
							      		<tr>
							      			
								      	<th>
								      		<center><b>Nombre Completo</b></center>
								      	</th>
								      	<th>
								      		<center>
								      			<b>Descripción</b>
								      		</center>
								      	</th>
								      	<th>
								      		<center>
								      			<b>Opciones</b>
								      		</center>
								      	</th>
							      		</tr>	
							      		</thead>
							      		<tbody>
							      			<tr>
							      				
										      	<td>
										      		<center>
										      			Nombre completo
										      		</center>
										      	</td>
										      	<td>
										      		<center>
										      			
										      			Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quae optio similique repellendus. Necessitatibus ad, quidem. Repudiandae reprehenderit, ipsum officiis incidunt quasi vel vitae temporibus tempore ipsa aperiam quam, voluptatum cum!
										      		</center>
										      	</td>
										      	<td>
										      		<center>
										      			<button class="btn indigo">Enable again</button><br><br>
										      			<button class="btn red">Delete definitely</button>
										      		</center>
										      	</td>
							      			</tr>
								      </tbody>
							      	</table>
							    </div>
							    </li>
							  </ul>

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
	  
	window.onload = function(){
	  	var edit = document.querySelectorAll('.edit');
	  	var max = edit.length;
	  	for(var i = 0; i<max; i++){

	  		edit[i].onclick = selectInput;
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
    	
    	var elems_collapsible = document.querySelectorAll('.collapsible');
	    var instances_collapsible = M.Collapsible.init(elems_collapsible);
	}
</script>