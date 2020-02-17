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
        <div class="row">
            <div id="login" class="col s10 offset-s1 l10 offset-l1 card-panel">
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
				        	<li class="tab ">
				        		@if(isset($_GET['tab']) && $_GET['tab']==2)
				        			<a class="active" href="#comprobar-pagos"><span class="color-indigo hide-on-small-only">Verify Payments</span> <i class="color-indigo material-icons">image</i></a>
				        		@else
				        			<a href="#comprobar-pagos"><span class="color-indigo hide-on-small-only">Verify Payments</span> <i class="color-indigo material-icons">image</i></a>
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
							<div id="buy-criptos" class="scroll-y col s12 l9">
								<center>
									<h5>Buy Cripto</h5>	
									<div class="row">
										@foreach($criptomonedas as $criptomoneda)
										<div class="card-cripto col s6 l3">
											<div class="card-panel">
												<b>1 {{$criptomoneda->moneda->siglas}}</b><br><span class="precio-{{$criptomoneda->moneda->siglas}}-USD">cargando</span> $<br>
												<a href="#modal-acquire-cripto" data-nombre_cripto="{{$criptomoneda->moneda->nombre}}" data-id_cripto="{{$criptomoneda->id}}" data-siglas_cripto="{{$criptomoneda->moneda->siglas}}" class="btn indigo modal-trigger buy-cripto">Acquire</a>

											</div>
										</div>


										@endforeach
									</div>
								</center>
							</div>

							<div id="my-criptos" class="scroll-y col s12 l3">
								<center>
									<hr>
									<b>My Criptos</b>
									<hr>
									<table class="centered">
										<thead>
											<tr>
												<th>Name</th>
												<th>Sum</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>Bitcoin</td>
												<td>0.000000001</td>
											</tr>
											<tr>
												<td>Bitcoin</td>
												<td>0.000000001</td>
											</tr>
											<tr>
												<td>Bitcoin</td>
												<td>0.000000001</td>
											</tr>
											<tr>
												<td>Bitcoin</td>
												<td>0.000000001</td>
											</tr>
										</tbody>
									</table>
								</center>
							</div>
						</div>
				    </div>
				    <div id="comprobar-pagos" class="col s12 padding-0">
				    	<br>
				    	<div class="row margin-0 grey lighten-3">
				    		<div class="col l4 offset-l2 s12">
				    			
					    		<center>
					    			<h5>Payments don't Verified</h5>
					    		</center>
					    		<ul class="collapsible">
								    <li>
									    <div class="collapsible-header"><i class="material-icons">
									    indeterminate_check_box</i>100$ for 0.00000100 BTC</div>
									    <div class="collapsible-body">
									    	<div class="row margin-0">
									    		<div class="col s12">
									    			<center>
									    				
									    				You must send a picture with the deposit to verify your payment
									    			</center>
									    		</div>
										    	<form action="">
										    		<div class="input-field col s12">
										    			<center>
										    				
										    				<button class="btn btn-small indigo">Send Pictures</button>
										    			</center>
										    		</div>
										    	</form>
									    	</div>
									    </div>
								    </li>
								    <li>
									    <div class="collapsible-header"><i class="material-icons">
									    indeterminate_check_box</i>150$ for 0.00000150 BTC</div>
									    <div class="collapsible-body">
									    	<div class="row margin-0">
									    		<div class="col s12">
									    			<center>
									    				
									    				You must send a picture with the deposit to verify your payment
									    			</center>
									    		</div>
										    	<form action="">
										    		<div class="input-field col s12">
										    			<center>
										    				
										    				<button class="btn btn-small indigo">Send Pictures</button>
										    			</center>
										    		</div>
										    	</form>
									    	</div>
									    </div>
									</li>
								    <li>
									    <div class="collapsible-header"><i class="material-icons">
									    indeterminate_check_box</i>0.000000010 BTC for 0.000000008 BTC</div>
									    <div class="collapsible-body">
									    	<div class="row margin-0">
									    		<div class="col s12">
									    			<center>
									    				
									    				You must send a picture with the deposit to verify your payment
									    			</center>
									    		</div>
										    	<form action="">
										    		<div class="input-field col s12">
										    			<center>
										    				
										    				<button class="btn btn-small indigo">Send Pictures</button>
										    			</center>
										    		</div>
										    	</form>
									    	</div>
									    </div>
								    </li>
								</ul>
				    		</div>

				    		<div class="col l4 s12">
				    			
					    		<center>
					    			<h5>Payments Verified by Me</h5>
					    		</center>
					    		<ul class="collapsible">
								    <li>
									    <div class="collapsible-header"><i class="material-icons">check_box</i>100$ for 0.00000100 BTC</div>
									    <div class="collapsible-body">
									    	<div class="row margin-0">
									    		<div class="col s12">
									    			
									    			Wait while an Administrator verify the images
									    		</div>
									    		<form action="">
									    			<div class="input-field col s12">
									    				<center>
									    					
									    					<button class="btn btn-small indigo">Resend Pictures</button>
									    				</center>
									    			</div>
									    		</form>
									    	</div>
									    </div>
								    </li>
								    <li>
									    <div class="collapsible-header"><i class="material-icons">check_box</i>150$ for 0.00000150 BTC</div>
									    <div class="collapsible-body">
									    	<div class="row margin-0">
									    		<div class="col s12">
									    			
									    			Wait while an Administrator verify the images
									    		</div>
									    		<form action="">
									    			<div class="input-field col s12">
									    				<center>
									    					
									    					<button class="btn btn-small indigo">Resend Pictures</button>
									    				</center>
									    			</div>
									    		</form>
									    	</div>
									    </div>
									</li>
								    <li>
									    <div class="collapsible-header"><i class="material-icons">check_box</i>0.000000010 BTC for 0.000000008 BTC</div>
									    <div class="collapsible-body">
									    	<div class="row margin-0">
									    		<div class="col s12">
									    			
									    			Wait while an Administrator verify the images
									    		</div>
									    		<form action="">
									    			<div class="input-field col s12">
									    				<center>
									    					
									    					<button class="btn btn-small indigo">Resend Pictures</button>
									    				</center>
									    			</div>
									    		</form>
									    	</div>
									    </div>
								    </li>
								</ul>
				    		</div>
				    		<div class="col s12">
				    			<center>
				    				Watch all completed <a href="#">payments</a>
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
						    							<input id="nombre-receiver" type="text" class="autocomplete">
						    						</div>
						    						<div class="input-field">
						    							<label for="cedula-receiver">Receiver's identification number</label>
						    							<input id="cedula-receiver"type="text">
						    						</div>
						    						
						    					</div>
						    				</div>
						    			</div>
						    		</div>
						    		<div class="col l6 s12">
						    			<div class="row">
						    				<div class="col s12">
						    					<center>
						    						<b>Remittance<br>Info</b>
						    					</center>
								    			<div class="input-field">
								    				<label for="monto">Amount</label>
								    				<input id="monto" type="text">
							    				</div>
							    				<div class="input-field">
								    				<select name="" id="">
								    					<option disabled selected>Payment Method</option>
								    					<option>Paypal</option>
								    					<option>W.U.</option>
								    					<option>Zelle</option>
								    				</select>
							    				</div>
							    				
							    				<div class="input-field">
							    					<center>
							    						
							    						<button class="btn btn-small indigo">Send Remittance</button>
							    					</center>

							    				</div>
							    				
							    			</div>
						    			</div>
						    		</div>

					    		</div>
					    	</div>
				    	</div>
				    </div>
				    <div id="mis-envios" class="col s12"><br>
				    	<div class="row grey lighten-3">
				    		<div class="col s12 l8 offset-l2">
				    			<center>
				    				
				    				<h5>My Remittances</h5>
				    			</center>
				    			
					    		<ul class="collapsible">
								    <li>
									    <div class="collapsible-header"><i class="material-icons">
									    indeterminate_check_box</i>100$ to Alexander Tejera</div>
									    <div class="collapsible-body">
									    	<div class="row margin-0">
									    		<div class="col s12">
									    			<center>
									    				
									    				You must verify this remittance sending a picture with the deposit<br>
										    			<button class="btn btn-small indigo">Send picture</button>
										    			<button class="btn btn-small red">Cancel Remittance</button>
									    			</center>
									    		</div>
									    	</div>
									    </div>
								    </li>
								    <li>
									    <div class="collapsible-header"><i class="material-icons">
									    indeterminate_check_box</i>150$ to Leyber Corrales</div>
									    <div class="collapsible-body">
									    	<div class="row margin-0">
									    		<div class="col s12">
									    			<center>
									    				
									    				You must verify this remittance sending a picture with the deposit<br>
										    			<button class="btn btn-small indigo">Send picture</button>
										    			<button class="btn btn-small red">Cancel Remittance</button>
									    			</center>
									    		</div>
									    	</div>
									    </div>
									</li>
								    <li>
									    <div class="collapsible-header"><i class="material-icons">
									    indeterminate_check_box</i>80$ to Miguel Zamora</div>
									    <div class="collapsible-body">
									    	<div class="row margin-0">
									    		<div class="col s12">
									    			<center>
									    				
									    				Wait while an Administrator verify the image<br>
										    			<button class="btn btn-small indigo">Resend Pictures</button>
										    			<button class="btn btn-small red">Cancel Remittance</button>
									    			</center>
									    		</div>
									    	</div>
									    </div>
								    </li>

								    <li>
									    <div class="collapsible-header"><i class="material-icons">
									    check_box</i>100$ to German Rodriguez</div>
									    <div class="collapsible-body">
									    	<div class="row margin-0">
									    		<div class="col s12">
									    			<center>
									    				
									    				The remittance has been completed succesfully<br>
									    				<button class="btn btn-small indigo">See details</button>
									    			</center>
									    		</div>
									    	</div>
									    </div>
								    </li>
								    <li>
									    <div class="collapsible-header"><i class="material-icons">
									    check_box</i>150$ to Adriana Montoya</div>
									    <div class="collapsible-body">
									    	<div class="row margin-0">
									    		<div class="col s12">
									    			<center>
									    				
									    				The remittance has been completed succesfully<br>
									    				<button class="btn btn-small indigo">See details</button>
									    			</center>
									    		</div>
									    	</div>
									    </div>
									</li>
								    <li>
									    <div class="collapsible-header"><i class="material-icons">
									    check_box</i>80$ to Andres Partidas</div>
									    <div class="collapsible-body">
									    	<div class="row margin-0">
									    		<div class="col s12">
									    			<center>
									    				
									    				The remittance has been completed succesfully<br>
									    				<button class="btn btn-small indigo">See details</button>
									    			</center>
									    		</div>
									    	</div>
									    </div>
								    </li>
								</ul>
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
<div id="modal-acquire-cripto" class="modal">
	<div id="modal-content" class="modal-content margin-0">
	<form action="{{route('acquireCripto')}}" method="POST">@csrf
		<input id="acquire-base" name="base" type="text" class="inputs-id-cripto" hidden>
		<div class="row margin-0">
			<div id="cabecera-modal" class="indigo margin-0">
				<center>
					<h4>Acquire <span id="modal-name-cripto" class="space-name-cripto"></span></h4>
				</center>
			</div>
		</div>
		<div class="row margin-0" style=";padding: 0;">
			<div class="col s12 l6" style="">
				<div class="row" style="">
					
					<form action="">
						<div class="input-field col s10">
							<input id="cuant_buy" class="input_buy reset-message" type="text" value="" name="cuant_buy">
							<span class="helper-text">How much <b class="space-name-cripto">cripto</b> want to buy?</span>
						</div>
						<div class="input-field col s2">
							<center>
								<div id="calculate-by-buy" class="calculate btn"><i class="material-icons">cached</i></div>
							</center>
						</div>
						
						<div class="col s12">
							
							<div class="row valign-wrapper margin-0 padding-0">
								
								<div class="input-field col s6">
									<select id="payWith" name="payWith" class="browser-default reset-message-change">
										<option disabled selected value="none">Pay with</option>
										@foreach($monedas as $moneda)
											<option value="{{$moneda->siglas}}">{{$moneda->siglas}}</option>
										@endforeach
										
									</select>
								</div>
								<div class="input-field col s6">
									<select id="payment_method" name="type_operation" class="browser-default">
										<option disabled selected value="none">Payment Method</option>
										@foreach($metodos_pago as $metodo_pago)
											<option value="{{$metodo_pago->id}}">{{$metodo_pago->nombre}}</option>
										@endforeach
										
									</select>				
									
								</div>
							</div>
						</div>
       
						<div class="input-field col s10">
							<input id="to_pay" type="text" value="50" class="input_buy reset-message" name="to_pay">
							<span class="helper-text">You have to pay:</span>
						</div>
						<div class="input-field col s2">
							<center>
								<div id="calculate-by-payment" class="btn"><i class="material-icons">cached</i></div>
							</center>
						</div>
						<div class="input-field col s12">
							<center>
								<div id="buy" class="btn">Buy</div>
							</center>
						</div>
						
					</form>
				</div>
			</div>
			<div class="col s12 l6" style="padding: 3%;	">
				<center>
					<div id="modal-message" class="green lighten-3 accent-1 card-panel" hidden>
						<div class="card-content">							
							<span class="card-title">Pedido</span>
							<p>You have to pay <b><span id="modal-have-to-pay"></span> <span id="space-pay-with"></span></b> to receive <b><span id="modal-recieve"></span> <span id="modal-cripto-buy" class="space-name-cripto"></span></b></p>
						</div>
						<div class="card-action">
							
							<input id="submit-buy" class="btn indigo" type="submit" value="Acquire">
							<a href="#!" class="btn modal-close red">Cancel</a>
						</div>
					</div>
				</center>
			</div>
		</div>
	</form>
	</div>
</div>
@endsection

<script type="module">
		import {F} from "{{asset('js/global_functions.js')}}";
		import {Ev,Me} from "{{asset('js/methods.js')}}";

	document.addEventListener('DOMContentLoaded', function() {
		let el = document.querySelector('.tabs');
		let instance_tabs = M.Tabs.init(el);
	
 		let elem_modal = document.querySelectorAll('.modal');
    	let instances_modal = M.Modal.init(elem_modal);
    	instances_modal[1].options.onCloseEnd = Me.resetModal;
    	instances_modal[1].options.onOpenStart = Me.resetModal;

    	let elem_collapsible = document.querySelectorAll('.collapsible');
    	let instances_collapsible = M.Collapsible.init(elem_collapsible);

    	let elems_select = document.querySelectorAll('select');
    	let instances_select = M.FormSelect.init(elems_select);

    	let elems_receiver = document.querySelectorAll('.autocomplete');
    	let instances_receiver = M.Autocomplete.init(elems_receiver, {
    		data: {
    			'Persona 1':null,
    			'Persona 2':null,
    			'Persona 3':null,
    		}
    	});


    	//Array en el que se guardarán los valores en $ de las monedas para calcular al momento de comprar
		let cripto_arr_calculate = [];


		function coinbaseOnOpen(event){
			//Creará el array con el que se hara el request a la api
			let cripto_arr_ws = [];

			@foreach($criptomonedas as $criptomoneda)
				cripto_arr_ws.push("{{$criptomoneda->moneda->siglas}}-USD");
				cripto_arr_calculate["{{$criptomoneda->moneda->siglas}}-USD"] = null;
			@endforeach
			
			let json_to_send = JSON.stringify({"type": "subscribe","channels": [{"name": "ticker","product_ids":cripto_arr_ws}]});
			this.send(json_to_send);
		}
		
    	//Cada vez que se abra el modal se configura con la moneda en cuestion
	    let cript_to_buy = [];
   		F.addEvent.onClick('.buy-cripto',function(e){
	    	cript_to_buy['name'] = e.target.dataset.nombre_cripto;
	    	cript_to_buy['usd'] = cripto_arr_calculate[e.target.dataset.siglas_cripto+'-USD'];
	   		Ev.setNameEvent(e);

	   	});

   		let htg_consulted = false;

    	//Consultará a la API

   		F.ws({
   			url:'wss://ws-feed.pro.coinbase.com',
   			onOpen:coinbaseOnOpen, //No se crea la funcion en Me porque necesita del PHP al iniciar la pagina
   			//onMessage:Me.coinbaseOnMessage,
   			onMessage:function(e){
   				Me.coinbaseOnMessage(e,cripto_arr_calculate);
   				if(cripto_arr_calculate['BTC-USD']!==null && !htg_consulted){
					Me.setHtgPrice(cripto_arr_calculate);
					htg_consulted = true;
   				}
				//Me.setHtgPrice(cripto_arr_calculate);
   			},
   		});
		setInterval(function(){
			
			//cripto_arr_calculate = Me.consultDogecoin(cripto_arr_calculate);
			Me.consultDogecoin(cripto_arr_calculate);

		},5000);

		//current cripto será la moneda con que se hará el calculo de la compra en el modal
		//cambiará cuando se cambie la moneda en dicho modal
		//Me.calculeBuyCost();


		F.addEvent.onClick('#calculate-by-buy',function(){
			let calculated = Me.calculateByBuy(cripto_arr_calculate,cript_to_buy);
			if(calculated){
				Me.disabledBuyButton(false);
			}
		});
		F.addEvent.onClick('#calculate-by-payment',function(){
			let calculated = Me.calculateByPayment(cripto_arr_calculate,cript_to_buy);
			if(calculated){
				Me.disabledBuyButton(false);
			}
		});
		let modal_message_is_disabled = true;
		function setModalMessage(){
			Me.disabledBuyButton(true);
			if(!modal_message_is_disabled){

				Me.disableModalMessage('','','');
				modal_message_is_disabled = true;
			}
		}
		F.addEvent.onClick('#buy',Me.changePayWithModal);
		F.addEvent.onKeyUp('.reset-message',setModalMessage);
		F.addEvent.onChange('.reset-message-change',setModalMessage);
		


		
/*
		F.addEvent.onChange('.input_buy',function(){

			Me.resetCost(cripto_arr_calculate);
			Me.changePayWithModal();
		});


		F.addEvent.onClick('.re_calculate',function(){

			Me.resetCost(cripto_arr_calculate);
			Me.changePayWithModal();
		});
*/
	});
</script>	