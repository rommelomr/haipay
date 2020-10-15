@extends('layouts.app')
@extends('layouts.sidenav')
@section('head')
    <link rel="stylesheet" href="{{asset('css/dash_clients.css')}}">
@endsection
@section('main')
    <div class="container-fluid">
	    <div class="container-fluid" style="padding:2%;">
	        <div id="login" class="col s12 card-panel">

	                <div class="row">
	                	<div class="col s12">
	                		<h5 class="center">Remittances</h5>
	                	</div>
	                </div>
	                <div class="row">
					    <div id="enviar-remesa" class="col s12 padding-0"><br>
					    	<div class="card-panel">
					    		<div class="row">
					    			<div class="col s12">
					    					
					    				<div class="row">

					    					<form id="send-remittance-form" action="{{route('confirmar_remesa')}}" method="post">
					    						@csrf

						    					<div class="col s6 input-field tooltipped" data-position="top" data-tooltip="Write the receiver's id and press enter to verify it">

						    						<label for="cedula_receptor">Receiver's ID</label>

						    						<input autocomplete="off" id="cedula_receptor" type="text" name="receivers_id" value="{{old('receivers_id')}}">


						    						<span class="helper-text">If the receiver's id is not registered, you must enter his/her full name to continue.</span>

						    					</div>

						    					<div class="col s6 input-field">
						    						<label for="monto">Amount</label>
						    						<input autocomplete="off" id="monto" type="text" name="amount_to_send" value="{{old('amount_to_send')}}">
						    					</div>
						    					<div class="col s12 input-field">
						    						
						    						<input placeholder="Receiver's name" id="nombre_receptor" type="text" name="receivers_name" value="{{old('receivers_name')}}"
						    						autocomplete="off">

						    						<span class="id-not-found-message red-text" hidden>You're about to send money to a person who is not in our records. Please, introduce the receiver's full name.</span>
						    					</div>


							    				</div>
						    					<div class="row">
							    					<div class="col s6 input-field">
														<select name="payment_method" class="browser-default">
															<option disabled selected value="none">Payment Method</option>
															@foreach($metodos_pago as $metodo_pago)
																<option value="{{$metodo_pago->id}}"
																	@if(old('payment_method') == $metodo_pago->id)
																		selected
																	@endif
																>{{$metodo_pago->nombre}}</option>
															@endforeach
														</select>	
							    					</div>
							    					<div class="col s6 input-field">
														<select name="retirement_method" class="browser-default">

															<option disabled selected value="none">Retirement Method</option>
															
															@foreach($retirement_methods as $retirement_method)
																<option value="{{$retirement_method->id}}"
																	@if(old('retirement_method') == $retirement_method->id)
																		selected
																	@endif
																>{{$retirement_method->nombre}}</option>
															@endforeach
														</select>
							    					</div>
						    					</div>
						    					<input type="submit" id="input-submit" hidden>
						    				</form>
					    				</div>
				    					<div class="row">
				    						<div class="col s12">
				    							<center>
				    								<a id="" href="#modal-confirm" class="btn btn-small green modal-trigger">Send</a>
				    							</center>
				    						</div>
				    					</div>
						    		</div>
						    	</div>
						    </div>
					    </div>
					    <!--div id="arerirar-dinero" class="col s12"><br>
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
					    </div-->
					    

	            	</div>
	        </div>
	    </div>
    </div>

<div id="modal-confirm" class="modal">
	<div id="modal-content" class="modal-content margin-0">
		<center>
			<h5>Are you sure you want to send now?</h4>
		</center>
	</div>
	<div class="modal-footer">
		<label for="input-submit" class="btn green">Yes</label>
		<button class="btn red darken-2 modal-close">No</button>
	</div>
</div>

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
		let el_tabs = document.querySelector('.tabs');
		let instance_tabs = M.Tabs.init(el_tabs);

 		let elem_modal = document.querySelectorAll('.modal');
    	let instances_modal = M.Modal.init(elem_modal);

		var elems_tooltip = document.querySelectorAll('.tooltipped');
    	var instances = M.Tooltip.init(elems_tooltip);

	});
</script>
@endsection
<script type="module">
	import {D} from "{{asset('js/Domm/Domm.js')}}";
	import {Me} from "{{asset('js/remittances/Methods.js')}}";

	D.dom.load(function(){

		let input_receiver_name = document.getElementById('nombre_receptor');
		let send_button = document.getElementById('boton_enviar');
		let id_not_found_message = document.querySelector('.id-not-found-message');		

		D.addEvent.onKeyUp('#cedula_receptor',function(el,ev){

			if(el.value != ''){

				input_receiver_name.value = 'loading';
				Me.consultarPersonasPorCedula(id_not_found_message,send_button,input_receiver_name,el.value,"{{route('consultar_persona_por_cedula')}}");
			}

		});
		D.addEvent.onKeyUp('#nombre_receptor',function(el,ev){

			if(send_button.hasAttribute('disabled') && !input_receiver_name.hasAttribute('readonly')){

				send_button.removeAttribute('disabled');
			}
		});

		D.addEvent.onKeyPress('#send-remittance-form',function(el,ev){
			
			return ev.which != 13;
			
		});

	});

</script>