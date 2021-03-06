@extends('layouts.app')
@extends('layouts.sidenav')
@section('head')
    <link rel="stylesheet" href="{{asset('css/edit_profile.css')}}">
@endsection
@section('main')
	<div class="row">
		<div class="col s10 offset-s1">
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

					        <li class="tab col s6"><a
					        	@if($pestana == 1)
					        		class="active"
					        	@endif
					        	href="#test1">Info</a></li>
					        <li class="tab col s6"><a @if(session('wallet') || $pestana == 2) class="active" @endif href="#test2">Wallets</a></li>

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
													<input class="browser-default" type="text" value="{{$current_user_data->persona->nombre}}" disabled>
												</center>
												
											</div>
										</div>
										<div class="row">
											<div class="col s3">
												
												<span class="left">ID</span>
											</div>
											<div class="col s9">
												<center>
													<input class="browser-default" type="text" value="{{$current_user_data->persona->cedula}}" disabled>
												</center>
											</div>
										</div>
										<div class="row">
											<div class="col s3">
												
												<span class="left">Email</span>
											</div>
											<div class="col s9">
												<center>
													<input class="browser-default" type="text" value="{{$current_user_data->email}}" disabled>
												</center>
											</div>
										</div>
										<div class="row">
											<div class="col s3">
												
												<span class="left">Old password</span>
											</div>
											<div class="col s9">
												<center>
													<input class="browser-default" id="password" type="password" name="old_password" id="password" class="input-editable">
												</center>
											</div>
										</div>
										<div class="row">
											<div class="col s3">
												
												<span class="left">New Password</span>
											</div>
											<div class="col s9">
												<center>
													<input class="browser-default" id="password" type="password" name="password" id="password" class="input-editable">
												</center>
											</div>
										</div>

										<div class="row">
											<div class="col s3">
												
												<span class="left">Moncash</span>
											</div>
											<div class="col s9">
												<center>
													<input class="browser-default" name="moncash" type="text" value="{{$current_user_data->moncash}}">
												</center>
											</div>
										</div>
										
										<div class="row">
											<div class="col s3">
												
												<span class="left">Telephone</span>
											</div>
											<div class="col s9">
												<center>
													<input class="browser-default" type="text" value="{{$current_user_data->telefono}}" name="telephone">
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
									<div class="row">
										<b>Referal Link</b>: {{route('register',['r'=>\Auth::user()->id])}}
									</div>
					    		</div>
					    		<div class="col l6 s12">
					    			<center>
										@if(!$account_verified)
											<label class="red-text text-lighten-2">Verify you account now!</label>
										@else
											<label class="blue-text">Account Verified!</label>
										@endif
					    			</center>
									<div class="card-panel">

										@if($id == null || $id->estado == 2)
												<form method="post" action="{{url('verify_client_image')}}" enctype="multipart/form-data">
													@csrf
													<input hidden value="0" name="type">
													<div class="row">
														<div class="col s12">
															<center>
																ID Image
															</center>
														</div>
														<div class="col s12 input-field">
															<input type="file" name="picture">
														</div>
														<center>
															<div class="col s12 input-field">
																<button class="btn green">Send</button>
															</div>
														</center>
													</div>
												</form>
											@if($id != null && $id->estado == 2)
												<div class="card-action">
													<center>
														<span class="red-text">Last image refused</span>
													</center>
												</div>
											@endif

										@elseif($id != null && $id->estado == 0)
											<center>
												<span class="blue-text">Id image waiting for approval</span>
											</center>
										@elseif($id != null && $id->estado == 1)
											<div class="card-image">
												<img src="{{Storage::url($id->nombre)}}" class="responsive-img">
											</div>
											<div class="card-action">
												<center>
													<span class="blue-text">Image Approved</span>
												</center>
											</div>
										@endif
											
									</div>
									<div class="card-panel">
										@if($date == null || $date->estado == 2)
											<form method="post" action="{{url('verify_client_image')}}" enctype="multipart/form-data">
												@csrf
												<input hidden value="1" name="type">
												<div class="row">
													<div class="col s12">
														<center>
															Current date
														</center>
													</div>
													<div class="col s12 input-field">
														<input type="file" name="picture">
													</div>
													<center>
														<div class="col s12 input-field">
															<button class="btn green">Send</button>
														</div>
													</center>
												</div>
											</form>
											@if($date != null && $date->estado == 2)
												<div class="card-action">
													<center>
														<span class="red-text">Last image refused</span>
													</center>
												</div>
											@endif

										@elseif($date != null && $date->estado == 0)
											<center>
												<span class="blue-text">Date image waiting for approval</span>
											</center>
										@elseif($date != null && $id->estado == 1)
											<div class="card-image">
												<img src="{{Storage::url($date->nombre)}}" class="responsive-img">
											</div>
											<div class="card-action">
												<center>
													<span class="blue-text">Image Approved</span>
												</center>
											</div>
										@endif											
										
									</div>
					    
						    	</div>
						    </div>
					    </div>
					    <div id="test2" class="col s12">
					    	<div class="row">
					    		<div class="col s12">

							    	<ul class="collapsible">
								    	@forelse($carteras as $cartera)
								    		@if($cartera->id == session('cartera'))
								    			<li class="active hoverable">
								    		@else
								    			<li class="hoverable">
								    		@endif
								    			<div class="collapsible-header">	    						
							    					<b style="margin-right:2%">{{$cartera->haiCriptomoneda->moneda->nombre}}:</b> 

							    					{{$cartera->cantidad}} {{$cartera->haiCriptomoneda->moneda->siglas}}

								    			</div>
								    			<div class="collapsible-body">
								    				<div class="row">
								    					<div class="col s6 center">
								    						<div class="row">
								    							<div class="col s12">
								    								
												    				<b>Adress: <span class="blue-text tooltipped" data-tooltip="If the adress is not setted, you can't withdraw to an external wallet" data-position="top">?</span></b><br>
												    				<a href="#modify-modal" class="adress-link tooltipped modal-trigger" data-position="top" data-tooltip="Click to insert a new adress" data-route="{{route('update_adress')}}" data-string_type="adress" data-crypto_id="{{$cartera->haiCriptomoneda->id}}">
												    				@if($cartera->direccion == null)
												    					Enter adress
												    				@else
												    					{{$cartera->direccion}}
												    				@endif
												    				</a>
								    							</div>
								    						</div>
								    						@if($cartera->id_hai_criptomoneda == 1 && $cartera->direccion != null)
									    						<div class="row">
									    							<div class="col s12 center">
									    								<b>Tag</b><br>

													    				<a href="#modify-modal" class="tag-link tooltipped modal-trigger" data-position="top" data-tooltip="Click to insert a new tag" data-route="{{route('update_tag')}}" data-string_type="tag" data-cartera_id="{{$cartera->id}}">
														    				@if($cartera->cryptoTag == null)
														    					Enter Tag
														    				@else
														    					{{$cartera->cryptoTag->tag}}
														    				@endif
													    				</a>
									    							</div>
									    						</div>
									    						
								    						@endif
								    					</div>
								    					<div class="col s3 center">
											    			<a class="btn btn-small blue" href="{{route('withdraw',$cartera->haiCriptomoneda->moneda->siglas)}}">
											    				Withdraw
											    			</a>
								    					</div>
								    					<div class="col s3 center">

											    			<a class="btn btn-small green" href="{{route('dashboard_clients')}}">
											    				Buy more
											    			</a>

								    					</div>
								    				</div>
								    			</div>
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

<div id="modify-modal" class="modal">
	<div class="modal-content">
		<h5>Set <span class="string-type"></span></h5>

		<form id="form" method="post">

			@csrf

			<div class="input-field">

				<label for="string">Insert <span class="string-type"></span></label>
				<input id="string" type="text" name="string">

			</div>
			<div hidden>
				<input id="father" name="father">
				<input id="update-submit" type="submit">
				
			</div>
		</form>


	</div>
	<div class="modal-footer">
		<label for="update-submit" class="btn green">Set</label>
		<button class="btn modal-close red">Cancel</button>
	</div>
</div>
@endsection
<script>

	window.onload = function(){

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

		let el = document.querySelector('.tabs');
		var tab_instances = M.Tabs.init(el);

		var elems_tooltip = document.querySelectorAll('.tooltipped');
    	var tooltip_instances = M.Tooltip.init(elems_tooltip);

		var elems_modal = document.querySelectorAll('.modal');
    	var modal_instances = M.Modal.init(elems_modal);

		var elems_boxed = document.querySelectorAll('.materialboxed');
    	var material_box_instances = M.Materialbox.init(elems_boxed);
		
		var elems_collapsible = document.querySelectorAll('.collapsible');
		var collapsible_instances = M.Collapsible.init(elems_collapsible);

	}

</script>
<script type="module" src="{{asset('js/profile/main.js')}}"></script>