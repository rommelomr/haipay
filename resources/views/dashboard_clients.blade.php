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
												<b>1 {{$criptomoneda->siglas}}</b><br><span class="precio-{{$criptomoneda->siglas}}-USD">1234</span> $<br>
												<a href="#modal-acquire-cripto" data-nombre_cripto="{{$criptomoneda->nombre}}" data-siglas_cripto="{{$criptomoneda->siglas}}" class="btn indigo modal-trigger buy-cripto">Acquire</a>

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
											<tr>
												<td>Bitcoin</td>
												<td>0.00000001</td>
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
	<form action="acquireCripto" method="POST">@csrf
		<input id="acquire-base" name="base" type="text" class="inputs-initials-cripto" hidden>
		<div class="row margin-0">
			<div id="cabecera-modal" class="indigo margin-0">
				<center>
					<h4>Acquire <span id="modal-name-cripto" class="space-name-cripto"></span></h4>
				</center>
			</div>
		</div>
		<div class="row valign-wrapper margin-0" style=";padding: 0;">
			<div class="col s12 l6" style="">
				<div class="row" style="">
					
					<form action="">
						<div class="input-field col s12">
							<label for="sum">How much <b class="space-name-cripto">cripto</b> want to buy?</label>
							<input id="sum" type="text" value="50" name="cantBuy">
						</div>
						<div class="col s12">
							
							<div class="row valign-wrapper margin-0 padding-0">
								
								<div class="input-field col s6">
									<select id="payWith" name="payWith" class="browser-default">
										<option disabled selected value="none">Pay with</option>
										<option value="USD">USD - Dólar estadounidense</option>
										@foreach($criptomonedas as $criptomoneda)
											<option value="{{$criptomoneda->siglas}}">{{$criptomoneda->siglas}}</option>
										@endforeach
										
									</select>
								</div>
								<div class="input-field col s6">				
									<center>
										
									    <p>
									      <label>
									        <input class="with-gap" name="type_operation" type="radio" value="Deposit" checked/>
									        <span>Deposit</span>
									      </label>
									    </p>
									    <p>
									      <label>
									        <input class="with-gap" name="type_operation" type="radio" value="Change"/>
									        <span>Change</span>
									      </label>
									      
									    </p>
									</center>
								</div>
							</div>
						</div>
       
						<div class="input-field col s12">
							<label for="modal-to-pay">You have to pay:</label>
							<input id="modal-to-pay" type="text" value="50">
						</div>						
					</form>
				</div>
			</div>
			<div class="col s12 l6">
				<center>
					<div id="modal-message" class="light-green accent-1" hidden>
						
						<h5>You have to pay <b><span id="modal-have-to-pay">50</span></b> <span id="space-pay-with">TLS</span> to receive <b><span id="modal-recieve">50</span></b> <span id="modal-cripto-buy" class="space-name-cripto"></span></h5>
					</div>
						<br>
					<input id="submit-buy" class="btn indigo" type="submit" value="Acquire">
					<a href="#!" class="btn modal-close red">Cancel</a>
				</center>
			</div>
		</div>
	</form>
	</div>
</div>
@endsection

<script>
	document.addEventListener('DOMContentLoaded', function() {
		var el = document.querySelector('.tabs');
		var instance_tabs = M.Tabs.init(el);
	
 		var elem_modal = document.querySelectorAll('.modal');
    	var instances_modal = M.Modal.init(elem_modal);
    	console.log(instances_modal[1]);

    	var elem_collapsible = document.querySelectorAll('.collapsible');
    	var instances_collapsible = M.Collapsible.init(elem_collapsible);

    	var elems_select = document.querySelectorAll('select');
    	var instances_select = M.FormSelect.init(elems_select);

    	var elems_receiver = document.querySelectorAll('.autocomplete');
    	var instances_receiver = M.Autocomplete.init(elems_receiver, {
    		data: {
    			'Persona 1':null,
    			'Persona 2':null,
    			'Persona 3':null,
    		}
    	});

    	/*
    		Llenará en el modal todos los campos en los que se deba mostrar la criptomoneda elegida
    	*/
    	let spaces_name_cripto = document.querySelectorAll('.space-name-cripto');
    	let inputs_initials_cripto = document.querySelectorAll('.inputs-initials-cripto');

    	function setNameModal(nombre,siglas){

    		for(let i_spaces = 0; i_spaces<spaces_name_cripto.length; i_spaces++){
    			spaces_name_cripto[i_spaces].innerText = nombre;
    		}
    		for(let i_spaces = 0; i_spaces<inputs_initials_cripto.length; i_spaces++){
    			inputs_initials_cripto[i_spaces].value = siglas;
    		}
    	}

    	function setNameEvent(e){
    		console.log(spaces_name_cripto);
    		setNameModal(e.target.dataset.nombre_cripto,e.target.dataset.siglas_cripto);
    	}

    	function updatePrices(cripto){
    		if(cripto.type == "ticker"){

	    		let spaces = document.querySelectorAll('.precio-'+cripto.product_id);
    			console.log('.precio-'+cripto.product_id);
	    		
	    		for(let i = 0; i<spaces.length;i++){
	    			spaces[i].innerText = cripto.price;
	    		}
    		}
    	}

    	//Configurará que cada vez que se abra el modal se configura con la moneda en cuestion
    	let cripto_buttons = document.querySelectorAll('.buy-cripto');
    	console.log(cripto_buttons);
    	for (let i_cripto = 0; i_cripto < cripto_buttons.length; i_cripto++){
    		cripto_buttons[i_cripto].onclick = setNameEvent;
    	}

    	/*
    		Configurará la visualización del mensaje del modal, y el botón para enviar la solicitud
    	*/
    	let space_pay_with = document.getElementById('space-pay-with');
    	let modal_message = document.getElementById('modal-message');
    	let submit_buy = document.getElementById('submit-buy');
    	let pay_with = document.getElementById('payWith');

    	function changePayWithModal(){
    		if(pay_with.value!='none'){
    			modal_message.removeAttribute('hidden');
    			submit_buy.removeAttribute('disabled');
    			space_pay_with.innerText = pay_with.value;
    		}else{
    			modal_message.setAttribute('hidden',true);
    			submit_buy.setAttribute('disabled',true);
    			space_pay_with.innerText = '';
    		}
    	}
    	//Seteará el modal al cargar la pagina por primera vez
    	changePayWithModal();
    	pay_with.onchange = changePayWithModal;

    	//Reseteará la configuracion del modal cada vez que se cierre
    	function resetModal(){
    		pay_with.value="none";
    		changePayWithModal();
    	}
    	instances_modal[1].options.onCloseEnd = resetModal;
    	

    	//Consultará a la API
		var exampleSocket = new WebSocket("ws://ws-feed.pro.coinbase.com");

		let cripto_arr = [];
		@foreach($criptomonedas as $criptomoneda)
			cripto_arr.push("{{$criptomoneda->siglas}}-USD");
		@endforeach
		console.log(cripto_arr);
		//let json_to_send = JSON.stringify({"type": "subscribe","product_ids": ["ETH-USD","ETH-EUR"],"channels": ["level2","heartbeat",{"name": "ticker","product_ids":cripto_arr}]});
		let json_to_send = JSON.stringify({"type": "subscribe","channels": [{"name": "ticker","product_ids":cripto_arr}]});
		exampleSocket.onopen = function(event){
			console.log('sended');
			exampleSocket.send(json_to_send);
		}
		exampleSocket.onmessage = function (event) {
		
			updatePrices(JSON.parse(event.data));
		}

	});
</script>