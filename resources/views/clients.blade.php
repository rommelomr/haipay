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
									@if($cliente_editar!=null)
									<form method="post" action="modify_client">
										@csrf
										<input hidden value="{{$cliente_editar->usuario->persona->id}}" name="id">
										<div class="content row">
											<div class="input-field col s5">
												<i class="material-icons prefix">person</i>
												<label for="nombre">Name</label>
												<input class="input-editable " readonly id="nombre" type="text" name="nombre" value="{{$cliente_editar->usuario->persona->nombre}}">
												<i data-brother="nombre" class="icon-button edit material-icons prefix">edit</i>
											</div>
											<div class="input-field col offset-s1 s5">
												<i class="material-icons prefix">email</i>
												<label for="email">Email</label>
												<input class="input-editable " readonly id="email" type="email" name="email" value="{{$cliente_editar->usuario->email}}">
												<i data-brother="email" class="icon-button edit material-icons prefix">edit</i>
											</div>
											<div class="input-field col s5">
												<i class="material-icons prefix">credit_card</i>
												<label for="cedula">ID</label>
												<input class="input-editable " readonly id="cedula" type="text" name="cedula" value="{{$cliente_editar->usuario->persona->cedula}}">
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
										      		@if($cliente_editar->usuario->estado === 2)
										      			<label class="btn black">User in black list</label>

										      		@endif
													  <a class='dropdown-trigger btn indigo' href='#' data-target='dropdown1'>Options</a>
													  <ul id='dropdown1' class='dropdown-content'>
													  	<li><a href="#!">See transactions</a></li>
														@if($cliente_editar->usuario->estado === 1)
													    	<li><a href="#!" class="changeState" data-state="2">Send to black list</a></li>

										      			@elseif($cliente_editar->usuario->estado === 2)
													    	<li><a href="#!" class="changeState" data-state="1">Remove from black list</a></li>
										      			@endif
													  </ul>
										      	</center>
										      </div>
										</form>
										<form id="change-state-form" action="{{route('change_state')}}" method="POST" hidden>
											@csrf
											<input name="user_to_change_state" value="{{$cliente_editar->usuario->persona->id}}">
											<input id="state" name="state">
											<input id="changeState" type="submit">
										</form>
									@endif
								</div>
							<div class="col s8 offset-s2">
								<form action="{{route('search_clients')}}" method="get">
									@csrf
									<div class="input-field">
									
										<label for="buscar">Search Client</label>
										<input id="buscar_usuario" type="submit" hidden>
										
										<input id="buscar" type="text" name="buscar">
										<span><label for="buscar_usuario"><i class="icon-button material-icons prefix">search</i></label></span>
										<span class="helper-text"><a href="{{route('clients')}}">Show all clients</a></span>

									</div>
								</form>
							</div>
						</div>
						<div class="row">
							<div class="col s10 offset-s1">
								<ul class="collection">
									@forelse($clientes_todos as $cliente)
								    	<li class="collection-item">
											@if($cliente->estado === 0)
									    		<span data-badge-caption="Don't verified" class="badge new red lighten-3"></span>	
											@else
									    		<span data-badge-caption="Verified" class="badge new green lighten-3"></span>	
											@endif
									    	<b>#{{$cliente->id}}:</b>
									    	<a href="#">{{$cliente->usuario->persona->nombre}}</a>
									    	@if($cliente->usuario->telefono!==null)
									    		<b>Telephone:</b> {{$cliente->usuario->telefono}}
									    	@else
									    		This client haven't registered his telephone
									    	@endif
									    </li>
									@empty
										There's no registered clients
									@endforelse

								</ul>
							</div>
						</div>

					</div>

					<div class="col s12">
						<center>
							See <a href="#">desactivated users</a>
						</center>
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
										<span class="nav-title">Unverified Clients</span>
									</center>
								</div>
							</nav>
							<div class="row">
								<div class="col s10 offset-s1">
							  <ul class="collapsible">
								@foreach($clientes_verificar as $cliente)
							    <li>
							      <div class="collapsible-header"><i class="material-icons">person</i>#{{$cliente->id}} {{$cliente->usuario->persona->nombre}}</div>
							      <div class="collapsible-body">
							      	<table>
							      		<thead>
							      		<tr>
							      			
								      	<th>
								      		<center><b>Nombre Completo</b></center>
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
													  {{$cliente->usuario->persona->nombre}}
										      		</center>
										      	</td>
										      	<td>
									      			@php
									      				$num_attr = 1;

									      				$max_images = count($cliente->imagenesVerificacion);

									      				$str = '';	
									      				foreach($cliente->imagenesVerificacion as $imagen){

									      					$str .= '"'.$imagen->id.'":"'.$imagen->nombre.'"';

									      					//$str .= $imagen->nombre.'"';

										      				if($num_attr++<$max_images){
										      					$str .= ',';
										      				}
									      				}
										      				
									      			@endphp
										      		<center>
										      			<a

										      			class="btn indigo modal-trigger see_images"
										      			href="#see_images"
										      			data-nombre="{{$cliente->usuario->persona->nombre}}"
										      			data-id="{{$cliente->id}}"
										      				data-imagenes='{ {{$str}} }'
										      			>See images</a>

										      		</center>
										      	</td>
							      			</tr>
								      </tbody>
							      	</table>
							    </div>
							    </li>
								@endforeach
							  </ul>

								</div>
							</div>
						</div>
					</div>
				</div>
		</div>

	</div>
  <div id="see_images" class="modal">
    <div class="modal-content">
      <div class="row">
      	<div class="col s12">
      		<center>
      			<h3 id="modal-client-name">Carlos Bolivar</h3>
      		</center>
<form action="{{asset('verify_image_moderator')}}" method="POST" id="verify_image_form" hidden>
	@csrf
	<input type="text" name="id_imagen" id="id_imagen">
	<input type="text" name="estado" id="estado">
</form>
      	</div>
      </div>
      <div class="row">
      	<div id="modal-images-container"></div>
      	
      </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
    </div>
  </div>
          
@endsection
  <!-- Modal Structure -->
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
    	
    	var elems_collapsible = document.querySelectorAll('.collapsible');
	    var instances_collapsible = M.Collapsible.init(elems_collapsible);

 		var elem_modal = document.querySelectorAll('.modal');
    	var instances_modal = M.Modal.init(elem_modal);

    	let modal_client_name = document.getElementById('modal-client-name');

    	function emptyNode(node){

    		while(node.hasChildNodes()){
				node.removeChild(node.firstChild);
			}
    	}
		function setImagesVerification(e){
			let id_imagen = document.getElementById('id_imagen');
			id_imagen.value = e.target.dataset.image_id;
			let estado = document.getElementById('estado');
			estado.value = e.target.dataset.state;
			console.log(e);
			let form_verify = document.getElementById('verify_image_form');
			form_verify.submit();

		}
    	function setModal(e){
    		let button_clicked = e.target;
    		//establezco el id del contenedor donde se va a agregar y eliminar la data
    		let id_div = 'modal-images-container';

    		//Obtengo el div con el id antes configurado
    		let div = document.getElementById(id_div);
    		//let imagenes = button_clicked.dataset.imagenes.split(",");
    		let images_json = JSON.parse(button_clicked.dataset.imagenes);

    		
    		emptyNode(div);

    		//crear los objetos (uno por cada imagen que se tenga)
    			
    			//Crear div.col
    				//let images_array = Object.keys(images_json);
    				//console.log(images_array);


    				//for(let i = 0; i<images_array; i++){

    				for(let key in images_json){
    					let new_div = document.createElement('div');
    					new_div.classList.add('col');
    					new_div.classList.add('s6');
    					//creamos objeto img
    					let image = document.createElement('img');
    					image.setAttribute('height',150);
    					image.setAttribute('width',150);

    					//agregar src
    					image.setAttribute('src','/storage/'+images_json[key]);

    					//agregar clases
    					image.classList.add('responsive-img');

    				//crear boton_aceptar
	    				let boton_aceptar = document.createElement('button');

    					//colocar id imagen en dataset al boton
	    				boton_aceptar.setAttribute('data-image_id',key);

    					//colocar estado (para setear el input) en dataset al boton
	    				boton_aceptar.setAttribute('data-state',1);

	    				//agregamos clases
	    				boton_aceptar.classList.add('btn');
	    				boton_aceptar.classList.add('green');
	    				boton_aceptar.classList.add('verify_image');

	    				//creamos texto del button
	    				let texto_boton_aceptar = document.createTextNode('Verify');

	    				//insertamos texto en el button
	    				boton_aceptar.insertBefore(texto_boton_aceptar,null);


    				//crear boton rechazar
	    				let boton_cancelar = document.createElement('button');

    					//colocar id imagen en dataset al boton
	    				boton_cancelar.setAttribute('data-image_id',key);
    					//colocar estado (para setear el input) en dataset al boton
	    				boton_cancelar.setAttribute('data-state',2);

	    				//agregamos clases
	    				boton_cancelar.classList.add('btn');
	    				boton_cancelar.classList.add('red');
	    				boton_cancelar.classList.add('lighten-3');
	    				boton_cancelar.classList.add('verify_image');

	    				//creamos texto del button
	    				let texto_boton_cancelar = document.createTextNode('Refuse');

	    				//insertamos texto en el button
	    				boton_cancelar.insertBefore(texto_boton_cancelar,null);

	    				
    				/*
    				*/
    					//Insertamos imagen
    					let row = document.createElement('div');
    					row.classList.add('row');

    					let col = document.createElement('div');
    					col.classList.add('col');
    					col.classList.add('s12');
    					let center = document.createElement('center');

	    				col.insertBefore(image,null);
	    				center.insertBefore(col,null);
	    				new_div.insertBefore(center,null);

	    				//Agregamos los botones a una etiqueta center
    					center = document.createElement('center');
	    				center.insertBefore(boton_aceptar,null);
	    				center.insertBefore(boton_cancelar,null);

	    				//Insertamos la etiqueta center
	    				new_div.insertBefore(center,null);

	    				//agregamos todo lo anterior al div del modal
	    				div.insertBefore(new_div,null);

    				    //colocar id imagen
    					//colocar estado (para setear el input)

    					//querido amigo programador... Si ves este mensaje, mi cometido era cambiar las variables a ingles para no hacer una mezcla de idiomas. Lo hice en español porque el estres no me dejaba pensar bien como para, encima, escribir todo en un idioma que no domino del todo... Mil disculpas
    				}	
    				let verify_buttons = document.querySelectorAll('.verify_image');
    				for(let key in verify_buttons){
    					verify_buttons[key].onclick = setImagesVerification;

    				}
    				console.log(button_clicked.dataset);
    				modal_client_name.innerText = button_clicked.dataset.nombre;



    	}
    	let buttons = document.querySelectorAll('.see_images');
    	for(let i = 0; i<buttons.length; i++){
    		buttons[i].onclick = setModal;
    	}

	}
</script>