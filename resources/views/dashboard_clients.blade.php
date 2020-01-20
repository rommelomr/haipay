@extends('layouts.app')
@extends('layouts.sidenav')
@section('head')
    <link rel="stylesheet" href="{{asset('css/dash_clients.css')}}">
@endsection
@section('main')
    <div class="container-fluid">
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
										<div class="card-cripto col s6 l3">
											<div class="card-panel">	
												<b>BTC</b>:<span class="precio">1234</span> $
												
												<a href="#modal-acquire-cripto" class="btn indigo modal-trigger">Acquire</a>
											</div>
										</div>
										<div class="card-cripto col s6 l3">
											<div class="card-panel">
												<b>LTC</b>:<span class="precio">1234</span> $
												
												<a href="#modal-acquire-cripto" class="btn indigo modal-trigger">Acquire</a>
											</div>
										</div>
										<div class="card-cripto col s6 l3">
											<div class="card-panel">
												<b>ETH</b>:<span class="precio">1234</span> $
												
												<a href="#modal-acquire-cripto" class="btn indigo modal-trigger">Acquire</a>
											</div>
										</div>
										<div class="card-cripto col s6 l3">
											<div class="card-panel">
												<b>XRP</b>:<span class="precio">1234</span> $
												
												<a href="#modal-acquire-cripto" class="btn indigo modal-trigger">Acquire</a>
											</div>
										</div>
										
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

<div id="modal-acquire-cripto" class="modal">
	<div id="modal-content" class="modal-content margin-0">
			
		<div class="row margin-0">
			<div id="cabecera-modal" class="indigo margin-0">
				<center>
					<h4>Acquire <span id="modal-name-cripto">Bitcoin</span></h4>
				</center>
			</div>
		</div>
		<div class="row valign-wrapper margin-0" style=";padding: 0;">
			<div class="col s12 l6" style="">
				<div class="row" style="">
					
					<form action="">
						<div class="input-field col s12">
							<label for="sum">How much <b>cripto</b> want to buy?</label>
							<input id="sum" type="text" value="50">
						</div>
						<div class="col s12">
							
							<div class="row valign-wrapper margin-0 padding-0">
								
								<div class="input-field col s6">
									<select name="" id="" class="browser-default">
										<option disabled selected>Pay with</option>
										<option value="">Dollar</option>
										<option value="">Bitcoin</option>
										<option value="">LTS </option>
										<option value="">Other 2</option>
										<option value="">Other 3</option>
									</select>
								</div>
								<div class="input-field col s6">				
									<center>
										
									    <p>
									      <label>
									        <input class="with-gap" name="type_operation" type="radio" checked/>
									        <span>Deposit</span>
									      </label>
									    </p>
									    <p>
									      <label>
									        <input class="with-gap" name="type_operation" type="radio"/>
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
					<div id="modal-message" class="light-green accent-1">
						
						<h5>You have to pay <b><span id="modal-have-to-pay">50</span></b> <span id="modal-cripto">TLS</span> to receive <b><span id="modal-recieve">50</span></b><span id="modal-cripto-buy">Bitcoin</span></h5>
					</div>
						<br>
					<label for="" class="btn indigo">Acquire</label>
					<a href="#!" class="btn modal-close red">Cancel</a>
				</center>
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

@endsection

<script>
	document.addEventListener('DOMContentLoaded', function() {
		var el = document.querySelector('.tabs');
		var instance_tabs = M.Tabs.init(el);
	
 		var elem_modal = document.querySelectorAll('.modal');
    	var instances_modal = M.Modal.init(elem_modal);
    	instances_modal[1].open();
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
	var prueba = document.$_getElementById('nombre-receiver');
	
	prueba.onchange = function(){
		alert();
	}
	});
</script>