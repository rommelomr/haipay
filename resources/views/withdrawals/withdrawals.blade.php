@extends('layouts.app')
@extends('layouts.sidenav')
@section('main')

	<div class="container">
		<div class="row">
			<div class="col s12">
				<div class="card-panel">
					<div class="row">
						<div class="col s12">
							<h5 class="center">Withdraw {{$cartera->haiCriptomoneda->moneda->nombre}}</h5>
						</div>
					</div>
					<div class="row">
						@if($cartera->cantidad <= 0)
							<div class="col s12">
								<center>
									<span class="red-text">You don't have enough {{$cartera->haiCriptomoneda->moneda->nombre}} to retire</span>
								</center>
							</div>
						@else
							<div class="col s10 offset-s1">
								<div class="row">
									<div class="col s12">
										<center>
											<b>My Wallet:</b> {{$cartera->cantidad}}
										</center>
									</div>
								</div>
								<form action="{{route('withdraw_post')}}" method="post">
									@csrf
									<input hidden name="hai_crypto_id" value="{{$cartera->haiCriptomoneda->id}}">
									<div class="row">
										
										<div class="col s6 input-field">
											<label id="amount-message" for="amount-to-retire">Loading</label>
											<input 
												@if(!(old('amount_to_retire')))
													disabled
												@endif

											id="amount-to-retire" type="text" class="tooltipped" data-position="left" data-tooltip="The minimum amount to witdhraw is the convertion of 5$" name="amount_to_retire" value="{{old('amount_to_retire')}}">
											
										</div>
										<div class="col s6 input-field">
											<span class="who-message helper-text">Charge comission from <a href="#help-modal" class="modal-trigger">?</a></span>
											
											<select id="charge-from" name="charge_from" class="browser-default">
												<option disabled selected>Charge comission from</option>
												<option
													@if(old('charge_from') == "0")
														selected
													@endif
												value="0">Wallet</option>
												<option
													@if(old('charge_from') == "1")
														selected
													@endif
												value="1">Amount</option>
											</select>
										</div>
									</div>
									
									<div class="row">
										<div class="col s6 input-field">
											<input id="amount_in_usd" type="text" value="0" disabled>
											<span class="helper-text">Amount expressed in USD</span>
										</div>
										<div class="col s6 input-field">
											<input id="comission" type="text" value="0" disabled>
											<span class="helper-text">Comission</span>
										</div>
										
									</div>
								
									<div class="row">

										<div class="col s12">

											<select name="withdraw_method_id" class="browser-default">

												<option disabled selected>Withdraw method</option>

												@foreach($metodos_retiro as $metodo_retiro)

													<option
														@if(old('withdraw_method_id') == $metodo_retiro->id)
															selected
														@endif
													value="{{$metodo_retiro->id}}">
														{{$metodo_retiro->nombre}}
													</option>

												@endforeach

											</select>

										</div>

									</div>

									<div class="row">

										<div class="col s12">

											<center>

												<button class="btn green">Withdraw</button>

											</center>

										</div>

									</div>
								
								</form>
							</div>

							<div class="row">
								
								<div class="col s6">
									
								</div>

							</div>
							
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
<div hidden>
	<input id="real-time-crypto-price">
</div>
<div id="help-modal" class="modal">
	<div class="modal-content">
		<ul class="browser-default">
			<li>
				If you choose "<b>wallet</b>", the comission will be charged from the haipay wallet and you will witdhraw exactly the amount you are entering.
			</li>
			<li>
				If you choose "<b>amount</b>", the comission will be charged from the amount you will witdhraw. That is, you will withdraw a little less than the amount entered.
			</li>
		</ul>
	</div>
	<div class="modal-footer">
		<button class="btn green modal-close">Understood!</button>
	</div>
</div>
@endsection
<script src="{{asset('js/withdrawals/materialize.js')}}"></script>
<script type="module">

	import {D} from "{{asset('js/Domm/Domm.js')}}";
	import {Me} from "{{asset('js/withdrawals/Methods.js')}}";

	window.addEventListener('load',function(){

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
		
		let crypto = JSON.parse(D.dom.htmlDecode('{{$api_data}}'));

		let comissions = [];
		comissions['network'] = '{{$comision_red}}';
		comissions['retiro'] = '{{$comision_retiro}}';
		comissions['general'] = '{{$comision_general}}';

		console.log(comissions);

		Me.launchWebSocket(crypto);

		D.addEvent.onKeyUp('#amount-to-retire',function(el,ev){

			Me.updateUSDAmount(el,comissions['general']);
			Me.updateComission(el,comissions);
		});


		
	});

</script>
<script src="{{asset('js/withdrawals/main.js')}}"></script>
