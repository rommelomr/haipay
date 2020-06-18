@extends('layouts.app')
@extends('layouts.sidenav')
@section('head')
    <link rel="stylesheet" href="{{asset('css/edit_profile.css')}}">
@endsection
@section('main')
	<div class="row">
		<div class="col s10 offset-s1">
			@if ($errors->any())
					<ul>
						@foreach ($errors->all() as $error)
							<li class="error">{{ $error }}</li>
						@endforeach
					</ul>
			@endif
			<div class="card-panel">
				<div class="row">
					<div class="col s12">
						<center>
							<h5>My profile</h5>
						</center>
						
					</div>
				</div>
				<div class="row">

					<div class="col s12">

						<ul class="tabs">

					        <li class="tab col s6"><a href="#test1">Info</a></li>
					        <li class="tab col s6"><a href="#test2">Wallet</a></li>

					    </ul>

					    
					    <div id="test1" class="col s12">
					    	<div class="row">
					    		<br>
					    		<div class="col l6 s12">
									<form action="{{route('save_profile')}}" method="POST">
										@csrf
										<div class="row">
											<div class="col 12">
												@if($incompleted_profile)
													<center>
														<label class="red-text text-lighten-2">You must complete your profile</label>
													</center>
												@endif
											</div>
										</div>
										<div class="row">
											<div class="col s3">

												<span class="left">Name</span> 
											</div>
											<div class="col s9">
												<center>
													<input class="browser-default" id="nombre" type="text" value="{{$current_user_data->persona->nombre}}" name="nombre" id="nombre" class="input-editable">
												</center>
												
											</div>
										</div>
										<div class="row">
											<div class="col s3">
												
												<span class="left">ID</span>
											</div>
											<div class="col s9">
												<center>
													<input class="browser-default" id="cedula" type="text" value="{{$current_user_data->persona->cedula}}" name="cedula" id="cedula" class="input-editable">
												</center>
											</div>
										</div>
										<div class="row">
											<div class="col s3">
												
												<span class="left">Email</span>
											</div>
											<div class="col s9">
												<center>
													<input class="browser-default" id="email" type="text" value="{{$current_user_data->email}}" name="email" id="email" class="input-editable">
												</center>
											</div>
										</div>
										<div class="row">
											<div class="col s3">
												
												<span class="left">Password</span>
											</div>
											<div class="col s9">
												<center>
													<input class="browser-default" id="password" type="text" name="password" id="password" class="input-editable">
												</center>
											</div>
										</div>
										<div class="row">
											<div class="col s3">
												
												<span class="left">Telephone</span>
											</div>
											<div class="col s9">
												<center>
													<input class="browser-default" id="telephone" type="text" value="{{$current_user_data->telefono}}" name="telefono">
												</center>
											</div>
										</div>
										<div class="row">
											
											<div class="input-field col s12">
												<center>
													<input class="btn indigo btn-small" type="submit" value="save" id="button-submit">
												</center>
											</div>
										</div>
									</form>
					    		</div>
					    		<div class="col l6 s12">
									@if(!$account_verified)
										<label class="red-text text-lighten-2">Verify you account now!</label>
									@else
										<label class="blue-text">Account Verified!</label>
									@endif
					    		
									<form method="post" action="{{url('file_Verify')}}" enctype="multipart/form-data">
										@csrf
										<div class="row">

											@php
												$imagen = $current_user_data->cliente->imagenesVerificacion->all();
											@endphp

											<?php $show_button = false; ?>
											@for($i = 0; $i < 2; $i++)
												<?php 
													$hay_imagen = isset($imagen[$i]);
												 ?>
												@if((($hay_imagen) && ($imagen[$i]->estado===2)) || (!$hay_imagen))
													<?php 
														if(!$show_button){
															$show_button = true;
														}
													?>
													@if($hay_imagen)
														<div class="col s6">
															<div class="card">
														        <div class="card-image">
														          <img class="materialboxed" src="{{Storage::url($imagen[$i]->nombre)}}" height="150" width="150">
														        </div>
														        <div class="card-content">
														          <a class="">Image Refused</a>
																	<div class="file-field input-field">
																      <div class="btn">
																        <span>Picture</span>
																        <input type="file" name="file{{$i}}">
																      </div>
																      <div class="file-path-wrapper">
																        <input class="file-path validate" type="text" placeholder="Upload your pictures">
																      </div>
																    </div>
														        </div>
														    </div>
														</div>
													@else
														<div class="col s6 file-field input-field">
													      <div class="btn">
													        <span>Pictures</span>
													        <input type="file" name="file{{$i}}">
													      </div>
													      <div class="file-path-wrapper">
													        <input class="file-path validate" type="text" placeholder="Upload your pictures">
													      </div>
													    </div>
													@endif
												@elseif(($hay_imagen) && ($imagen[$i]->estado===0))
													<div class="col s6">
														<div class="card">
													        <div class="card-image">
													          <img class="materialboxed" src="{{Storage::url($imagen[$i]->nombre)}}" height="150" width="150">
													        </div>
													        <div class="card-content">
													          <a href="#">Waiting for approval</a>
													        </div>
													    </div>
													</div>
												@endif

											@endfor
											@if($show_button)
											    <div clas="col s12">
											    	<center>
											    		<button class="indigo btn">Upload</button>
											    	</center>
											    </div>
											@endif
										</div>

									</form>
					    
						    	</div>
						    </div>
					    </div>
					    <div id="test2" class="col s12">
					    	<div class="row">
					    		<div class="col s8 offset-s2">

							    	<ul class="collection">
								    	@forelse($carteras as $cartera)
								    		<li class="collection-item">
								    			{{$cartera->haiCriptomoneda->moneda->nombre}}
								    			<a href="{{route('dashboard_clients')}}"><span class="badge new green" data-badge-caption="Buy more"></span></a>
								    			<span class="badge">{{$cartera->cantidad}}</span>
								    		</li>
								    	@empty
								    		You haven't bought cryptos yet
								    	@endforelse
							    	</ul>
						    			
					    		</div>
					    	</div>
						</div>
						
					</div>
				</div>
				<div class="card">
				</div>
			</div>
			    
			<div class="row  valign-wrapper">

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

			</div>
		</div>
	</div>
@endsection
<script>
	window.onload = function(){
		let el = document.querySelector('.tabs');
		  var instance = M.Tabs.init(el);
		
		var elems_boxed = document.querySelectorAll('.materialboxed');
    	var instances = M.Materialbox.init(elems_boxed);
	}
</script>