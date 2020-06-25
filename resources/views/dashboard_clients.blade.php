@extends('layouts.app')
@extends('layouts.sidenav')
@section('head')
    <link rel="stylesheet" href="{{asset('css/dash_clients.css')}}">
@endsection
@section('main')
    <div class="container-fluid">
	@foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    <div class="container-fluid" style="padding:2%;">
    	
        <div class="row">
            <div id="login" class="col s12 card-panel">
                <div class="row">

				    <div class="col s12">
				    	<ul class="tabs tabs-fixed-width">

				        	<li class="tab">
				        		@if(isset($_GET['tab']) && $_GET['tab']==1)
				        			<a class="active" href="#comprar-criptomoneda"><span class="color-indigo hide-on-small-only">Buy Cripto</span> <i class="color-indigo material-icons">shopping_cart</i></a>
				        		@else
				        			<a href="#comprar-criptomoneda"><span class="color-indigo hide-on-small-only">Buy Cripto</span> <i class="color-indigo material-icons">shopping_cart</i></a>
				        		@endif
				        	</li>
				        	<li class="tab">
				        		@if(isset($_GET['tab']) && $_GET['tab']==3)
				        			<a class="active" href="#enviar-remesa"><span class="color-indigo hide-on-small-only">Send Remittance</span> <i class="color-indigo material-icons">people</i></a>
				        		@else
				        			<a href="#enviar-remesa"><span class="color-indigo hide-on-small-only">Send Remittance</span> <i class="color-indigo material-icons">people</i></a>
				        		@endif
				        	</li>
				        	<li class="tab">
				        		@if(isset($_GET['tab']) && $_GET['tab']==4)
				        			<a class="active" href="#mis-envios"><span class="color-indigo hide-on-small-only">My Sends</span><i class="color-indigo material-icons">person</i></a>
				        		@else
				        			<a href="#mis-envios"><span class="color-indigo hide-on-small-only">My Sends</span><i class="color-indigo material-icons">person</i></a>
				        		@endif
				        	</li>
				        	<li class="tab">
				        		@if(isset($_GET['tab']) && $_GET['tab']==5)
				        			<a class="active" href="#rerirar-dinero"><span class="color-indigo hide-on-small-only">Retire Money</span><i class="color-indigo material-icons">system_update_alt</i></a>
				        		@else
				        			<a href="#rerirar-dinero"><span class="color-indigo hide-on-small-only">Retire Money</span><i class="color-indigo material-icons">system_update_alt</i></a>
				        		@endif
				        	</li>
				        	
				      	</ul>

				    </div>
				    <div id="comprar-criptomoneda" class="col s12">
						<div class="row"><br>
							<div id="buy-criptos" class="scroll-y col s12">
								<center>
									<h5>Buy Cripto</h5>	
									<div class="row">
										@foreach($criptomonedas as $criptomoneda)
										<div class="card-cripto col s6 l3">
											<div class="card">
												<div class="card-content">
													<b>{{$criptomoneda->moneda->siglas}}</b><br>
													<span class="precio-{{$criptomoneda->moneda->siglas}}-USD">cargando</span> $
												</div>
												<div class="card-action">
													<div class="row" style="margin:0">
														<div class="col s6">
															<center>
																<a href="{{route('buy_crypto',$criptomoneda->moneda->siglas)}}">
																	<i class="material-icons" style="color:green">add_shopping_cart</i>
																</a>
															</center>
														</div>
														<div class="col s6">
															<center>
																<a href="{{route('trade',$criptomoneda->moneda->siglas)}}"><i class="material-icons">autorenew</i></a>
															</center>
														</div>

													</div>
												</div>
											</div>
										</div>


										@endforeach
									</div>
								</center>
							</div>

							
						</div>
				    </div>
				    <div id="enviar-remesa" class="col s12 padding-0"><br>
				    	<div id="row-comprobar-pagos" class="row margin-0 grey lighten-3">
					    	<center>
					    		<h5>				    			
					    			Send Remittance
					    		</h5>
					    	</center>
					    	<div class="col s12">
							<form action="enviarRemesas" method="post">
								@csrf
					    		<div class="row">
						    		<div class="col l6 s12">
				    					<center>
				    					</center>
				    					
						    			<div class="input-field	margin-0">
						    				<center>
				    						<b>Receiver Info</b>
						    					<div class="switch">
												    <label>
													    Other person
													    <input type="checkbox" checked="true">
													    <span class="lever"></span>
													    User
												    </label>
												</div>
						    				</center>
										</div>
						    			<div id="user-data-container" hidden>
							    			<div class="row">
							    				<div class="col s11">
									    			<div class="input-field">
									    				<label for="id_client">User's email</label>
									    				<input id="id-client" type="text">
									    				<i class="material-icons prefix">search</i>
									    			</div>
							    				</div>
							    			</div>
							    			<div id="datos-usaurio">
							    				<center>
								    				<b>Name:</b> <span id="nombre-usuario">Rommel Omar Montoya Rodriguez</span><br>
							    				</center>
							    			</div>
						    			</div>
						    			<div id="person-data-container">
						    				<div class="row">
						    					<div class="col s12">
						    						<div class="input-field">
						    							<label for="nombre-receiver">Receiver's complete name</label>
						    							<input name="nombre" id="nombre-receiver" type="text" class="autocomplete">
						    						</div>
						    						<div class="input-field">
						    							<label for="cedula-receiver">Receiver's identification number</label>
						    							<input name="cedula" id="cedula-receiver"type="text">
						    						</div>
						    						
						    					</div>
						    				</div>
						    			</div>
						    		</div>
						    		<div class="col l6 s12">
				    					<center>
				    						<b>Remittance<br>Info</b>
				    					</center>
						    			<div class="row">
						    				<div class="col s12">
								    			<div class="input-field">
								    				<label for="monto">Amount</label>
								    				<input name="monto" id="monto" type="text">
							    				</div>
							    			</div>
							    		</div>
						    			<div class="row">
						    				<div class="col s6">
							    				<div class="input-field">
													<select name="type_operation" class="browser-default">
														<option disabled selected value="none">Payment Method</option>
														@foreach($metodos_pago as $metodo_pago)
															<option value="{{$metodo_pago->id}}">{{$metodo_pago->nombre}}</option>
														@endforeach
													</select>	
							    				</div>
							    			</div>
							    			<div class="col s6">
							    				<div class="input-field">
													<select name="retirement_method" class="browser-default">
														<option disabled selected value="none">Retirement Method</option>
														@foreach($retirement_methods as $retirement_method)
															<option value="{{$retirement_method->id}}">{{$retirement_method->nombre}}</option>
														@endforeach
													</select>	
							    				</div>
							    			</div>
							    			
							    			
						    			</div>
						    			<div class="row">
						    				<div class="col s12">
						    					<center>
						    						
							    				<div class="input-field">
							    					<center>
							    						<input class="btn btn-small indigo" type="submit" value="Send Remittance">
							    					</center>

							    				</div>
						    					</center>
						    				</div>
						    			</div>

						    		</div>

					    		</div>
							</form>
					    	</div>
				    	</div>
				    </div>
				    <div id="mis-envios" class="col s12"><br>
				    	<div class="row grey lighten-3">
				    		<br>
				    			<center>
				    				
				    				<h5>My Remittances</h5>
				    			</center>
				    		<div class="col s12 l6">
				    			<div class="card-panel">
									<b>Verify your remittances</b>
				    				<div>
							    		<ul class="collection">
										    @forelse($pending_remittances as $remittance)
										    	<li class="collection-item">
										    		
												    <div class="collapsible-item">
													    {{$remittance->monto}} $ to
													    @if($remittance->id_tipo_remesa == 1)
													    	{{$remittance->internal->cliente->usuario->persona->nombre}}
													    @else
													    	{{$remittance->external->noUsuario->persona->nombre}}
													    @endif
													    <a href="#modal_delete_transaction" class="delete_transaction modal-trigger secondary-content"><i data-id_transaction="{{$remittance->id_transaccion}}" class="material-icons">delete</i></a>
													    <a href="#modal_send_images" class="send_image modal-trigger secondary-content"><i data-id_transaction="{{$remittance->id_transaccion}}" class="material-icons">image</i></a>
													</div>
										    	</li>
									    	@empty
									    		There's no remmitances pending
									    	@endforelse
										</ul>
										<center>

											{{$pending_remittances->appends(['pending_remittances'=>$pending_remittances->currentPage()])->links('commons.pagination',[
												'paginate' => $pending_remittances,
												'max_buttons' => 5
											])}}
										</center>
				    				</div>
				    				<b>Waiting for approval</b>
				    				<div>
							    		<ul class="collection">
										    @forelse($for_approval_remmitances as $remittance)
										    
										    	<li class="collection-item">

												    <div class="collapsible-item">
													    {{$remittance->monto}} $ to
													    @if($remittance->id_tipo_remesa == 1)
													    	{{$remittance->internal->cliente->usuario->persona->nombre}}
													    @else
													    	{{$remittance->external->noUsuario->persona->nombre}}
													    @endif
													    <a href="#modal_delete_transaction" class="delete_transaction modal-trigger secondary-content"><i data-id_transaction="{{$remittance->id_transaccion}}" class="material-icons">delete</i></a>
													    <a href="#modal_send_images" data-id_transaction="{{$remittance->id_transaccion}}"  class="resend_image modal-trigger secondary-content"><i class="material-icons" data-id_transaction="{{$remittance->id_transaccion}}">replay</i></a>
													    <a href="#" class="secondary-content"><i class="material-icons">remove_red_eye</i></a>
													</div>
										    	</li>
									    	@empty
									    		There's no remmitances waiting for approval
									    	@endforelse
										</ul>
										<center>
											{{$for_approval_remmitances->appends(['for_approval_remmitances'=>$for_approval_remmitances->currentPage()])->links('commons.pagination',[
												'paginate' => $for_approval_remmitances,
												'max_buttons' => 5
											])}}
										</center>
				    				</div>
				    				
				    			</div>

				    		</div>
				    		<div class="col s12 l6">
				    			<div class="card-panel">
				    				<div>
										<b>Refused</b>
							    		<ul class="collection">
										    @forelse($refused_remittances as $remittance)
										    
										    	<li class="collection-item">

												    <div class="collapsible-item">
													    {{$remittance->monto}} $ to
													    @if($remittance->id_tipo_remesa == 1)
													    	{{$remittance->internal->cliente->usuario->persona->nombre}}
													    @else
													    	{{$remittance->external->noUsuario->persona->nombre}}
													    @endif
													    <a href="#modal_delete_transaction" class="delete_transaction modal-trigger secondary-content"><i class="material-icons" data-id_transaction="{{$remittance->id_transaccion}}">delete</i></a>
													    <a href="#modal_send_images" class="resend_image modal-trigger secondary-content"><i class="material-icons" data-id_transaction="{{$remittance->id_transaccion}}">replay</i></a>
													    <a href="#" class="secondary-content"><i class="material-icons">remove_red_eye</i></a>
													</div>
										    	</li>
									    	@empty
									    		There's no remmitances refused
									    	@endforelse
										</ul>
										<center>
											{{$refused_remittances->appends(['refused_remittances'=>$refused_remittances->currentPage()])->links('commons.pagination',[
												'paginate' => $refused_remittances,
												'max_buttons' => 5
											])}}
										</center>
				    				</div>
				    				<b>Approved</b>
				    				<div>
							    		<ul class="collection">
										    @forelse($approved_remittances as $remittance)

										    	<li class="collection-item">
												    {{$remittance->monto}} $ to
												    @if($remittance->id_tipo_remesa == 1)
												    	{{$remittance->internal->cliente->usuario->persona->nombre}}
												    @else
												    	{{$remittance->external->noUsuario->persona->nombre}}
												    @endif
												    <span class="secondary-content"><i class="material-icons">check_box</i></span>
										    	</li>
									    	@empty
									    		There's no remmitances approved
									    	@endforelse
										</ul>
										<center>
											{{$approved_remittances->appends(['approved_remittances'=>$approved_remittances->currentPage()])->links('commons.pagination',[
												'paginate' => $approved_remittances,
												'max_buttons' => 5
											])}}
										</center>
				    				</div>
				    			</div>
				    		</div>
				    	</div>
				    </div>
				    <div id="rerirar-dinero" class="col s12"><br>
				    	<div class="row margin-0 grey lighten-3">
				    		<div class="col s12">
				    			<center>				    				
				    				<h5>Retire Money</h5>
				    			</center>
				    		</div>
				    		<div class="col s12 l4">
				    			<center>				    				
				    				<b>Remittances</b>

								    <ul class="collection">
								      <li class="collection-item">Alvin has sended you a remittance (100$)</li>
								      <li class="collection-item">Nazareth has sended you a remittance (100$)</li>
								      <li class="collection-item">Christian has sended you a remittance (100$)</li>
								      <li class="collection-item">Marcos has sended you a remittance (100$)</li>
								    </ul>
								            
				    			</center>
				    		</div>
				    		<div class="col s12 l8">
				    			<center>				    				
				    				<b>My criptos</b>
				    			</center>
				    			<div class="row">
		    						<div class="col s3" style="padding:1%;">
		    							<div class="coin-card card-panel">
		    								<center>
		    									<b>BTC:</b><br>123
		    									<hr>
		    									<div class="row retire-all-container">
		    										<a href="#modal-retire" class="modal-trigger btn indigo btn-small">retire</a>
		    									</div>
		    									<div class="row margin-0">
		    										<a href="#modal-retire" class="modal-trigger btn indigo btn-small">retire all</a>
		    									</div>
		    								</center>
		    							</div>
		    						</div>
		    						<div class="col s3" style="padding:1%;">
		    							<div class="coin-card card-panel">
		    								<center>
		    									<b>LTC:</b><br>123
		    									<hr>
		    									<div class="row retire-all-container">
		    										<a href="#modal-retire" class="modal-trigger btn indigo btn-small">retire</a>
		    									</div>
		    									<div class="row margin-0">
		    										<a href="#modal-retire" class="modal-trigger btn indigo btn-small">retire all</a>
		    									</div>
		    								</center>
		    							</div>
		    						</div>
		    						<div class="col s3" style="padding:1%;">
		    							<div class="coin-card card-panel">
		    								<center>
		    									<b>ETH:</b><br>123
		    									<hr>
		    									<div class="row retire-all-container">
		    										<a href="#modal-retire" class="modal-trigger btn indigo btn-small">retire</a>
		    									</div>
		    									<div class="row margin-0">
		    										<a href="#modal-retire" class="modal-trigger btn indigo btn-small">retire all</a>
		    									</div>
		    								</center>
		    							</div>
		    						</div>
		    						<div class="col s3" style="padding:1%;">
		    							<div class="coin-card card-panel">
		    								<center>
		    									<b>XRP:</b><br>123
		    									<hr>
		    									<div class="row retire-all-container">
		    										<a href="#modal-retire" class="modal-trigger btn indigo btn-small">retire</a>
		    									</div>
		    									<div class="row margin-0">
		    										<a href="#modal-retire" class="modal-trigger btn indigo btn-small">retire all</a>
		    									</div>
		    								</center>
		    							</div>
		    						</div>
				    			</div>
				    		</div>
				    	</div>
				    </div>
				    

            	</div>
            </div>
        </div>
    </div>
    </div>

<div id="modal-retire" class="modal">
	<div id="modal-content" class="modal-content margin-0">
			
		<div class="row margin-0">
			<div id="cabecera-modal" class="indigo margin-0">
				<center>
					<h4>You have 123 <span id="amount-coins-to-retire">Coin</span></h4>
				</center>
			</div>
		</div>
		<div class="row margin-0" style=";padding: 0;">
			<div class="col s12">
			<form action="">
				<div class="input-field col s12 l6">
					<label for="coins-to-retire">Amount (<b>cripto</b>) to retire</label>
					<input id="coins-to-retire" type="text">
				</div>
				<div class="input-field col s12 l6">
					<select name="" id="" class="browser-default">
						<option disabled selected>Payment Method</option>
						<option id="option-same-coin" value=""><span id="same-coin">same coin</span></option>
						<option value="">Paypal</option>
						<option value="">"W.U."</option>
						<option value="">"Zelle"</option>
					</select>
				</div>
				<div class="input-field col s12">
					<center>
						
						Retiring N Coins you will recive M $
					</center>
				</div>
				<div class="input-field col s12">
					<center>						
						<button class="btn indigo btn-small">Retire</button>
					</center>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>

<div id="modal_send_images" class="modal">
	<div id="modal-content" class="modal-content margin-0">
		<center><h4 id="modal-title"></h4></center>
	<form id="verificaction_form" method="POST" enctype="multipart/form-data">@csrf
		<input id="id_transaction" name="id_transaction" hidden>
		<div class="row">
			<div class="col s6 file-field">
				<center>
					
			      <div class="btn btn-small">
			        <span>Pictures</span>
			        <input type="file" name="file">
			      </div>
			      <div class="file-path-wrapper">
			        <input class="file-path validate" type="text" placeholder="Upload your pictures">
			      </div>
				</center>
		    </div>
			<div class="col s6 input-field">
				<center>
					<button class="btn">Send</button>
				</center>
		    </div>
		</div>
	</form>
	</div>
</div>
<div id="modal_delete_transaction" class="modal">
	<div id="modal-content" class="modal-content margin-0">
		<center>Are you sure you want to delete this transaction?</center>
	<form id="form_delete_transaction" method="POST" enctype="multipart/form-data">@csrf
		<input id="id_transaction_delete" name="id_transaction" hidden>
		<div class="row">
			<div class="col s12 input-field">
				<center>
					<button class="btn indigo">Delete</button>
				</center>
		    </div>
		</div>
	</form>
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
		
 		let elem_modal = document.querySelectorAll('.modal');
    	let instances_modal = M.Modal.init(elem_modal);

		let el = document.querySelector('.tabs');
		let instance_tabs = M.Tabs.init(el);

    	let elem_collapsible = document.querySelectorAll('.collapsible');
    	let instances_collapsible = M.Collapsible.init(elem_collapsible);

    	let elems_select = document.querySelectorAll('select');
    	let instances_select = M.FormSelect.init(elems_select);

	});

</script>
<script type="module">
	import {D} from "{{asset('js/Domm/Domm.js')}}";
	import {Me} from "{{asset('js/dashboard/Methods.js')}}";
	D.dom.load(function(){

		let comision_general 	= JSON.parse(Me.htmlDecode("{{$comision_general}}"));

		let info_criptos 		= JSON.parse(Me.htmlDecode("{{$info_cryptos}}"));

		Me.launchWsConsult(info_criptos,comision_general);
	});
	
</script>
<script src="{{asset('js/verify_payment/main.js')}}" type="module"></script>