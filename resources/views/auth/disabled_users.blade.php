@extends('layouts.app')
@section('head')
    <link rel="stylesheet" href="{{asset('css/users.css')}}">
@endsection
@section('main')
	<div class="row">
		<div class="col s10 offset-s1">
			<div class="card">
				<div class="row">
					<div class="col s12">

						<nav class="nav-extended indigo">
							<div class="nav-content">
								<center>
									<span class="nav-title">Disabled Users</span>
								</center>
							</div>
						</nav>
						<br>
						<div class=" row">
							<div class="col s8 offset-s2">
								<form action="searchUser" method="post">
									@csrf
									<div class="row">
										
										<div class="input-field">
											<center>
												<p>
												    <label class="col s6">
														<input class="check-editable with-gap" type="checkbox" name="id_rol" checked value="1">
											        	<span>Disabled</span>
											      	</label>
											      	<label class="col s6">
														<input class="check-editable with-gap" type="checkbox" name="id_rol" checked value="2">
											        	<span>Black List</span>
											      	</label>
												</p>
											</center>
										</div>
									</div>
								</form>
							</div>
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

	  	
	}
	document.addEventListener('DOMContentLoaded', function() {
	    var elems_collapsible = document.querySelectorAll('.collapsible');
	    var instances_collapsible = M.Collapsible.init(elems_collapsible);
	  });
</script>