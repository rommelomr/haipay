@extends('layouts.app')
@extends('layouts.sidenav')
@section('head')
    <link rel="stylesheet" href="{{asset('css/edit_profile.css')}}">
@endsection
@section('main')
	<div class="row">
		<div class="col s10 offset-s1">
			<div class="card">
				<nav class="nav-extended indigo">
					<div class="nav-content">
						<center>
							<span class="nav-title">Edit Profile</span>
						</center>
					</div>
				</nav>
				<div class="row">
					<div class="card-content col s6">
						@if($incompleted_profile)
							<nav>
								<div class="nav-wrapper red lighten-3">
									<center>
										Complete your profile
									</center>
								</div>
							</nav>
						@endif
						<form class="row" action="{{route('save_profile')}}" method="POST">
							@csrf
							<div class="input-field col s5">
								<label for="nombre">Name</label>
								<input id="nombre" type="text" value="{{$current_user_data->persona->nombre}}" name="nombre" id="nombre" class="input-editable">
								<i class="prefix material-icons edit" data-brother="nombre">edit</i>
							</div>
							<div class="input-field col s5 offset-s1">
								<label for="cedula">ID</label>
								<input id="cedula" type="text" value="{{$current_user_data->persona->cedula}}" name="cedula" id="cedula" class="input-editable">
								<i class="prefix material-icons edit" data-brother="cedula">edit</i>
							</div>
							<div class="input-field col s5">
								<label for="email">Email</label>
								<input id="email" type="text" value="{{$current_user_data->email}}" name="email" id="email" class="input-editable">
								<i class="prefix material-icons edit" data-brother="email">edit</i>
							</div>
							<div class="input-field col s5 offset-s1">
								<label for="password">Password</label>
								<input id="password" type="text" name="password" id="password" class="input-editable">
								<i class="prefix material-icons edit" data-brother="password">edit</i>
							</div>
							<div class="input-field col s12">
								<label for="telephone">Telephone</label>
								<input id="telephone" type="text" value="{{$current_user_data->telefono}}" name="telefono">
							</div>
							<div class="input-field col s12">
								<center>
									<input class="btn indigo" type="submit" value="save">
								</center>
							</div>
						</form>
					</div>
					<div class="card-content col s6" hidden>
						<nav class="green lighten-3">
							<center>
								Account Verified
							</center>
						</nav>
						<div class="row">
							<div class="col s6">
								<img src="{{asset('images/fondo_login_2.jpg')}}" class="responsive-img">
							</div>
							<div class="col s6">
								<img src="{{asset('images/fondo_login_2.jpg')}}" class="responsive-img">
							</div>

						</div>
					</div>
					<div class="card-content col s6" >
						<nav class="red lighten-3">
							<center>
								Verify you account now!
							</center>
						</nav>
						<form method="post" action="{{url('file_Verify')}}" enctype="multipart/form-data">
							@csrf
							<div class="file-field input-field">
						      <div class="btn">
						        <span>Pictures</span>
						        <input type="file" multiple required>
						      </div>
						      <div class="file-path-wrapper">
						        <input class="file-path validate" type="text" placeholder="Upload your pictures">
						      </div>
						    </div>
						    <div clas="col s12">
						    	<center>
						    		<button class="indigo btn">Upload</button>
						    	</center>
						    </div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
<script>
	window.onload = function(){
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
			  	button.removeAttribute('disabled');
			}
		}
		function activateSubmit(e){
			var input_modified = old_input_value == input.value;
			if(!submitEnabled && !input_modified){
			  	var button = document.getElementById('button-submit');
			  	button.removeAttribute('disabled');
			}
		}
		var submitEnabled = false;
		var button = document.getElementById('button-submit');
		button.setAttribute('disabled',true);

	  	var edit = document.querySelectorAll('.edit');
	  	var max = edit.length;
	  	for(var i = 0; i<max; i++){
	  		edit[i].onclick = selectInput;
		}

		var inputs = document.querySelectorAll('.input-editable');
		var max = inputs.length;
		for(var i = 0; i<max; i++){
		  	inputs[i].setAttribute('readonly',true);
		  	inputs[i].onkeyup = activateSubmit;
		}
	}
</script>